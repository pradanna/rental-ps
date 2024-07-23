<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Denda;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $status = $this->field('status');
            $data = [];
            if ($status === '1') {
                $data = Transaksi::with(['user'])
                    ->where('status', '=', 1)
                    ->orderBy('updated_at', 'ASC')
                    ->get()->append(['kekurangan']);
            }

            if ($status === '2') {
                $rangeStatus = [3];
                $data = Transaksi::with(['user.member'])
                    ->whereIn('status', $rangeStatus)
                    ->orderBy('updated_at', 'ASC')
                    ->get()->append(['kekurangan']);
            }

            if ($status === '3') {
                $data = Transaksi::with(['user.member'])
                    ->where('status', '=', 4)
                    ->orderBy('updated_at', 'ASC')
                    ->get()->append(['kekurangan']);
            }

            if ($status === '4') {
                $data = Transaksi::with(['user.member'])
                    ->where('status', '=', 5)
                    ->orderBy('updated_at', 'ASC')
                    ->get()->append(['kekurangan']);
            }

            return $this->basicDataTables($data);
        }
        return view('admin.peminjaman.index');
    }

    public function detail_new($id)
    {
        if ($this->request->ajax()) {
            if ($this->request->method() === 'POST') {
                return $this->confirm_order($id);
            }
            $data = Keranjang::with(['product.kategori'])
                ->where('transaksi_id', '=', $id)
                ->get();
            return $this->basicDataTables($data);
        }
        $data = Transaksi::with(['pembayaran_status', 'keranjang'])
            ->findOrFail($id)->append(['kekurangan']);
        return view('admin.peminjaman.detail.baru')->with([
            'data' => $data
        ]);
    }

    public function detail_ready($id)
    {
        if ($this->request->ajax()) {
            if ($this->request->method() === 'POST') {
                return $this->confirm_to_process($id);
            }
            $data = Keranjang::with(['product.kategori'])
                ->where('transaksi_id', '=', $id)
                ->get();
            return $this->basicDataTables($data);
        }
        $data = Transaksi::with(['pembayaran_status', 'keranjang'])
            ->where('status', '=', 3)
            ->findOrFail($id)->append(['kekurangan']);
        return view('admin.peminjaman.detail.ready')->with([
            'data' => $data
        ]);
    }

    public function detail_process($id)
    {
        $data = Transaksi::with(['pembayaran_status', 'keranjang'])
            ->where('status', '=', 4)
            ->findOrFail($id)->append(['kekurangan']);

        $denda = Denda::with([])
            ->first();
        $intDenda = 0;
        if ($denda) {
            $intDenda = $denda->nominal;
        }

        $kekurangan = $data->kekurangan;

        $now = Carbon::now();
        $dateReturn = Carbon::parse($data->tanggal_kembali);
        $diff = $dateReturn->diffInDays($now, false);
        $keterlambatan = 0;
        if ($diff > 0) {
            $keterlambatan = $diff;
        }

        $total_denda = ($keterlambatan * $intDenda);
        if ($this->request->ajax()) {
            if ($this->request->method() === 'POST') {
                return $this->confirm_to_finish($id, $total_denda);
            }
            $data = Keranjang::with(['product.kategori'])
                ->where('transaksi_id', '=', $id)
                ->get();
            return $this->basicDataTables($data);
        }

        return view('admin.peminjaman.detail.proses')->with([
            'data' => $data,
            'denda' => $intDenda,
            'kekurangan' => $kekurangan,
            'keterlambatan' => $keterlambatan,
            'total_denda' => ($intDenda * $keterlambatan)
        ]);
    }

    private function confirm_order($id)
    {
        DB::beginTransaction();
        try {
            $status = $this->postField('status');
            $reason = $this->postField('reason');
            $order = Transaksi::with(['pembayaran_status'])
                ->where('id', '=', $id)
                ->first();
            if (!$order) {
                return $this->jsonNotFoundResponse('data tidak ditemukan...');
            }

            /** @var Model $payment */
            $payment = $order->pembayaran_status;
            $data_request_order = [
                'status' => 2,
            ];
            if ($status === '1') {
                $data_request_order['status'] = 3;
            }

            $data_request_payment = [
                'status' => 2,
                'deskripsi' => $reason
            ];
            if ($status === '1') {
                $data_request_payment['status'] = 1;
                $data_request_payment['deskripsi'] = '-';
            }
            $payment->update($data_request_payment);
            $order->update($data_request_order);
            DB::commit();
            return $this->jsonSuccessResponse('success', 'Berhasil merubah data product...');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function confirm_to_process($id)
    {
        try {
            $order = Transaksi::with(['pembayaran_status'])
                ->where('id', '=', $id)
                ->first();
            if (!$order) {
                return $this->jsonNotFoundResponse('data tidak ditemukan...');
            }
            $data_request_order = [
                'status' => 4,
            ];
            $order->update($data_request_order);
            return $this->jsonSuccessResponse('success', 'Berhasil merubah data product...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function confirm_to_finish($id, $total_denda)
    {
        try {
            $order = Transaksi::with(['pembayaran_status'])
                ->where('id', '=', $id)
                ->first();
            if (!$order) {
                return $this->jsonNotFoundResponse('data tidak ditemukan...');
            }

            $subTotal = $order->sub_total;
            $total = $subTotal + $total_denda;
            $data_request_order = [
                'status' => 5,
                'denda' => $total_denda,
                'total' => $total,
                'lunas' => true
            ];
            $order->update($data_request_order);
            return $this->jsonSuccessResponse('success', 'Berhasil merubah data product...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}

<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\Transaksi;
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
                $rangeStatus = [3, 4, 5];
                $data = Transaksi::with([])
                    ->whereIn('status', $rangeStatus)
                    ->orderBy('updated_at', 'ASC')
                    ->get();
            }

            if ($status === '3') {
                $data = Transaksi::with([])
                    ->where('status', '=', 6)
                    ->orderBy('updated_at', 'ASC')
                    ->get();
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
}

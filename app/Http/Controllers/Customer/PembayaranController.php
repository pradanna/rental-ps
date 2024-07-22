<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PembayaranController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $data = Transaksi::with(['user'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->payment($data);
        }
        return view('customer.pembayaran')->with([
            'data' => $data
        ]);
    }

    /**
     * @param $order Model
     * @return \Illuminate\Http\JsonResponse
     */
    private function payment($order)
    {
        try {
            DB::beginTransaction();
            $orderID = $order->id;

            $data_request = [
                'transaksi_id' => $orderID,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'bank' => $this->postField('bank'),
                'atas_nama' => $this->postField('name'),
                'status' => 0,
                'deskripsi' => '-'
            ];

            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('assets/bukti');
                $documentName = $storage_path . '/' . $document;
                $data_request['bukti'] = '/assets/bukti/' . $document;
                $file->move($storage_path, $documentName);
            } else {
                DB::rollBack();
                return $this->jsonErrorResponse('Mohon melampirkan bukti transfer...');
            }
            Pembayaran::create($data_request);
            $order->update([
                'status' => 1
            ]);
            DB::commit();
            return $this->jsonSuccessResponse('success', 'Berhasil upload bukti transfer...');
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}

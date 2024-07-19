<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Keranjang;

class KeranjangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Keranjang::with(['product.kategori'])
            ->whereNull('transaksi_id')
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($this->request->ajax()) {
            return $this->basicDataTables($data);
        }
        $total = $data->sum('total');
        return view('customer.keranjang')->with([
            'total' => $total
        ]);
    }

    public function destroy($id)
    {
        try {
            Keranjang::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    public function checkout()
    {
        try {

        }catch (\Exception $e) {

        }
    }
}

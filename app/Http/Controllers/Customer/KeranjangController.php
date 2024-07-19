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
        if ($this->request->ajax()) {
            $data = Keranjang::with(['product'])
                ->whereNull('transaksi_id')
                ->where('user_id', '=', auth()->id())
                ->get();
            return $this->basicDataTables($data);
        }

        return view('customer.keranjang');
    }
}

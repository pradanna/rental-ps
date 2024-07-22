<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Transaksi;

class PeminjamanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Transaksi::with(['user'])
                ->where('user_id', '=', auth()->id())
                ->orderBy('created_at', 'DESC')
                ->get()->append(['kekurangan']);
            return $this->basicDataTables($data);
        }
        return view('customer.peminjaman');
    }

    public function detail($id)
    {
        $data = Transaksi::with(['user', 'keranjang.product.kategori'])
            ->findOrFail($id)->append([
                'kekurangan'
            ]);
        return view('customer.peminjaman-detail')->with([
            'data' => $data
        ]);
    }
}

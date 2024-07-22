<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Keranjang;
use App\Models\Product;

class KeranjangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->addToCart();
        }

        if ($this->request->ajax()) {
            $data = Keranjang::with(['product'])
                ->whereNull('transaksi_id')
                ->where('user_id', '=', auth()->id())
                ->get();
            return $this->basicDataTables($data);
        }

        return view('customer.keranjang');
    }

    private function addToCart()
    {
        try {
            $userID = auth()->id();
            $productID = $this->postField('id');
            $qty = $this->postField('qty');

            $product = Product::with([])
                ->where('id', '=', $productID)
                ->firstOrFail();
            if (!$product) {
                return $this->jsonErrorResponse('product tidak ditemukan');
            }

            $productPrice = $product->harga;
            $total = (int)$qty * $productPrice;
            $data_request = [
                'user_id' => $userID,
                'transaksi_id' => null,
                'product_id' => $productID,
                'total' => $total
            ];
            Keranjang::create($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menambahkan keranjang...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }
}

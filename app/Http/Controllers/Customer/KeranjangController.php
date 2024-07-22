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

<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $category = Kategori::with([])
            ->findOrFail($id);
        return view('customer.sewaps')->with([
            'products' => $category->product,
            'category' => $category
        ]);
    }

    public function detail($id, $product_id)
    {
        $product = Product::with(['kategori'])
            ->where('kategori_id', '=', $id)
            ->findOrFail($product_id);
//        dd($product->toArray());
        if ($this->request->method() === 'POST') {
            return $this->store($product);
        }
        return view('customer.detail-unit')->with([
            'product' => $product
        ]);
    }

    /**
     * @param Model $product
     * @return \Illuminate\Http\RedirectResponse
     */
    private function store($product)
    {
        try {
            $data_request = [
                'user_id' => auth()->id(),
                'transaksi_id' => null,
                'product_id' => $product->id,
                'total' => $product->harga
            ];
            Keranjang::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menambah keranjang...');
        }catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }
}

<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Kategori;
use App\Models\Product;

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
        return view('customer.detail-unit')->with([
            'product' => $product
        ]);
    }
}

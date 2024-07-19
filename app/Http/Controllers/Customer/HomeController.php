<?php


namespace App\Http\Controllers\Customer;


use App\Helper\CustomController;
use App\Models\Kategori;

class HomeController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = Kategori::with(['product'])
            ->get()->append('count_product');
        return view('customer.home')->with([
            'categories' => $categories
        ]);
    }
}

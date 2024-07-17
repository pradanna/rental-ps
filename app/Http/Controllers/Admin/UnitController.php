<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;

class UnitController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.barang');
    }
}

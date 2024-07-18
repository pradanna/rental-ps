<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class UnitController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Product::with(['kategori'])
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        $categories = Kategori::with([])
            ->get();
        return view('admin.unit.index')->with([
            'categories' => $categories
        ]);
    }

    public function add()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        $categories = Kategori::with([])
            ->get();
        return view('admin.unit.add')->with([
            'categories' => $categories
        ]);
    }

    public function edit($id)
    {
        $data = Product::with(['kategori'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            return $this->patch($data);
        }
        $categories = Kategori::with([])
            ->get();
        return view('admin.unit.edit')->with([
            'data' => $data,
            'categories' => $categories
        ]);
    }

    public function delete($id)
    {
        try {
            Product::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private $rule = [
        'code' => 'required',
    ];

    private $message = [
        'code.required' => 'kolom kode unit wajib diisi',
    ];


    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = [
                'kategori_id' => $this->postField('kategori'),
                'nama' => $this->postField('code'),
                'harga' => $this->postField('price'),
                'qty' => 0,
                'deskripsi' => $this->postField('description'),
                'gambar' => null,
            ];
            Product::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menyimpan data unit...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    /**
     * @param $data Model
     * @return \Illuminate\Http\RedirectResponse
     */
    private function patch($data)
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = [
                'kategori_id' => $this->postField('kategori'),
                'nama' => $this->postField('code'),
                'harga' => $this->postField('price'),
                'qty' => 0,
                'deskripsi' => $this->postField('description'),
                'gambar' => null,
            ];

            $data->update($data_request);
            return redirect()->back()->with('success', 'Berhasil merubah data unit...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }
}

<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class CategoryController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }

        $data = Kategori::with([])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('admin.kategori')->with([
            'data' => $data
        ]);
    }

    private $rule = [
        'name' => 'required',
    ];

    private $message = [
        'name.required' => 'kolom nama wajib diisi',
    ];


    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = [
                'nama' => $this->postField('name'),
            ];


            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('assets/category');
                $documentName = $storage_path . '/' . $document;
                $data_request['gambar'] = '/assets/category/' . $document;
                $file->move($storage_path, $documentName);
            }
            Kategori::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menyimpan data kategori...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

}

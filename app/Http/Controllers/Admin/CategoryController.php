<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
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
        if ($this->request->ajax()) {
            $data = Kategori::with([])
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.kategori.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        return view('admin.kategori.add');
    }

    public function edit($id)
    {
        $data = Kategori::with([])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            return $this->patch($data);
        }
        return view('admin.kategori.edit')->with(['data' => $data]);
    }

    public function delete($id)
    {
        try {
            Kategori::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
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
            $data->update($data_request);
            return redirect()->back()->with('success', 'Berhasil merubah data kategori...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

}

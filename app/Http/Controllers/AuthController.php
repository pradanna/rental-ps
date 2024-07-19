<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    private $rule = [
        'username' => 'required',
        'password' => 'required',
    ];

    private $message = [
        'username.required' => 'kolom username wajib di isi',
        'password.required' => 'kolom password wajib di isi',
    ];


    public function login()
    {
        if ($this->request->method() === 'POST') {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }

            $credentials = [
                'username' => $this->postField('username'),
                'password' => $this->postField('password')
            ];
            if ($this->isAuth($credentials)) {
                if (auth()->user()->role === 'admin' || auth()->user()->role === 'pimpinan') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('customer.home');
            }
            return redirect()->back()->with('failed', 'Periksa Kembali Username dan Password Anda');
        }
        return view('auth.login');
    }

    public function register()
    {
        if ($this->request->method() === 'POST') {
            try {
                $validator = Validator::make($this->request->all(), $this->rule, $this->message);
                if ($validator->fails()) {
                    return redirect()->back()->with('failed', 'harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
                }
                $data_account = [
                    'username' => $this->postField('username'),
                    'password' => Hash::make($this->postField('password')),
                    'role' => 'customer'
                ];
                DB::beginTransaction();
                $user = User::create($data_account);
                $data_customer = [
                    'user_id' => $user->id,
                    'nama' => $this->postField('name'),
                    'no_hp' => $this->postField('phone'),
                    'alamat' => $this->postField('address'),
                ];

                if ($this->request->hasFile('file')) {
                    $file = $this->request->file('file');
                    $extension = $file->getClientOriginalExtension();
                    $document = Uuid::uuid4()->toString() . '.' . $extension;
                    $storage_path = public_path('assets/ktp');
                    $documentName = $storage_path . '/' . $document;
                    $data_customer['gambar_ktp'] = '/assets/ktp/' . $document;
                    $file->move($storage_path, $documentName);
                }

                Customer::create($data_customer);
                DB::commit();
                return redirect()->back()->with('success', 'Berhasil melakukan registrasi');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('failed', 'terjadi kesalahan server...')->withInput();
            }
        }
        return view('customer.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}

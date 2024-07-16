<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use Illuminate\Support\Facades\Validator;

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
}

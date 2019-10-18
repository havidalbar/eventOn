<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Member;

class TamuController extends Controller
{
    public function lihatHalamanLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = Member::where('username', $username)->first();
        if ($user && Hash::check($password, $user->password)) {
            Session::put('username', $user->username);
            Session::put('email', $user->email);
        } else {
            return redirect()->back()->with('alert-error', 'Informasi login salah');
        }
        return redirect()->route('index')->with('alert-success','Berhasil masuk ke sistem');
    }

    public function lihatHalamanRegistrasi()
    {
        return view('register');
    }

    public function registrasi(UserRequest $request)
    {
        $data = new Member();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        Session::put('username', $data->username);
        return redirect()->route('index')->with('alert-success', 'Berhasil mendaftar user');
    }
}

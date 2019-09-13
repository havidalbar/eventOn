<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = new User();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        Session::put('username', $data->username);
        return redirect()->route('user.index')->with('alert-success', 'Berhasil mendaftar user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::find($username);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::find($username);
        return view('pengguna.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $username)
    {
        $user = User::find($username);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if (Session::get('username') == $username) {
            Session::put('username', $request->username);
            Session::put('email', $request->email);
        }
        return redirect()->route('user.index')->with('alert-success', 'Berhasil mengedit user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = User::where('username',$username)->first();
        // dd($user);
        if ($user && Hash::check($password, $user->password)) {
            Session::put('username', $user->username);
            Session::put('email', $user->email);
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back()->with('alert-error', 'Informasi login salah');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('index')->with('alert', 'Anda telah keluar');
    }

    public function getDashboard()
    {
        return view('home');
    }
}

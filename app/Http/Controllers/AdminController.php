<?php

namespace App\Http\Controllers;

use App\Panitia;
use App\Member;
use App\Pesan;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function lihatHalamanKonfirmasiPendaftaran()
    {
        $panitias = Panitia::where('status', 0)->get();
        $pesans = Pesan::where('status', 0)->get();
        $users = array();
        for ($i = 0; $i < count($panitias); $i++) {
            $users[$i] = Member::find($panitias[$i]->id_user);
        }
        return view('halamanAdmin.halamanAdminPanitia', compact('panitias','pesans', 'users'));
    }

    public function terimaPanitia(Request $request)
    {
        $dataPanitia = Panitia::find($request->input('id'));
        if ($dataPanitia) {
            $dataPanitia->status = 1;
            $dataPanitia->save();
            return redirect()->back()->with('alert-success', 'Berhasil menerima panitia');
        } else {
            abort(404);
        }
    }

    public function tolakPanitia(Request $request)
    {
        $dataPanitia = Panitia::find($request->input('id'));
        if ($dataPanitia) {
            $dataPanitia->delete();
            return redirect()->back()->with('alert', 'Berhasil menolak panitia');
        } else {
            abort(404);
        }
    }
    public function lihatHalamanKonfirmasiPembayaran()
    {
        $panitias = Panitia::where('status', 0)->get();
        $pesans = Pesan::where('status', 0)->get();
        $users = array();
        for ($i = 0; $i < count($panitias); $i++) {
            $users[$i] = Member::find($panitias[$i]->id_user);
        }
        return view('halamanAdmin.halamanAdminTransfer', compact('panitias', 'pesans', 'users'));
    }

    public function terimaPembayaran(Request $request)
    {
        $dataPesan = Pesan::find($request->input('id'));
        if ($dataPesan) {
            $dataPesan->status = 1;
            $dataPesan->save();
            return redirect()->back()->with('alert-success', 'Berhasil menyetujui transfer');
        } else {
            abort(404);
        }
    }

    public function tolakPembayaran(Request $request)
    {
        $dataPesan = Pesan::find($request->input('id'));
        if ($dataPesan) {
            $dataPesan->status = -1;
            $dataPesan->save();
            return redirect()->back()->with('alert-success', 'Berhasil menolak transfer');
        } else {
            abort(404);
        }
    }
}

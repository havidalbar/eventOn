<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;
use App\Member;
use App\Panitia;
use App\Acara;
use App\Pesan;
use App\Komentar;
use App\Http\Requests\PanitiaRequest;


class MemberController extends Controller
{
    public function logout()
    {
        Session::flush();
        return redirect()->route('index')->with('alert', 'Anda telah keluar');
    }

    public function updateAkun(UserRequest $request)
    {
        $akun = Member::where('username', Session::get('username'))->update([
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password
        ]);
        Session::put('username', $request->username);
        Session::put('email', $request->email);
        return redirect()->route('index')->with('alert', 'Anda telah mengupdate akun');
    }

    public function lihatAkun()
    {
        $akun = Member::where('username', Session::get('username'))->first();
        return view('informasiAkun.informasiAkunProfil', compact('akun'));
    }

    public function lihatDetailAcara($id)
    {
        $acara = Member::where('id', $id)->first();
        if ($acara) {
            $panitia = Panitia::find($acara->id_panitia);
            return redirect()->route('lihat-detail-acara')->with(compact('acara', 'panitia'));
        } else {
            abort(404);
        }
    }

    public function lihatKodeUnik()
    {
        $pesan = Pesan::where('id_member', Session::get('id'))->first();
        if ($pesan) {
            return redirect()->route('akun.acara.kode-unik')->with(compact('pesan'));
        } else {
            abort(403);
        }
    }

    public function cariAcara(Request $request)
    {
        $acaras = Acara::where('nama_acara', 'like', '%' . $request->input('keyword') . '%');
        $acaras = $acaras->get();
        if ($acaras) {

            $panitias = array();
            for ($i = 0; $i < count($acaras); $i++) {
                $panitias[$i] = Panitia::where('id', $acaras[$i]->id_panitia)->first();
            }
            return redirect()->route('cari')->with(compact('acaras'));
        } else {
            abort(404);
        }
    }

    public function daftarPanitia(PanitiaRequest $request)
    {
        if ($request['files'] != null) {
            $filename = explode('.', $request->foto->getClientOriginalName());
            $fileExt = end($filename);
            $id = $this->generateIdGambar();
            $filename = $id . '.' . $fileExt;
            $path = $request->foto->storeAs('image/profile', $filename, 'public_uploads');

            $data = new Panitia();
            $data->foto = $path;
            $data->url_image = implode(" ", $request['files']);
            $data->nama_panitia = $request->nama_panitia;
            $data->alamat = $request->alamat;
            $data->nohp = $request->nohp;
            $data->id_member = Session::get('id_member');
            $data->status = 0;
            $data->save();
            Session::put('nama_panitia', $data->nama_panitia);
            Session::put('id_panitia', $data->id);
            Session::put('id_user', $data->id_member);
            Session::put('foto_panitia', $data->foto);
            return redirect()->route('index')->with('alert-success', 'Berhasil mendaftar panitia');
        } else {
            return redirect()->back()->with('alert', 'Anda wajib memberikan foto Portofolio kepada pihak EventOn!')->withInput();
        }
    }

    public function generateIdGambar()
    {
        $char = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];
        $id = "";
        for ($i = 0; $i < 6; $i++) {
            $id = $id . $char[rand(0, 15)];
        }
        return $id;
    }

    public function lihatHalamanBeranda()
    {
        return view('home');
    }

    public function lihatSemuaAcara()
    {
        $acaras = Acara::all();
        $panitia = array();
        for ($i = 0; $i < count($acaras); $i++) {
            $panitia[$i] = Panitia::find($acaras[$i]->id_panitia);
        }
        $key = 'semua';
        return redirect()->route('cari-semua-acara')->with(compact('acaras', 'panitia'));
    }

    public function cariAcaraKategori(Request $request)
    { }

    public function lihatHalamanDaftarPanitia()
    {
        return view('daftarPanitia');
    }

    public function KomentarAcara(Request $request, $id_acara)
    {
        $acara = Acara::find($id_acara);
        $komentar = new Komentar();
        $komentar->id_acara = $acara->id;
        $komentar->isi = $request->isi;
        return redirect()->back()->with('alert', 'berhasil komentar');
    }

    public function HapusKomentarAcara($id)
    {
        $komentar = Komentar::find($id);
        if ($komentar) {
            $komentar->delete();
            return redirect()->back()->with('alert', 'berhasil menghapus acara');
        } else {
            abort(404);
        }
    }
}

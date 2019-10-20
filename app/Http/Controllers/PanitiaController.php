<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PanitiaRequest;
use App\Http\Requests\AcaraRequest;
use App\Panitia;
use App\Acara;

class PanitiaController extends Controller
{

    function lihatProfilePanitia()
    {
        $panitia = Panitia::where('id', Session::get('id_panitia'))->first();

        $acaras = Acara::where('id_panitia', $panitia->id)->get();
        return view('halamanPanitia.profilPanitia', compact('panitia', 'acaras'));
    }

    function updateProfile(PanitiaRequest $request)
    { }

    function buatAcara(AcaraRequest $request)
    {
        if ($request['files'] != null) {
            $data = new Acara();
            $data->foto_acara = implode(" ", $request['files']);
            $data->nama_acara = $request->nama_acara;
            $data->deskripsi = $request->deskripsi;
            $data->kota = $request->kota;
            $data->lokasi = $request->lokasi;
            $data->kategori = $request->kategori;
            $data->cp = $request->cp;
            $data->maksimal = $request->maksimal;
            $data->id_panitia = Session::get('id_panitia');
            $tipe = -1;
            if ($request->status == "gratis") {
                $tipe = 0;
            } else {
                $tipe = 1;
            }
            $data->status = $tipe;
            $data->harga = $request->harga;
            $data->save();
            return redirect()->route('index')->with('alert-success', 'Berhasil buat acara');
        } else {
            return redirect()->back()->with('alert', 'Masukkan foto acara anda terlebih dahulu!')->withInput();
        }
    }

    function lihatKumpulanAcara()
    { }

    function editAcara()
    { }

    function hapusAcara(Request $request)
    {
        $acara = Acara::where('id', $request->input('id'))->first();
        // $dataPesan =  Pesan::where('id_project', $acara->id)->first();
        // $dataProgres =  Progres::where('id_project', $acara->id)->first();
        // if ($dataPesan != null || $dataProgres != null) {
        //     return redirect()->back()->with('alert', 'Project tidak dapat dihapus, karena memiliki progres atau pesanan');
        // }
        $acara = Acara::where('id', $request->input('id'))->delete();
        return redirect()->route('index')->with('alert-success', 'Acara telah dihapus');
    }

    function lihatDataPembeli()
    { }

    function deteksiBarcode()
    { }

    function lihatHalamanTambahAcara()
    {
        return view('halamanPanitia.tambahAcara');
    }

    function lihatHalamanEditAcara()
    { }

    function lihatHalamanDeteksiBarcode()
    { }
}

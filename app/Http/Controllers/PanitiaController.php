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
            } else if ($request->status =="bayar") {
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

    function editAcara(AcaraRequest $request, $id_acara)
    {

        if ($request['files'] != null) {
            $tipe = -1;
            if ($request->status == "gratis") {
                $tipe = 0;
            } else {
                $tipe = 1;
            }
            $dataAcara = Acara::where('id_panitia', Session::get('id_panitia'))->where('id', $id_acara)->update([
                'foto_acara' => implode(" ", $request['files']),
                'nama_acara' => $request->nama_acara, 'deskripsi' => $request->deskripsi, 'kota' => $request->kota, 'lokasi' => $request->lokasi,
                'kategori' => $request->kategori, 'cp' => $request->cp, 'maksimal' => $request->maksimal, 'status' => $tipe, 'harga' => $request->harga
            ]);
            return redirect()->route('index')->with('alert-success', 'Acara berhasil di ubah');
        } else {
            return redirect()->back()->with('alert', 'Masukkan foto terbaru acara anda terlebih dahulu!')->withInput();
        }
    }

    function hapusAcara(Request $request)
    {
        $acara = Acara::where('id', $request->input('id'))->first();
        if ($acara) {
            $acara = Acara::where('id', $request->input('id'))->delete();
            return redirect()->route('index')->with('alert-success', 'Acara telah dihapus');
        } else {
            abort(404);
        }
    }

    function lihatDataPembeli()
    { }

    function deteksiBarcode()
    { }

    function lihatHalamanTambahAcara()
    {
        return view('halamanPanitia.tambahAcara');
    }

    function lihatHalamanEditAcara($id_acara)
    {
        $dataAcara = Acara::where('id', $id_acara)->where('id_panitia', Session::get('id_panitia'))->first();
        $dataPanitia = Panitia::where('id', $dataAcara->id_panitia)->first();
        if ($dataAcara && $dataPanitia) {
            return view('halamanPanitia.ubahAcara',  compact('dataAcara', 'dataPanitia'));
        } else {
            abort(500);
        }
    }

    function lihatHalamanDeteksiBarcode()
    { }
}

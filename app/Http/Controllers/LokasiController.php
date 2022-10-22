<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::All();
        $lokasi_name = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi['name']);
        }
        // dd($lokasis);
        return view('home', compact('lokasis', 'lokasi_name'));
    }

    public function aktif()
    {
        $lokasis = Lokasi::where('kualitas_unsur', 'Baik')->get();
        $lokasi_name = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi['name']);
        }
        return view('aktif', compact('lokasis', 'lokasi_name'));
    }

    public function semi_aktif()
    {
        $lokasis = Lokasi::where('kualitas_unsur', 'Rusak - Digunakan')->get();
        $lokasi_name = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi['name']);
        }
        return view('semi_aktif', compact('lokasis', 'lokasi_name'));
    }

    public function non_aktif()
    {
        $lokasis = Lokasi::where('kualitas_unsur', 0)->get();
        $lokasi_name = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi['name']);
        }
        return view('non_aktif', compact('lokasis', 'lokasi_name'));
    }

    public function lokasi()
    {
        $lokasi = Lokasi::all();
        return json_encode($lokasi);
    }

    public function lokasi_aktif()
    {
        $lokasi = Lokasi::where('kualitas_unsur', 'Baik')->get();
        return json_encode($lokasi);
    }

    public function lokasi_semi_aktif()
    {
        $lokasi = Lokasi::where('kualitas_unsur', 'Rusak - Digunakan')->get();
        return json_encode($lokasi);
    }

    public function lokasi_non()
    {
        $lokasi = Lokasi::where('kualitas_unsur', 'Tidak Digunakan')->get();
        return json_encode($lokasi);
    }

    public function tambah_lokasi(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
                'desa' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'luasan' => 'required|numeric',
                'image' => 'required|image',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'address.required' => 'Alamat harus diisi',
                'desa.required' => 'Desa harus diisi',
                'latitude.required' => 'Latitude harus diisi',
                'longitude.required' => 'Longitude harus diisi',
                'image.required' => 'Gambar harus diisi',
                'image.image' => 'File yang diinput harus gambar',
            ]
        );

        $data = ([
            'category_id' => $request->category,
            'name' => $request->name,
            'nama_lain' => $request->nama_lain,
            'address' => $request->address,
            'desa' => $request->desa,
            'bentuk' => $request->bentuk,
            'ukuran' => $request->ukuran,
            'luasan' => $request->luasan,
            'strata' => $request->strata,
            'kualitas_unsur' => $request->kualitas_unsur,
            'pemanfaatan_lain' => $request->pemanfaatan_lain,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'sertifikat' => $request->sertifikat != null ? $request->sertifikat->store('sertifikat-images') : '',
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'image' => $request->image != null ? $request->image->store('lokasi-images') : ''
        ]);

        Lokasi::create($data);
        return redirect('/dashboard');
    }

    public function edit_lokasi(Request $request)
    {
        if ($request->sertifikat != null) {
            Storage::delete($request->sertifikat_old);
        }
        if ($request->image != null) {
            Storage::delete($request->image_old);
        }

        Lokasi::where('id', $request->id)->update(array(
            'name' => $request->name,
            'nama_lain' => $request->nama_lain,
            'address' => $request->address,
            'desa' => $request->desa,
            'bentuk' => $request->bentuk,
            'ukuran' => $request->ukuran,
            'luasan' => $request->luasan,
            'strata' => $request->strata,
            'kualitas_unsur' => $request->kualitas_unsur,
            'pemanfaatan_lain' => $request->pemanfaatan_lain,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'sertifikat' => $request->sertifikat != null ? $request->sertifikat->store('sertifikat_images') : $request->sertifikat_old,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'image' => $request->image != null ? $request->image->store('lokasi-images') : $request->image_old
        ));

        return redirect('/detail');
    }

    public function delete($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        Storage::delete($lokasi->image);
        Storage::delete($lokasi->sertifikat);
        Lokasi::where('id', $id)->delete();
        return back();
    }

    public function detail_lokasi($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        return view('detail', compact('lokasi'));
    }
}

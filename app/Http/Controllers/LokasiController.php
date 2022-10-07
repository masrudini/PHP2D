<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function lokasi()
    {
        $lokasi = Lokasi::all();
        return json_encode($lokasi);
    }

    public function tambah_lokasi(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
                'detail' => 'required',
                'image' => 'required|image',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'address.required' => 'Alamat harus diisi',
                'detail.required' => 'Detail harus diisi',
                'image.required' => 'Gambar harus diisi',
                'image.image' => 'File yang diinput harus gambar',
            ]
        );

        $data = ([
            'name' => $request->name,
            'address' => $request->address,
            'detail' => $request->detail,
            'image' => $request->image->store('lokasi-images'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_active' => $request->is_active
        ]);

        Lokasi::create($data);
        return redirect('/dashboard');
    }

    public function edit_lokasi(Request $request)
    {
        if ($request->image != null) {
            Storage::delete($request->image_old);
            Lokasi::where('id', $request->id)->update(array(
                'name' => $request->name,
                'address' => $request->address,
                'detail' => $request->detail,
                'image' => $request->image->store('lokasi-images'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_active' => $request->is_active
            ));
        } else {
            Lokasi::where('id', $request->id)->update(array(
                'name' => $request->name,
                'address' => $request->address,
                'detail' => $request->detail,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_active' => $request->is_active
            ));
        }

        return redirect('/detail');
    }

    public function delete($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        Storage::delete($lokasi->image);
        Lokasi::where('id', $id)->delete();
        return back();
    }

    public function detail_lokasi($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        return view('detail', compact('lokasi'));
    }
}

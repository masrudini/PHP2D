<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\UnsurImage;
use Illuminate\Http\Request;
use App\Models\SertifikatImage;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::All();
        $lokasi_name = [];
        $images = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi->name);
            $ui = UnsurImage::where('lokasi_id', $lokasi->id)->first();
            array_push($images, $ui->image);
        }

        $image = join(',', $images);

        return view('home', compact('lokasis', 'lokasi_name', 'image'));
    }

    public function aktif()
    {
        $lokasis = Lokasi::where('kualitas_unsur', 'Baik')->get();
        $lokasi_name = [];
        $images = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi->name);
            $ui = UnsurImage::where('lokasi_id', $lokasi->id)->first();
            array_push($images, $ui->image);
        }

        $image = join(',', $images);

        return view('aktif', compact('lokasis', 'lokasi_name', 'image'));
    }

    public function semi_aktif()
    {
        $lokasis = Lokasi::where('kualitas_unsur', 'Rusak - Digunakan')->get();
        $lokasi_name = [];
        $images = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi->name);
            $ui = UnsurImage::where('lokasi_id', $lokasi->id)->first();
            array_push($images, $ui->image);
        }

        $image = join(',', $images);

        return view('semi_aktif', compact('lokasis', 'lokasi_name', 'image'));
    }

    public function non_aktif()
    {
        $lokasis = Lokasi::where('kualitas_unsur', 'Tidak Digunakan')->get();
        $lokasi_name = [];
        $images = [];
        foreach ($lokasis as $lokasi) {
            array_push($lokasi_name, $lokasi->name);
            $ui = UnsurImage::where('lokasi_id', $lokasi->id)->first();
            array_push($images, $ui->image);
        }

        $image = join(',', $images);

        return view('non_aktif', compact('lokasis', 'lokasi_name', 'image'));
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
                'image.*' => 'image',
                'sertifikat.*' => 'image'
            ],
            [
                'name.required' => 'Nama harus diisi',
                'address.required' => 'Alamat harus diisi',
                'desa.required' => 'Desa harus diisi',
                'latitude.required' => 'Latitude harus diisi',
                'longitude.required' => 'Longitude harus diisi',
                'image.image' => 'File yang diupload harus gambar',
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
            'keterangan_tambahan' => $request->keterangan_tambahan,
        ]);

        Lokasi::create($data);

        $lokasi_id = Lokasi::latest()->first();

        $unsurImages = ([
            'image' => $request->file('image')
        ]);

        if ($unsurImages['image']) {
            foreach ($unsurImages['image'] as $item => $value) {
                $unsurImage = ([
                    'lokasi_id' => $lokasi_id->id,
                    'image' => $unsurImages['image'][$item]->store('lokasi-images')
                ]);
                UnsurImage::create($unsurImage);
            }
        } else {
            $unsurImage = ([
                'lokasi_id' => $lokasi_id->id,
                'image' => 'lokasi-images/gedung_default.jpg'
            ]);
            UnsurImage::create($unsurImage);
        }

        $sertifikatImages = ([
            'image' => $request->file('sertifikat')
        ]);

        if ($sertifikatImages['image']) {
            foreach ($sertifikatImages['image'] as $item => $value) {
                $sertifikatImage = ([
                    'lokasi_id' => $lokasi_id->id,
                    'image' => $sertifikatImages['image'][$item]->store('sertifikat-images')
                ]);
                SertifikatImage::create($sertifikatImage);
            }
        } else {
            $sertifikatImage = ([
                'lokasi_id' => $lokasi_id->id,
                'image' => 'sertifikat-images/berkas_default.jpg'
            ]);
            SertifikatImage::create($sertifikatImage);
        }

        return redirect('/dashboard');
    }

    public function edit_lokasi(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
                'desa' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'luasan' => 'required|numeric',
                'image.*' => 'image',
                'sertifikat.*' => 'image'
            ],
            [
                'name.required' => 'Nama harus diisi',
                'address.required' => 'Alamat harus diisi',
                'desa.required' => 'Desa harus diisi',
                'latitude.required' => 'Latitude harus diisi',
                'longitude.required' => 'Longitude harus diisi',
            ]
        );

        Lokasi::where('id', $request->lokasi_id)->update([
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
            'keterangan_tambahan' => $request->keterangan_tambahan,
        ]);

        $unsurImages = ([
            'image' => $request->image
        ]);

        if ($unsurImages['image']) {
            $unsur_images = UnsurImage::where('lokasi_id', $request->lokasi_id)->get();
            foreach ($unsur_images as $unsur_image) {
                if ($unsur_image->image != 'lokasi-images/gedung_default.jpg') {
                    Storage::delete($unsur_image->image);
                }
            }
            UnsurImage::where('lokasi_id', $request->lokasi_id)->delete();
            foreach ($unsurImages['image'] as $item => $value) {
                $unsurImage = ([
                    'lokasi_id' => $request->lokasi_id,
                    'image' => $unsurImages['image'][$item]->store('lokasi-images')
                ]);
                UnsurImage::create($unsurImage);
            }
        }

        $sertifikatImages = ([
            'image' => $request->sertifikat
        ]);

        if ($sertifikatImages['image']) {
            $sertifikat_images = SertifikatImage::where('lokasi_id', $request->lokasi_id)->get();
            foreach ($sertifikat_images as $sertifikat_image) {
                if ($unsur_image->image != 'sertifikat-images/berkas_default.jpg') {
                    Storage::delete($sertifikat_image->image);
                }
            }
            SertifikatImage::where('lokasi_id', $request->lokasi_id)->delete();
            foreach ($sertifikatImages['image'] as $item => $value) {
                $sertifikatImage = ([
                    'lokasi_id' => $request->lokasi_id,
                    'image' => $sertifikatImages['image'][$item]->store('sertifikat-images')
                ]);
                SertifikatImage::create($sertifikatImage);
            }
        }

        return redirect('/detail');
    }

    public function delete($id)
    {
        $unsurImages = UnsurImage::where('lokasi_id', $id)->get();
        if ($unsurImages) {
            foreach ($unsurImages as $unsurImage) {
                if ($unsurImage->image != 'lokasi-images/gedung_default.jpg') {
                    Storage::delete($unsurImage->image);
                }
            }
        }
        UnsurImage::where('lokasi_id', $id)->delete();

        $sertifikatImages = SertifikatImage::where('lokasi_id', $id)->get();
        if ($sertifikatImages) {
            foreach ($sertifikatImages as $sertifikatImage) {
                if ($sertifikatImage->image != 'sertifikat-images/berkas_default.jpg') {
                    Storage::delete($sertifikatImage->image);
                }
            }
        }
        SertifikatImage::where('lokasi_id', $id)->delete();

        Lokasi::where('id', $id)->delete();
        return back();
    }

    public function detail_lokasi($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        $lokasi_images = UnsurImage::where('lokasi_id', $id)->get();
        $sertifikat_images = SertifikatImage::where('lokasi_id', $id)->get();
        return view('detail', compact('lokasi', 'lokasi_images', 'sertifikat_images'));
    }
}

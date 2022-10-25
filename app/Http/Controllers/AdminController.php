<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Lokasi;
use App\Models\Category;
use App\Models\UnsurImage;
use Illuminate\Http\Request;
use App\Models\SertifikatImage;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function home()
    {
        $lokasis = Lokasi::all();
        $images = [];
        foreach ($lokasis as $lokasi) {
            $ui = UnsurImage::where('lokasi_id', $lokasi->id)->first();
            array_push($images, $ui->image);
        }
        $image = join(',', $images);
        return view('admin/pages/dashboard', compact('image'));
    }

    public function tambah()
    {
        $categories = Category::all();
        return view('admin/pages/tambah', compact('categories'));
    }

    public function detail()
    {
        $lokasis = Lokasi::paginate(10);
        return view('admin/pages/detail', compact('lokasis'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $lokasi = Lokasi::where('id', $id)->first();
        // dd($lokasis);
        return view('admin/pages/edit', compact('lokasi', 'categories'));
    }

    public function detail_lokasi($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        $lokasi_images = UnsurImage::where('lokasi_id', $id)->get();
        $sertifikat_images = SertifikatImage::where('lokasi_id', $id)->get();
        return view('admin/pages/detail_lokasi', compact('lokasi', 'lokasi_images', 'sertifikat_images'));
    }
}

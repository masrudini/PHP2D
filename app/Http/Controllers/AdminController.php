<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DataTables;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function home()
    {

        return view('admin/pages/dashboard');
    }

    public function tambah()
    {
        return view('admin/pages/tambah');
    }

    public function detail()
    {
        $lokasis = Lokasi::All();
        return view('admin/pages/detail', compact('lokasis'));
    }

    public function edit($id)
    {
        $lokasis = Lokasi::where('id', $id)->get();
        return view('admin/pages/edit', compact('lokasis'));
    }

    public function detail_lokasi($id)
    {
        $lokasi = Lokasi::where('id', $id)->first();
        return view('admin/pages/detail_lokasi', compact('lokasi'));
    }
}

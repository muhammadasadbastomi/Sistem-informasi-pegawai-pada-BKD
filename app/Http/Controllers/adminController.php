<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function kecamatanIndex(){
        return view('admin.kecamatan.index');
    }

    public function kelurahanIndex(){
        return view('admin.kelurahan.index');
    }

    public function instansiIndex(){
        return view('admin.instansi.index');
    }

}

<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
Use App\kecamatan;
Use App\kelurahan;
Use App\instansi;
Use App\Unit_kerja;


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

    public function unitKerjaIndex(){
        return view('admin.unitKerja.index');
    }

    public function pangkatIndex(){
        return view('admin.pangkat.index');
    }

    public function kecamatanCetak(){
        $kecamatan=kecamatan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.kecamatanKeseluruhan', ['kecamatan'=>$kecamatan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data kecamatan.pdf');
      }

    public function kelurahanCetak(){
        $kelurahan=kelurahan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.kelurahanKeseluruhan', ['kelurahan'=>$kelurahan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data kelurahan.pdf');
      }
    public function instansiCetak(){
        $instansi=instansi::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.instansiKeseluruhan', ['instansi'=>$instansi,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Instansi.pdf');
      }

      public function unitKerjaCetak(){
        $unit=unit_kerja::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.unitKerjaKeseluruhan', ['unit'=>$unit,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Unit.pdf');
      }
}

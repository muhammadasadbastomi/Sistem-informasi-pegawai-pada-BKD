<?php

namespace App\Http\Controllers;
use HCrypt;
use PDF;
use Carbon\Carbon;
Use App\kecamatan;
Use App\kelurahan;
Use App\instansi;
Use App\Unit_kerja;
Use App\Golongan;
Use App\Jabatan;
Use App\Diklat;
Use App\Pendidikan;
Use App\karyawan;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function beritaDepan(){
      return view('berita');
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

    public function instansiFilter(){
        $kelurahan = kelurahan::all();
        return view('admin.instansi.filter',compact('kelurahan'));
    }

    public function unitKerjaIndex(){
        return view('admin.unitKerja.index');
    }
    public function filterUnitData(){
        $instansi = instansi::all();
        return view('admin.unitKerja.filter',compact('instansi'));
    }

    public function pangkatIndex(){
        return view('admin.pangkat.index');
    }

    public function jabatanIndex(){
        return view('admin.jabatan.index');
    }

    public function diklatIndex(){
        return view('admin.diklat.index');
    }

    public function pendidikanIndex(){
        return view('admin.pendidikan.index');
    }

    public function pegawaiIndex(){
      return view('admin.pegawai.index');
    }

    public function pegawaiFilterStatus(){
      return view('admin.pegawai.filterStatus');
    }

    public function pegawaiFilterUnit(){
      $unit = unit_kerja::all();
      return view('admin.pegawai.filterUnit',compact('unit'));
    }

  public function pegawaiDetail($uuid){
    $id = HCrypt::decrypt($uuid);
    $karyawan = karyawan::findOrFail($id);
    return view('admin.pegawai.detail',compact('karyawan'));
  }

  public function beritaIndex(){
      return view('admin.berita.index');
  }

  public function adminIndex(){
    return view('admin.users.index');
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
    public function instansiFilterCetak(Request $request){
        $id = HCrypt::decrypt($request->kelurahan_id);
        $instansi=instansi::where('kelurahan_id', $id)->get();
        $kelurahan = kelurahan::findOrFail($id);        
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.instansifilter', ['instansi'=>$instansi,'kelurahan'=>$kelurahan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Instansi per kelurahan.pdf');
      }
    public function filterUnitDataCetak(Request $request){
        $id = HCrypt::decrypt($request->instansi_id);
        $unit=unit_kerja::where('instansi_id', $id)->get();
        $instansi = instansi::findOrFail($id);
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.unitKerjaFilter', ['unit'=>$unit,'instansi'=>$instansi,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Unit Filter.pdf');
      }

      public function unitKerjaCetak(){
        $unit=unit_kerja::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.unitKerjaKeseluruhan', ['unit'=>$unit,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Unit.pdf');
      }

      public function pangkatCetak(){
        $golongan=golongan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.golonganKeseluruhan', ['golongan'=>$golongan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data golonngan / pangkat.pdf');
      }

      public function jabatanCetak(){
        $jabatan=jabatan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.jabatanKeseluruhan', ['jabatan'=>$jabatan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data jabatan.pdf');
      }

      public function diklatCetak(){
        $diklat=diklat::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.diklatKeseluruhan', ['diklat'=>$diklat,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Diklat.pdf');
      }

      public function pendidikanCetak(){
        $pendidikan=pendidikan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pendidikanKeseluruhan', ['pendidikan'=>$pendidikan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data pendidikan.pdf');
      }

      public function pegawaiCetak(){
        $karyawan=karyawan::all();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pegawaiKeseluruhan', ['karyawan'=>$karyawan,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data karyawan.pdf');
      }

      public function pegawaiFilterStatusCetak(Request $request){
        $pegawai=karyawan::where('status_pegawai', $request->status_pegawai)->get();
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pegawaiFilterStatus', ['pegawai'=>$pegawai,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Pegawai Filter Status.pdf');
      }

      public function pegawaiFilterUnitCetak(Request $request){
        $id = HCrypt::decrypt($request->unit_kerja_id);
        $pegawai=karyawan::where('unit_kerja_id', $id)->get();
        $unit_kerja = unit_kerja::findOrFail($id);
        $tgl= Carbon::now()->format('d-m-Y');
        $pdf =PDF::loadView('laporan.pegawaiFilterUnit', ['pegawai'=>$pegawai,'unit_kerja'=>$unit_kerja,'tgl'=>$tgl]);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan data Pegawai Filter Unit Kerja.pdf');
      }
}

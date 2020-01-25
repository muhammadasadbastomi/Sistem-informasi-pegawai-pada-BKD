<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendidikan_karyawan;
use App\Diklat_karyawan;
use App\Riwayat_pangkat;
use App\Pendidikan;
use App\Karyawan;
use App\Unit_kerja;
use HCrypt;

class KaryawanController extends APIController
{
    public function get(){
        $karyawan = json_decode(redis::get("karyawan::all"));
        if (!$karyawan) {
            $karyawan = karyawan::with('unit_kerja','golongan','jabatan')->get();
            if (!$karyawan) {
                return $this->returnController("error", "failed get karyawan data");
            }
            Redis::set("karyawan:all", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $karyawan = Redis::get("karyawan:$id");
        if (!$karyawan) {
            $karyawan = karyawan::with('unit_kerja','golongan','jabatan')->where('id',$id)->first();
            if (!$karyawan){
                return $this->returnController("error", "failed find data karyawan");
            }
            Redis::set("karyawan:$id", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }

    public function create(Request $req){
        $karyawan = New Karyawan;
        
        // decrypt uuid from $req
        $unit_kerja_id = HCrypt::decrypt($req->unit_kerja_id);
        $golongan_id = HCrypt::decrypt($req->golongan_id);
        $jabatan_id = HCrypt::decrypt($req->jabatan_id);

        $karyawan->unit_kerja_id    =  $unit_kerja_id;
        $karyawan->golongan_id      =  $golongan_id;
        $karyawan->jabatan_id       =  $jabatan_id;
        $karyawan->NIP              =  $req->NIP;
        $karyawan->nama             =  $req->nama;
        $karyawan->tempat_lahir     =  $req->tempat_lahir;
        $karyawan->tanggal_lahir    =  $req->tanggal_lahir;
        $karyawan->alamat           =  $req->alamat;
        $karyawan->jk               =  $req->jk;
        $karyawan->agama            =  $req->agama;
        $karyawan->status_pegawai   =  $req->status_pegawai;
        $karyawan->status_kawin     =  $req->status_kawin;
        $karyawan->golongan_darah   =  $req->golongan_darah;
        if($req->foto != null){
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $req->NIP.' - '.$karyawan->nama;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/karyawan', $foto);
            $karyawan->foto       = $foto;
        }else{
            
        }

        $karyawan->save();
        
        $karyawan_id= $karyawan->id;
        
        $uuid = HCrypt::encrypt($karyawan_id);
        $setuuid = Karyawan::findOrFail($karyawan_id);
        $setuuid->uuid = $uuid;
            
        $setuuid->update();

        if (!$karyawan) {
            return $this->returnController("error", "failed create data karyawan");
        }

        Redis::del("karyawan:all");
        Redis::set("karyawan:all",$karyawan);
        return $this->returnController("ok", $karyawan);
    }

    public function pendidikan_create(Request $req){
        $pendidikan_karyawan = New pendidikan_karyawan;
        
        // decrypt uuid from $req
        $karyawan_id = HCrypt::decrypt($req->id);
        $pendidikan_id = HCrypt::decrypt($req->pendidikan_id);

        $pendidikan_karyawan->karyawan_id      =  $karyawan_id;
        $pendidikan_karyawan->pendidikan_id    =  $pendidikan_id;
        $pendidikan_karyawan->keterangan       =  $req->keterangan;

        $pendidikan_karyawan->save();
        
        $pendidikan_karyawan_id= $pendidikan_karyawan->id;
        
        $uuid = HCrypt::encrypt($pendidikan_karyawan_id);
        $setuuid = pendidikan_karyawan::findOrFail($pendidikan_karyawan_id);
        $setuuid->uuid = $uuid;
            
        $setuuid->update();

        if (!$pendidikan_karyawan) {
            return $this->returnController("error", "failed create data pendidikan_karyawan");
        }

        Redis::del("pendidikan_karyawan:all");
        Redis::set("pendidikan_karyawan:all",$pendidikan_karyawan);
        return $this->returnController("ok", $pendidikan_karyawan);
    }

    public function pendidikan_get($uuid){
        $karyawan_id = HCrypt::decrypt($uuid);
        $pendidikan_karyawan = json_decode(redis::get("pendidikan_karyawan::all"));
        if (!$pendidikan_karyawan) {
            $pendidikan_karyawan = pendidikan_karyawan::with('pendidikan')->where('karyawan_id', $karyawan_id)->get();
            if (!$pendidikan_karyawan) {
                return $this->returnController("error", "failed get pendidikan pendidikan_karyawan data");
            }
            Redis::set("pendidikan_karyawan:all", $pendidikan_karyawan);
        }
        return $this->returnController("ok", $pendidikan_karyawan);
    }

    public function pendidikan_delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pendidikan_karyawan = pendidikan_karyawan::find($id);
        if (!$pendidikan_karyawan) {
            return $this->returnController("error", "failed find data pendidikan karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $pendidikan_karyawan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pendidikan karyawan");
        }

        Redis::del("pendidikan_karyawan:all");
        Redis::del("pendidikan_karyawan:$id");

        return $this->returnController("ok", "success delete data pendidikan karyawan");
    }

    public function diklat_create(Request $req){
        $diklat_karyawan = New diklat_karyawan;
        
        // decrypt uuid from $req
        $karyawan_id = HCrypt::decrypt($req->id);
        $diklat_id = HCrypt::decrypt($req->diklat_id);

        $diklat_karyawan->karyawan_id      =  $karyawan_id;
        $diklat_karyawan->diklat_id    =  $diklat_id;

        $diklat_karyawan->save();
        
        $diklat_karyawan_id= $diklat_karyawan->id;
        
        $uuid = HCrypt::encrypt($diklat_karyawan_id);
        $setuuid = diklat_karyawan::findOrFail($diklat_karyawan_id);
        $setuuid->uuid = $uuid;
            
        $setuuid->update();

        if (!$diklat_karyawan) {
            return $this->returnController("error", "failed create data diklat karyawan");
        }

        Redis::del("diklat_karyawan:all");
        Redis::set("diklat_karyawan:all",$diklat_karyawan);
        return $this->returnController("ok", $diklat_karyawan);
    }

    public function diklat_get($uuid){
        $karyawan_id = HCrypt::decrypt($uuid);
        $diklat_karyawan = json_decode(redis::get("diklat_karyawan::all"));
        if (!$diklat_karyawan) {
            $diklat_karyawan = diklat_karyawan::with('diklat')->where('karyawan_id', $karyawan_id)->get();
            if (!$diklat_karyawan) {
                return $this->returnController("error", "failed get diklat diklat_karyawan data");
            }
            Redis::set("diklat_karyawan:all", $diklat_karyawan);
        }
        return $this->returnController("ok", $diklat_karyawan);
    }

    public function diklat_delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $diklat_karyawan = diklat_karyawan::find($id);
        if (!$diklat_karyawan) {
            return $this->returnController("error", "failed find data diklat karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $diklat_karyawan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data diklat karyawan");
        }

        Redis::del("diklat_karyawan:all");
        Redis::del("diklat_karyawan:$id");

        return $this->returnController("ok", "success delete data diklat karyawan");
    }

    public function pangkat_create(Request $req){
        $riwayat_pangkat = New riwayat_pangkat;
        
        // decrypt uuid from $req
        $karyawan_id = HCrypt::decrypt($req->id);
        $pangkat_id = HCrypt::decrypt($req->pangkat_id);

        $riwayat_pangkat->karyawan_id      =  $karyawan_id;
        $riwayat_pangkat->pangkat_id    =  $pangkat_id;
        $riwayat_pangkat->tahun    =  $tahun;

        $riwayat_pangkat->save();
        
        $riwayat_pangkat_id= $riwayat_pangkat->id;
        
        $uuid = HCrypt::encrypt($riwayat_pangkat_id);
        $setuuid = riwayat_pangkat::findOrFail($riwayat_pangkat_id);
        $setuuid->uuid = $uuid;
            
        $setuuid->update();

        if (!$riwayat_pangkat) {
            return $this->returnController("error", "failed create data pangkat karyawan");
        }

        Redis::del("riwayat_pangkat:all");
        Redis::set("riwayat_pangkat:all",$riwayat_pangkat);
        return $this->returnController("ok", $riwayat_pangkat);
    }

    public function pangkat_get($uuid){
        $karyawan_id = HCrypt::decrypt($uuid);
        $riwayat_pangkat = json_decode(redis::get("riwayat_pangkat::all"));
        if (!$riwayat_pangkat) {
            $riwayat_pangkat = riwayat_pangkat::with('golongan')->where('karyawan_id', $karyawan_id)->get();
            if (!$riwayat_pangkat) {
                return $this->returnController("error", "failed get pangkat riwayat_pangkat data");
            }
            Redis::set("riwayat_pangkat:all", $riwayat_pangkat);
        }
        return $this->returnController("ok", $riwayat_pangkat);
    }

    public function pangkat_delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $riwayat_pangkat = riwayat_pangkat::find($id);
        if (!$riwayat_pangkat) {
            return $this->returnController("error", "failed find data pangkat karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $riwayat_pangkat->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pangkat karyawan");
        }

        Redis::del("riwayat_pangkat:all");
        Redis::del("riwayat_pangkat:$id");

        return $this->returnController("ok", "success delete data pangkat karyawan");
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);

        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $karyawan = karyawan::findOrFail($id);
        
        if (!$karyawan){
                return $this->returnController("error", "failed find data pelanggan");
            }
        // decrypt uuid from $req
        $unit_kerja_id = HCrypt::decrypt($req->unit_kerja_id);
        $golongan_id = HCrypt::decrypt($req->golongan_id);
        $jabatan_id = HCrypt::decrypt($req->jabatan_id);

        $karyawan->unit_kerja_id    =  $unit_kerja_id;
        $karyawan->golongan_id      =  $golongan_id;
        $karyawan->jabatan_id       =  $jabatan_id;
        $karyawan->NIP              =  $req->NIP;
        $karyawan->nama             =  $req->nama;
        $karyawan->tempat_lahir     =  $req->tempat_lahir;
        $karyawan->tanggal_lahir    =  $req->tanggal_lahir;
        $karyawan->alamat           =  $req->alamat;
        $karyawan->jk               =  $req->jk;
        $karyawan->status_pegawai   =  $req->status_pegawai;
        $karyawan->status_kawin     =  $req->status_kawin;
        $karyawan->golongan_darah   =  $req->golongan_darah;
        if($req->foto != null){
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $req->NIP.' - '.$karyawan->nama;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/karyawan', $foto);
            $karyawan->foto       = $foto;
        }else{
            $karyawan->foto       = $karyawan->foto;
        }

        $karyawan->update();
    
            
        if (!$karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }
        $karyawan = karyawan::with('unit_kerja','golongan','jabatan')->where('id',$id)->first();
        Redis::del("karyawan:all");
        Redis::set("karyawan:$id", $karyawan);

        return $this->returnController("ok", $karyawan); 
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $karyawan = karyawan::find($id);
        if (!$karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $image_path = "img/karyawan/".$karyawan->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $karyawan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data karyawan");
        }

        Redis::del("karyawan:all");
        Redis::del("karyawan:$id");

        return $this->returnController("ok", "success delete data karyawan");
    }
}
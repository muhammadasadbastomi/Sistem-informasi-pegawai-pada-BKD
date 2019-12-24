<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
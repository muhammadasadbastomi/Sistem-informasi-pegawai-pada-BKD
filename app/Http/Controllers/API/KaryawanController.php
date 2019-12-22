<?php

namespace App\Http\Controllers\API;

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
            $karyawan = karyawan::with('unit_kerja')->get();
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
            $karyawan = karyawan::with('unit_kerja')->where('id',$id)->first();
            if (!$karyawan){
                return $this->returnController("error", "failed find data karyawan");
            }
            Redis::set("karyawan:$id", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }

    public function create(Request $req){
        $unit_kerja_id = HCrypt::decrypt($req->unit_kerja_id);
        $unit_kerja = Unit_kerja::findOrFail($unit_kerja_id);

        $karyawan = $unit_kerja->karyawan()->create($req->all());
        
        $karyawan_id= $karyawan->id;
        
        $uuid = HCrypt::encrypt($karyawan_id);
        $setuuid = Karyawan::findOrFail($karyawan_id);
        $setuuid->uuid = $uuid;
        if($req->foto != null){
            $FotoExt  = $req->foto->getClientOriginalExtension();
            $FotoName = $karyawan_id.' - '.$req->nama;
            $foto   = $FotoName.'.'.$FotoExt;
            $req->foto->move('images/karyawan', $foto);
            $setuuid->foto       = $foto;
            }else {
                $setuuid->foto       = 'default.jpg';
            }

        $setuuid->update();

        if (!$karyawan) {
            return $this->returnController("error", "failed create data karyawan");
        }

        Redis::del("karyawan:all");
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
        $karyawan->fill($req->all())->save();
        
        $foto = karyawan::findOrFail($id);
        if($req->foto != null){
                $FotoExt  = $req->foto->getClientOriginalExtension();
                $FotoName = $karyawan->id.' - '.$req->nama;
                $foto   = $FotoName.'.'.$FotoExt;
                $req->foto->move('images/karyawan', $foto);
                $foto->foto       = $foto;
                }else {
                    $karyawan->foto  = $karyawan->foto;
                }
        $foto->update();
            // $karyawan->nama            = $req->nama;
            // $karyawan->NIP            = $req->NIP;
            // $karyawan->tempat_lahir    = $req->tempat_lahir;
            // $karyawan->tanggal_lahir    = $req->tanggal_lahir;
            // $karyawan->alamat    = $req->alamat;
            // $karyawan->jk    = $req->jk;
            // $karyawan->agama    = $req->agama;
            // $karyawan->status_pegawai    = $req->status_pegawai;
            // $karyawan->status_kawin    = $req->status_kawin;
            // $karyawan->golongan_darah    = $req->golongan_darah;
        //    $karyawan->update();
           
        if (!$karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }
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
        $karyawan = karyawan::find($karyawan->karyawan_id);
        if (!$karyawan) {
            return $this->returnController("error", "failed find data karyawan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $delete = $karyawan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data karyawan");
        }

        Redis::del("karyawan:all");
        Redis::del("karyawan:$karyawan->karyawan_id");

        return $this->returnController("ok", "success delete data karyawan");
    }
}
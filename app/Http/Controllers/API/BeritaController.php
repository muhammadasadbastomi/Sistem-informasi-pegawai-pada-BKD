<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Berita;
use HCrypt;

class BeritaController extends APIController
{
    public function get(){
        $berita = json_decode(redis::get("berita::all"));
        if (!$berita) {
            $berita = berita::with('karyawan')->get();
            if (!$berita) {
                return $this->returnController("error", "failed get berita data");
            }
            Redis::set("berita:all", $berita);
        }
        return $this->returnController("ok", $berita);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $berita = Redis::get("berita:$id");
        if (!$berita) {
            $berita = berita::with('karyawan')->where('id',$id)->first();
            if (!$berita){
                return $this->returnController("error", "failed find data berita");
            }
            Redis::set("berita:$id", $berita);
        }
        return $this->returnController("ok", $berita);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $berita = new berita;
        // decrypt foreign key id
        $id = Auth::id();
        $berita->karyawan_id = $id;
        $berita->judul = $req->judul;
        if($req->foto != null){
            $FotoExt  = $req->foto->getClientOriginalExtension();
            $FotoName = $req->judul.' - '.$id;
            $foto   = $FotoName.'.'.$FotoExt;
            $req->foto->move('images/berita', $foto);
            $berita->foto       = $foto;
            }else {
                $berita->foto  = $berita->foto;
            }
        $berita->isi = $req->isi;

        $berita->save();

        //set uuid
        $berita_id = $berita->id;
        $uuid = HCrypt::encrypt($berita_id);
        $setuuid = berita::findOrFail($berita_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$berita) {
            return $this->returnController("error", "failed create data berita");
        }
        Redis::del("berita:all");
        Redis::set("berita:all", $berita);
        return $this->returnController("ok", $berita);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $berita = berita::findOrFail($id);
        $id = Auth::id();
        $berita->karyawan_id = $id;
        $berita->judul = $req->judul;
        if($req->foto != null){
            $FotoExt  = $req->foto->getClientOriginalExtension();
            $FotoName = $req->judul.' - '.$id;
            $foto   = $FotoName.'.'.$FotoExt;
            $req->foto->move('images/berita', $foto);
            $berita->foto       = $foto;
            }else {
            }
        $berita->isi = $req->isi;
        $berita->update();
        if (!$berita) {
            return $this->returnController("error", "failed find data berita");
        }
        $berita = berita::with('karyawan')->where('id',$id)->first();
        Redis::del("berita:all");
        Redis::set("berita:$id", $berita);
        return $this->returnController("ok", $berita);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $berita = berita::find($id);
        if (!$berita) {
            return $this->returnController("error", "failed find data berita");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $berita->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data berita");
        }
        Redis::del("berita:all");
        Redis::del("berita:$id");
        return $this->returnController("ok", "success delete data berita");
    }
}

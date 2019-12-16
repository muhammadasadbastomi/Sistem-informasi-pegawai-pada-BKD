<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instansi;
use HCrypt;

class InstansiController extends APIController
{
    public function get(){
        $instansi = json_decode(redis::get("instansi::all"));
        if (!$instansi) {
            $instansi = instansi::all();
            if (!$instansi) {
                return $this->returnController("error", "failed get instansi data");
            }
            Redis::set("instansi:all", $instansi);
        }
        return $this->returnController("ok", $instansi);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $instansi = Redis::get("instansi:$id");
        if (!$instansi) {
            $instansi = instansi::with('kelurahan')->where('id',$id)->first();
            if (!$instansi){
                return $this->returnController("error", "failed find data instansi");
            }
            Redis::set("instansi:$id", $instansi);
        }
        return $this->returnController("ok", $instansi);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $instansi = new instansi;
        // decrypt foreign key id
        $instansi->kelurahan_id = Hcrypt::decrypt($req->kelurahan_id);
        $instansi->kode_instansi = $req->kode_instansi;
        $instansi->nama = $req->nama;
        $instansi->alamat = $req->alamat;

        $instansi->save();

        //set uuid
        $instansi_id = $instansi->id;
        $uuid = HCrypt::encrypt($instansi_id);
        $setuuid = instansi::findOrFail($instansi_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$instansi) {
            return $this->returnController("error", "failed create data instansi");
        }
        Redis::del("instansi:all");
        Redis::set("instansi:all", $instansi);
        return $this->returnController("ok", $instansi);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $instansi = instansi::findOrFail($id);
        $instansi->kelurahan_id = Hcrypt::decrypt($req->kelurahan_id);
        $instansi->kode_instansi = $req->kode_instansi;
        $instansi->nama = $req->nama;
        $instansi->alamat = $req->alamat;
        $instansi->update();
        if (!$instansi) {
            return $this->returnController("error", "failed find data instansi");
        }
        $instansi = instansi::with('kelurahan')->where('id',$id)->first();
        Redis::del("instansi:all");
        Redis::set("instansi:$id", $instansi);
        return $this->returnController("ok", $instansi);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $instansi = instansi::find($id);
        if (!$instansi) {
            return $this->returnController("error", "failed find data instansi");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $instansi->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data instansi");
        }
        Redis::del("instansi:all");
        Redis::del("instansi:$id");
        return $this->returnController("ok", "success delete data instansi");
    }
}

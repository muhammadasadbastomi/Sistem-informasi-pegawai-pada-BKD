<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit_kerja;
use HCrypt;

class UnitController extends APIController
{
    public function get(){
        $unit_kerja = json_decode(redis::get("unit_kerja::all"));
        if (!$unit_kerja) {
            $unit_kerja = unit_kerja::with('instansi')->get();
            if (!$unit_kerja) {
                return $this->returnController("error", "failed get unit kerja data");
            }
            Redis::set("unit_kerja:all", $unit_kerja);
        }
        return $this->returnController("ok", $unit_kerja);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $unit_kerja = Redis::get("unit_kerja:$id");
        if (!$unit_kerja) {
            $unit_kerja = unit_kerja::with('instansi')->where('id',$id)->first();
            if (!$unit_kerja){
                return $this->returnController("error", "failed find data unit kerja");
            }
            Redis::set("unit_kerja:$id", $unit_kerja);
        }
        return $this->returnController("ok", $unit_kerja);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $unit_kerja = new unit_kerja;
        // decrypt foreign key id
        $unit_kerja->instansi_id = Hcrypt::decrypt($req->instansi_id);
        $unit_kerja->kode_unit = $req->kode_unit;
        $unit_kerja->nama = $req->nama;
        $unit_kerja->alamat = $req->alamat;

        $unit_kerja->save();

        //set uuid
        $unit_kerja_id = $unit_kerja->id;
        $uuid = HCrypt::encrypt($unit_kerja_id);
        $setuuid = unit_kerja::findOrFail($unit_kerja_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$unit_kerja) {
            return $this->returnController("error", "failed create data unit kerja");
        }
        Redis::del("unit_kerja:all");
        Redis::set("unit_kerja:all", $unit_kerja);
        return $this->returnController("ok", $unit_kerja);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $unit_kerja = unit_kerja::findOrFail($id);
        $unit_kerja->instansi_id = Hcrypt::decrypt($req->instansi_id);
        $unit_kerja->kode_unit = $req->kode_unit;
        $unit_kerja->nama = $req->nama;
        $unit_kerja->alamat = $req->alamat;
        $unit_kerja->update();
        if (!$unit_kerja) {
            return $this->returnController("error", "failed find data unit kerja");
        }
        $unit_kerja = unit_kerja::with('instansi')->where('id',$id)->first();
        Redis::del("unit_kerja:all");
        Redis::set("unit_kerja:$id", $unit_kerja);
        return $this->returnController("ok", $unit_kerja);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $unit_kerja = unit_kerja::find($id);
        if (!$unit_kerja) {
            return $this->returnController("error", "failed find data unit kerja");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $unit_kerja->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data unit kerja");
        }
        Redis::del("unit_kerja:all");
        Redis::del("unit_kerja:$id");
        return $this->returnController("ok", "success delete data unit kerja");
    }
}

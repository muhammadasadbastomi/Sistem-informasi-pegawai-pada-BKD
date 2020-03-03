<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as ApiRequest;
use App\Kecamatan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class kecamatanController extends APIController
{
    public function get(){
        $kecamatan = json_decode(redis::get("kecamatan::all"));
        if (!$kecamatan) {
            $kecamatan = kecamatan::all();
            if (!$kecamatan) {
                return $this->returnController("error", "failed get kecamatan data");
            }
            Redis::set("kecamatan:all", $kecamatan);
        }
        return $this->returnController("ok", $kecamatan);
        }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kecamatan = Redis::get("kecamatan:$id");
        if (!$kecamatan) {
            $kecamatan = kecamatan::find($id);
            if (!$kecamatan){
                return $this->returnController("error", "failed find data kecamatan");
            }
            Redis::set("kecamatan:$id", $kecamatan);
        }
        return $this->returnController("ok", $kecamatan);
    }

    public function create(Request $req){

        $cekValidasi = Validator::make(ApiRequest::all(), [

            'kode_kecamatan' => 'required|unique:kecamatans',

        ]);

        $message = 'Kode kecamatan tidak boleh sama ';
        if ($cekValidasi->fails()) {
            return response()->json([
                'Error' => $message
            ],202);
        }

        $kecamatan = kecamatan::create($req->all());
        //set uuid
        $kecamatan_id = $kecamatan->id;
        $uuid = HCrypt::encrypt($kecamatan_id);
        $setuuid = kecamatan::findOrFail($kecamatan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$kecamatan) {
            return $this->returnController("error", "failed create data kecamatan");
        }
        Redis::del("kecamatan:all");
        Redis::set("kecamatan:all", $kecamatan);
        return $this->returnController("ok", $kecamatan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $kecamatan = kecamatan::findOrFail($id);

        if (!$kecamatan) {
            return $this->returnController("error", "failed find data kecamatan");
        }

        $kecamatan->fill($req->all())->save();

        Redis::del("kecamatan:all");
        Redis::set("kecamatan:$id", $kecamatan);
        return $this->returnController("ok", $kecamatan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kecamatan = kecamatan::findOrFail($id);
        if (!$kecamatan) {
            return $this->returnController("error", "failed find data kecamatan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $kecamatan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data kecamatan");
        }
        Redis::del("kecamatan:all");
        Redis::del("kecamatan:$id");
        return $this->returnController("ok", "success delete data kecamatan");
    }
}

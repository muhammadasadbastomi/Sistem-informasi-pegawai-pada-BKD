<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Request as ApiRequest;
use App\Kelurahan;
use HCrypt;

class KelurahanController extends APIController
{
    public function get(){
        $kelurahan = json_decode(redis::get("kelurahan::all"));
        if (!$kelurahan) {
            $kelurahan = kelurahan::with('kecamatan')->get();
            if (!$kelurahan) {
                return $this->returnController("error", "failed get kelurahan data");
            }
            Redis::set("kelurahan:all", $kelurahan);
        }
        return $this->returnController("ok", $kelurahan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kelurahan = Redis::get("kelurahan:$id");
        if (!$kelurahan) {
            $kelurahan = kelurahan::with('kecamatan')->where('id',$id)->first();
            if (!$kelurahan){
                return $this->returnController("error", "failed find data kelurahan");
            }
            Redis::set("kelurahan:$id", $kelurahan);
        }
        return $this->returnController("ok", $kelurahan);
    }

    public function create(Request $req){

        $cekValidasi = Validator::make(ApiRequest::all(), [

            'kode_kelurahan' => 'required|unique:kelurahans',

        ]);

        $message = 'Kode kelurahan tidak boleh sama ';
        if ($cekValidasi->fails()) {
            return response()->json([
                'Error' => $message
            ],202);
        }

        $kelurahan = new kelurahan;
        // decrypt foreign key id
        $kelurahan->kecamatan_id = Hcrypt::decrypt($req->kecamatan_id);
        $kelurahan->kode_kelurahan = $req->kode_kelurahan;
        $kelurahan->kelurahan = $req->kelurahan;

        $kelurahan->save();

        //set uuid
        $kelurahan_id = $kelurahan->id;
        $uuid = HCrypt::encrypt($kelurahan_id);
        $setuuid = kelurahan::findOrFail($kelurahan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$kelurahan) {
            return $this->returnController("error", "failed create data kelurahan");
        }
        Redis::del("kelurahan:all");
        Redis::set("kelurahan:all", $kelurahan);
        return $this->returnController("ok", $kelurahan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kelurahan = kelurahan::findOrFail($id);
        $kelurahan->kecamatan_id = Hcrypt::decrypt($req->kecamatan_id);
        $kelurahan->kode_kelurahan = $req->kode_kelurahan;
        $kelurahan->kelurahan = $req->kelurahan;
        $kelurahan->update();
        if (!$kelurahan) {
            return $this->returnController("error", "failed find data kelurahan");
        }
        $kelurahan = kelurahan::with('kecamatan')->where('id',$id)->first();
        Redis::del("kelurahan:all");
        Redis::set("kelurahan:$id", $kelurahan);
        return $this->returnController("ok", $kelurahan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kelurahan = kelurahan::find($id);
        if (!$kelurahan) {
            return $this->returnController("error", "failed find data kelurahan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $kelurahan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data kelurahan");
        }
        Redis::del("kelurahan:all");
        Redis::del("kelurahan:$id");
        return $this->returnController("ok", "success delete data kelurahan");
    }
}

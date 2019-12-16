<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pendidikan;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class PendidikanController extends APIController
{
    public function get(){
        $pendidikan = json_decode(redis::get("pendidikan::all"));
        if (!$pendidikan) {
            $pendidikan = pendidikan::all();
            if (!$pendidikan) {
                return $this->returnController("error", "failed get pendidikan data");
            }
            Redis::set("pendidikan:all", $pendidikan);
        }
        return $this->returnController("ok", $pendidikan);
        }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pendidikan = Redis::get("pendidikan:$id");
        if (!$pendidikan) {
            $pendidikan = pendidikan::find($id);
            if (!$pendidikan){
                return $this->returnController("error", "failed find data pendidikan");
            }
            Redis::set("pendidikan:$id", $pendidikan);
        }
        return $this->returnController("ok", $pendidikan);
    }

    public function create(Request $req){
        $pendidikan = pendidikan::create($req->all());
        //set uuid
        $pendidikan_id = $pendidikan->id;
        $uuid = HCrypt::encrypt($pendidikan_id);
        $setuuid = pendidikan::findOrFail($pendidikan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$pendidikan) {
            return $this->returnController("error", "failed create data pendidikan");
        }
        Redis::del("pendidikan:all");
        Redis::set("pendidikan:all", $pendidikan);
        return $this->returnController("ok", $pendidikan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pendidikan = pendidikan::findOrFail($id);

        if (!$pendidikan) {
            return $this->returnController("error", "failed find data pendidikan");
        }
        
        $pendidikan->fill($req->all())->save();

        Redis::del("pendidikan:all");
        Redis::set("pendidikan:$id", $pendidikan);
        return $this->returnController("ok", $pendidikan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $pendidikan = pendidikan::findOrFail($id);
        if (!$pendidikan) {
            return $this->returnController("error", "failed find data pendidikan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $pendidikan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pendidikan");
        }
        Redis::del("pendidikan:all");
        Redis::del("pendidikan:$id");
        return $this->returnController("ok", "success delete data pendidikan");
    }
}

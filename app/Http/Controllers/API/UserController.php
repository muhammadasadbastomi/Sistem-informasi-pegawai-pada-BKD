<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\User;
use HCrypt;
use Hash;

class UserController extends APIController
{
    public function get(){
        $user = json_decode(redis::get("user::all"));
        if (!$user) {
            $user = user::all();
            if (!$user) {
                return $this->returnController("error", "failed get user data");
            }
            Redis::set("user:all", $user);
        }
        return $this->returnController("ok", $user);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $user = Redis::get("user:$id");
        if (!$user) {
            $user = user::findOrFail($id);
            if (!$user){
                return $this->returnController("error", "failed find data user");
            }
            Redis::set("user:$id", $user);
        }
        return $this->returnController("ok", $user);
    }

    public function create(Request $req){
        $user = User::create($req->all());
        
        $user_id= $user->id;
        $uuid = HCrypt::encrypt($user_id);
        $setuuid = User::findOrFail($user_id);
        $setuuid->uuid = $uuid;
        if($req->foto != null)
        {
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $user_id.' - '.$req->username;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/user', $foto);
            $setuuid->foto       = $foto;
        }else{
            
        }
        $setuuid->password = Hash::make($setuuid->password);

        $setuuid->update();

        if (!$user) {
            return $this->returnController("error", "failed create data user");
        }

        Redis::del("user:all");
        Redis::set("user:all",$user);
        return $this->returnController("ok", $user);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $user = User::findOrFail($id);
        if (!$user){
                return $this->returnController("error", "failed find data user");
            }
        
        $user = user::findOrFail($id);
        $user->username    =  $req->username;
        if($req->password != null){
            $user->password      =  Hash::make($req->password);    
        }else{
            $user->password      =  $user->password;
        }
        
        if($req->foto != null){
            $img = $req->file('foto');
            $FotoExt  = $img->getClientOriginalExtension();
            $FotoName = $user->id.' - '.$req->username;
            $foto   = $FotoName.'.'.$FotoExt;
            $img->move('img/user', $foto);
            $user->foto       = $foto;
        }else{
                $user->foto       = $user->foto;
        }
        $user->update();
        
        if (!$user){
            return $this->returnController("error", "failed update data user");
        }

        Redis::del("user:all");
        Redis::set("user:$id", $user);

        return $this->returnController("ok", $user);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $user = user::find($id);
        if (!$user) {
            return $this->returnController("error", "failed find data user");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $image_path = "img/user/".$user->foto;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
        File::delete($image_path);
        }
        $delete = $user->delete();
        
        if (!$delete) {
            return $this->returnController("error", "failed delete data user");
        }

        Redis::del("user:all");
        Redis::del("user:$id");

        return $this->returnController("ok", "success delete data user");
    }
}
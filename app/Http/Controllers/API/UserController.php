<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use HCrypt;

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
        $user = new User;

        if($req->foto != null){
            $FotoExt  = $req->foto->getClientOriginalExtension();
            $FotoName = $id.' - '.$req->name;
            $foto   = $FotoName.'.'.$FotoExt;
            $req->foto->move('images/user', $foto);
            $user->foto       = $foto;
            }else {
                
            }
            
        $user->name            = $req->name;
        $user->email    = $req->email;
        if($req->password != null){
            $password       = Hash::make($req->password);
            $user->password = $password;
        }else{
            $user->password = $user->password;
        }

        $user->save();

        $user_id= $user->id;
        $uuid = HCrypt::encrypt($user_id);
        $setuuid = User::findOrFail($user_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();

        if (!$user) {
            return $this->returnController("error", "failed create data user");
        }

        Redis::del("user:all");
        Redis::set("user:all");
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
        if($req->foto != null){
            $FotoExt  = $req->foto->getClientOriginalExtension();
            $FotoName = $id.' - '.$req->name;
            $foto   = $FotoName.'.'.$FotoExt;
            $req->foto->move('images/user', $foto);
            $user->foto       = $foto;
            }else {
                $user->foto  = $user->foto;
            }

        $user->name            = $req->name;
        $user->email    = $req->email;
        if($req->password != null){
            $password       = Hash::make($req->password);
            $user->password = $password;
        }else{
            $user->password = $user->password;
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

        $delete = $user->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data user");
        }

        Redis::del("user:all");
        Redis::del("user:$id");

        return $this->returnController("ok", "success delete data user");
    }
}
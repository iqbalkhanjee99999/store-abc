<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    public function addUser($data){
        DB::table('users')
            ->insert([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'phone_no'  => $data['phone_no'],
                'address'   => $data['address'],
                'user_type' => 1,
                'password'  => Hash::make('User123!')
            ]);
    }

    public function addStoreKeeper($data){
        DB::table('users')
            ->insert([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'phone_no'  => $data['phone_no'],
                'address'   => $data['address'],
                'user_type' => 3,
                'password'  => Hash::make('User123!')
            ]);
    }

    public function getAllUsers(){
       $q =  DB::table('users');
            if(Auth::user()->user_type != 1001){
                $q->where('user_type',1);
            }else{
                $q->where('user_type','!=',1001);
            }
           $q->orderBy('id','desc');
           $data = $q->get();
       return $data;
    }

    public function getUser($id){
        $data=  DB::table('users')
            ->where('id',$id)
            ->first();
        return $data;
    }
    public function getAllEngineers(){
        $data = DB::table('users')
                ->where('user_type', 1)
                ->select('id','name','email','phone_no','address')
                ->get();
        return $data;
    }
    public function getAllStoreKeepers(){
        $data = DB::table('users')
                ->where('user_type', 3)
                ->select('id','name','email','phone_no','address')
                ->get();
        return $data;
    }

    public function updateUser($data){
        DB::table('users')
            ->where('id',$data['user_id'])
            ->update([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'phone_no'  => $data['phone_no'],
                'address'   => $data['address'],
            ]);
    }

    public function resetPassword($id){
        DB::table('users')
            ->where('id',$id)
            ->update([
                'password' =>  Hash::make('User123!')
            ]);
    }

    public function getCountAllUsers(){
        $data = User::count();
        return $data;
    }

    public function checkUser($id){
        $count = DB::table('request_goods')
            ->where('user_id',$id)
            ->where('store_approval',0)
            ->where('proc_approval','!=',2)
            ->count();
        return $count;
    }

    public function deleteEngineer($id){
        DB::table('users')
            ->where('id',$id)
            ->delete();
    }

    public function getPassword($id){
        $data = DB::table('users')
            ->where('id',$id)
            ->select('password')
        ->first();
        return $data->password;
    }

    public function changePassword($new_password){
        DB::table('users')
            ->where('id',Auth::user()->id)
            ->update([
                'password' =>  Hash::make($new_password)
            ]);
    }
}

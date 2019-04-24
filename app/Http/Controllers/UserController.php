<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function engineers(){
        $user = new User();
        $data = $user->getAllEngineers();

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2){
            return view('users.engineers')->with('data',$data);
        }else{
            return redirect('/home');
        }
    }
    public function storeKeepers(){
        $user = new User();
        $data = $user->getAllStoreKeepers();

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2){
            return view('users.storeKeepers')->with('data',$data);
        }else{
            return redirect('/home');
        }
    }
    public function addEngineer($id = 0){

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2){
            if($id != 0){
                $user = new User();
                $data = $user->getUser($id);

                return view('users.addEngineer')->with('data',$data);
                }
                else{
                    return view('users.addEngineer');
                }
            }else{
                return redirect('/home');
            }

    }
    public function addStoreKeeper($id = 0){

        if(Auth::user()->user_type == 1001 || Auth::user()->user_type == 2){
            if($id != 0){
                $user = new User();
                $data = $user->getUser($id);

                return view('users.addStoreKeeper')->with('data',$data);
                }
                else{
                    return view('users.addStoreKeeper');
                }
            }else{
                return redirect('/home');
            }

    }

    public function saveEngineer(Request $request){
        if(isset($request->user_id)){
            $unique = '';
        }
        else{
            $unique = "|unique:users";
        }
        $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|max:255|email'.$unique,
            'phone_no'      => 'required|numeric||max:1000000000000',
            'address'       => 'required'
        ]);

        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['phone_no']   = $request->phone_no;
        $data['address']    = $request->address;


        $user = new User();
        if(isset($request->user_id)){
            $data['user_id'] = $request->user_id;
            $user->updateUser($data);
        }
        else{
            $data['user_type'] = 1;
            $user->addUser($data);
        }


        return redirect('users/engineers');
    }
    public function saveStoreKeeper(Request $request){
        if(isset($request->user_id)){
            $unique = '';
        }
        else{
            $unique = "|unique:users";
        }
        $request->validate([
            'name'          => 'required|max:255',
            'email'         => 'required|max:255|email'.$unique,
            'phone_no'      => 'required|numeric||max:1000000000000',
            'address'       => 'required'
        ]);

        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['phone_no']   = $request->phone_no;
        $data['address']    = $request->address;


        $user = new User();
        if(isset($request->user_id)){
            $data['user_id'] = $request->user_id;
            $user->updateUser($data);
        }
        else{
            $data['user_type'] = 1;
            $user->addStoreKeeper($data);
        }


        return redirect('users/storeKeepers');
    }

    public function resetPassword($id){
        $user = new User();
        $user->resetPassword($id);
    }

    public function deleteUser($id){
        $user   = new User();
        $check  = $user->checkUser($id);

        if($check > 0){
            return redirect()->back()->with('error','Cant Delete User. Current User Pending Has Orders');
        }else{
            $user->deleteEngineer($id);
            return redirect()->back()->with('success','User Deleted Successfully');
        }

    }

    public function changePassword(){

        return view('users.changePassword');
    }

    public function updatePassword(Request $request){

        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;

        $user = new User();
        $password = $user->getPassword(Auth::user()->id);
        $request->validate([
           'old_password'       => 'required' ,
           'new_password'       => 'required' ,
           'confirm_password'   => 'required'
        ]);

        if (Hash::check($old_password, $password)) {
            if($new_password == $confirm_password){
                $user->changePassword($new_password);

                return redirect()->back()->with('success','Password Changed Successfully!');
            }
            else{
                return redirect()->back()->with('error','Passwords Not Matched!');
            }
        }else{
            return redirect()->back()->with('error','Incorrect Old Password!');
        }
    }
}

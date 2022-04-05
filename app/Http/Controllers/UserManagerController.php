<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagerController extends Controller
{
    public function users(){
        $users = User::all();
        return view('user-management.user-manager',compact('users'));
    }

    public function makeAdmin(Request $request){
        $user = Auth::user()->find($request->id);
        if($user || $user->role == 1){
            $user->role = '0';
            $user->update();
            return redirect()->route('user-manager.users')->with('toast',['icon'=>'success','title'=>$user->name .' is become an admin.']);
        }else{
            return redirect()->route('user-manager.users')->with('toast',['icon'=>'error','title'=>'Something went wrong.']);
        }
    }

    public function banUser(Request $request){
        $user = Auth::user()->find($request->id);
        if($user || $user->is_baned == 0){
            $user->is_baned = '1';
            $user->update();
            return redirect()->route('user-manager.users')->with('toast',['icon'=>'success','title'=>$user->name .' is baned.']);
        }else{
            return redirect()->route('user-manager.users')->with('toast',['icon'=>'error','title'=>'Something went wrong.']);
        }
    }

    public function restoreUser(Request $request){
        $user = Auth::user()->find($request->id);
        if($user || $user->is_baned == 1){
            $user->is_baned = '0';
            $user->update();
            return redirect()->route('user-manager.users')->with('toast',['icon'=>'success','title'=>$user->name .' is restored.']);
        }else{
            return redirect()->route('user-manager.users')->with('toast',['icon'=>'error','title'=>'Something went wrong.']);
        }
    }

    public function changeUserPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'password'=>'required|String|min:8',
        ]);
        if($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        }
        $currentUser = User::find($request->id);
        if($currentUser->role == 1){
            $currentUser->password = Hash::make($request->password);
            $currentUser->update();
        }
        return response()->json(["status"=>200,"message"=>$currentUser->name."'s password is completely changed."]);
    }

}

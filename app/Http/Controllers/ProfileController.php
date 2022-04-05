<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view("user-profile.profile");
    }

    public function editPhoto(){
        return view('user-profile.edit-photo');
    }

    public function editPassword(){
        return view('user-profile.edit-password');
    }

    public function editNameEmail(){
        return view('user-profile.edit-name-email');
    }

    public function changePassword(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required','min:8','different:current_password'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
//        Auth::logout();
        return redirect()->route('profile.edit.password')->with('toast',['icon'=>'success','title'=>'Password has been changed.']);;

    }

    public function changeInformation(Request $request){

        $request->validate([
            'name' => "min:3|max:50",
            'email' => [
                'min:3',
                'max:50',
                Rule::unique('users', 'email')->ignore(Auth::user())
            ],
            'phone' => [
                'numeric',
                'min:11',
                Rule::unique('users', 'phone')->ignore(Auth::user())
            ],
            'address'=> 'min:10',
            'check'=>'required',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->update();
        return redirect()->route("profile.edit.name.email")->with('toast',['icon'=>'success','title'=>'Information has been updated.']);
    }


    public function changePhoto(Request $request){
        $request->validate([
            "photo" => "required|mimetypes:image/jpeg,image/png|dimensions:ratio=1/1|file|max:2500"
        ]);
        $dir="public/profile/";

        Storage::delete($dir.Auth::user()->photo);

        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->update();

        return redirect()->route("profile.edit.photo")->with('toast',['icon'=>'success','title'=>'Your profile has been updated.']);

    }
    public function updateInfo(Request $request){
        $currentUserId = Auth::user()->id;
        $currentUser = User::find($currentUserId);
        $request->validate([
            'phone'=> 'required|numeric|min:11|unique:users',
            'address'=> 'required|min:10',
        ]);
        $currentUser->phone = $request->phone;
        $currentUser->address = $request->address;
        $currentUser->update();
        return redirect()->back()->with('toast',['icon'=>'success','title'=>'Information has been updated.']);
    }
}

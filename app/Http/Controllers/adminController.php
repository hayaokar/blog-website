<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function Profile(){

        $user = Auth::user();

        return view('admin.admin_profile_view',compact('user'));

    }

    public function editProfile(){

        $user = Auth::user();

        return view('admin.admin_edit_view',compact('user'));

    }

    public function storeProfile(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if($request->file('profile_image')) {
            $file = $request->file('profile_image');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $user['profile_image'] = $filename;

        }
        $user->save();

        $notification = array(
            'message' => 'Admin Profile Updates Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);

    }

    public function changePassword(){
        return view('admin.change_password_view');
    }

    public function updatePassword(Request $request){

        $validateData = $request->validate([
           'oldpassword' => 'required',
           'newpassword' => 'required',
           'confirm_password' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
        }
        else{
            session()->flash('message','Old Password is not match');
            return redirect()->back();
        }
    }




}

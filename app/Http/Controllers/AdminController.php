<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function adminLogin()
    {
        return view('admin.admin_login');
    }

    public function adminProfile()
    {
        $user =Auth::user();
        return view('admin.admin_profile',compact('user'));
    }

    public function adminProfileUpdate(Request $request)
    {

       $user = Auth::user();
        (new User())->updateUserProfile($request,$user);

        $notification = [
          'message'    => 'Admin Profile update Successfully',
          'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function adminProfileChangePassword()
    {
        return view('admin.change_password');
    }


    public function adminProfileChangePasswordStore(Request $request)
    {
        $request->validate([
           'old_password' => 'required',
           'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password,auth()->user()->password))
        {
            return back()->with('error','Old Password Dose not Match');

        }
        $user =Auth::user();
        $user->update(
            [
                'password'=>Hash::make($request->new_password)
            ]
        );
        $notification = [
            'message'    => 'Password Chage Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


}

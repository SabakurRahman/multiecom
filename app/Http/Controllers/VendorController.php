<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
   public function index()
   {
       return view('vendor.dashboard');
   }
   public function vendorLogin()
   {
       return view('vendor.login');
   }
    public function vendorProfile()
    {
         return view('vendor.profile');
    }
    public function vendorProfileUpdate(Request $request)
    {
        $user = Auth::user();
        (new User())->updateUserProfile($request,$user);

        $notification = [
          'message'    => 'Vendor Profile update Successfully',
          'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function vendorProfileChangePassword()
    {
        return view('vendor.change_password');
    }
    public function vendorProfileChangePasswordStore(Request $request)
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
                'password' => Hash::make($request->new_password)
            ]
        );
        $notification = [
            'message'    => 'Password Change Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function vendorLogout()
    {
        Auth::logout();
        return redirect()->route('vendor.login');
    }



}

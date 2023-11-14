<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $id=auth()->user()->id;
        $userData=User::find($id);
        return view('index',compact('userData'));
    }

    public function userProfileUpdate(Request $request)
    {
        $id=auth()->user()->id;
        $user=User::find($id);
        $user = $this->user->updateUserProfile($request, $user);
        $notification = [
            'message'    => 'User Profile update Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function userProfileLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message'    => 'User Logout Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('login')->with($notification);
    }

    public function userProfileChangePassword(Request $request)
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

}

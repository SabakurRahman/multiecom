<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }


}

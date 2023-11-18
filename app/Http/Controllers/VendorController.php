<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->vendor = new Vendor();
    }
   public function index()
   {
       return view('vendor.dashboard');
   }
   public function vendorLogin()
   {
       return view('vendor.login');
   }

   public function vendorList()
   {
         $vendors = Vendor::query()->with('user')->paginate(10);
         return view('vendor.vendorList',compact('vendors'));
   }

   public function vendorRegister()
   {
         return view('vendor.register');
   }

   public function storeVendor(Request $request)
   {
       $request->validate([
           'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
           'password' => ['required', 'confirmed'],
       ]);

            $user = User::create([
           'email'    => $request->email,
           'username' => $request->username,
           'phone'    => $request->phone,
           'password' => Hash::make($request->password),
            'role'    => 'vendor',
           'status'   => User::STATUS_INACTIVE,

       ]);

       $this->vendor->createVendor($request,$user);

         $notification = [
              'message'    => 'Vendor Register Successfully',
              'alert-type' => 'success'
         ];
            return redirect()->route('vendor.register')->with($notification);




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

    public function vendorUpdate(Request $request)
    {
        $vendor = Vendor::query()->with('user')->findOrFail($request->id);
        $vendor->user->update([
            'status' => $request->status
        ]);
        $notification = [
            'message'    => 'Vendor Status Update Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function vendorEdit($id)
    {
        $vendor = Vendor::query()->findOrFail($id);
        $vendor->load('user');
        return view('vendor.vendor-active',compact('vendor'));
    }





}

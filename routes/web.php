<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[FrontendController::class,'index'])->name('frontend.index');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function (){
   Route::get('/dashboard',[UserController::class,'index'])->name('dashboard');
   Route::post('/user/profile/update',[UserController::class,'userProfileUpdate'])->name('user.profile.store');
   Route::get('/user/profile/logout',[UserController::class,'userProfileLogout'])->name('user.logout');
   Route::post('/user/profile/change-password',[UserController::class,'userProfileChangePassword'])->name('user.change.password');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('auth','role:admin')->group(function (){
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update',[AdminController::class,'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/profile/change-password',[AdminController::class,'adminProfileChangePassword'])->name('admin.change.password');
    Route::post('/admin/profile/change-password',[AdminController::class,'adminProfileChangePasswordStore'])->name('admin.change.password.store');

    Route::resource('admin/brand', BrandController::class);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/sub-category', SubCategoryController::class);
    Route::get('admin/vendor-list',[VendorController::class,'vendorList'])->name('vendor.list');
    Route::get('admin/vendor-edit/{id}',[VendorController::class,'vendorEdit'])->name('vendor.edit');
    Route::put('admin/vendor-update/{id}',[VendorController::class,'vendorUpdate'])->name('update.vendor');


});
Route::middleware('auth','role:vendor')->group(function (){
    Route::get('/vendor/dashboard',[VendorController::class,'index'])->name('vendor.dashboard');
    Route::get('/vendor/logout',[VendorController::class,'vendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile',[VendorController::class,'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/update',[VendorController::class,'vendorProfileUpdate'])->name('vendor.profile.update');
    Route::get('/vendor/profile/change-password',[VendorController::class,'vendorProfileChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/profile/change-password',[VendorController::class,'vendorProfileChangePasswordStore'])->name('vendor.change.password.store');


});
Route::get('/admin/login',[AdminController::class,'adminLogin'])->name('admin.login');
Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);

Route::get('/vendor/register',[VendorController::class,'vendorRegister'])->name('vendor.register');
Route::post('/vendor/store',[VendorController::class,'storeVendor'])->name('store.vendor');


require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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



require __DIR__.'/auth.php';

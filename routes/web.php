<?php

use App\Http\Controllers\Car\BrandController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ChnagePasswordController;
use App\Http\Controllers\Admin\EmailConfig\EmailConfigrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login',[AdminController::class,'show_login_page'])->name('login');
Route::post('admin/login',[AdminController::class,'login'])->name('admin.login');

Route::middleware('auth:admin')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');

        // admin profile 
        Route::get('/profile', [ProfileController::class,'index'])->name('admin.profile');
        Route::put('/profile/update/{id}', [ProfileController::class,'update_profile'])->name('admin.profile.update');
        Route::put('/profile/change-password/{id}', [ChnagePasswordController::class,'change_password'])->name('admin.profile.change-password');

        // email configration 
        Route::get('/email/config', [EmailConfigrationController::class,'index'])->name('admin.email.config');
        Route::put('/email/config/{id}', [EmailConfigrationController::class,'update'])->name('admin.email.update');

        //car route list
        Route::resource('/brand', BrandController::class);
        Route::get('/brand/status/{id}', [BrandController::class, 'status'])->name('brand.status');
        
    });
});

// Route::get('/test', function () {
   
//     Mail::to('wavaje4982@fuasha.com')->send(new TestMail("This is a test email from CarDokan!"));
//     return "Mail sent!";
// });

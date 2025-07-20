<?php

use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Car\CarController;
use App\Http\Controllers\Car\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Car\FeatureController;
use App\Http\Controllers\Country\CityController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Plan\PlanController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\Admin\ChnagePasswordController;
use App\Http\Controllers\Admin\Blog\BlogCategoryController;
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
        Route::get('/brands/search', [BrandController::class, 'search'])->name('brand.search');

        // feature  route
        Route::resource('/feature',FeatureController::class);

        // country route
        Route::resource('country', CountryController::class);
        Route::resource('city', CityController::class);
        Route::resource('car', CarController::class);
        Route::get('/status-check/{id}',[CarController::class,'statusUpdate'])->name('status.check');
        // awaiting for approval
        Route::get('awaiting-approval',[CarController::class,'awaitingForApproval'])->name('awaiting.approval');
        // city ajax route
        Route::get('/ajax/city/{id}',[CarController::class,'cities'])->name('ajax.city');


        // route user
        Route::resource('user',UserController::class);
        Route::get('/user/status/{id}',[UserController::class,'status'])->name('user.status');
        Route::get('pending-user',[UserController::class,'pendingUser'])->name('pending.user');


        // plan route
        Route::resource('plan',PlanController::class);

        Route::resource('blog-category', BlogCategoryController::class);
        Route::resource('blog', BlogController::class);

    });
});

// Route::get('/test', function () {

//     Mail::to('wavaje4982@fuasha.com')->send(new TestMail("This is a test email from CarDokan!"));
//     return "Mail sent!";
// });

<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminTeam\App\Http\Controllers\AdminTeamController;

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::resource('adminteams', AdminTeamController::class)->names('adminteam');
    Route::get('create-role', [AdminTeamController::class, 'createRole'])->name('adminteam.createRole');
    Route::post('store-role', [AdminTeamController::class, 'storeRole'])->name('adminteam.storeRole');
    Route::get('role-lists', [AdminTeamController::class, 'roleLists'])->name('adminteam.roleLists');
    Route::get('role-update/{id}', [AdminTeamController::class, 'roleUpdatePage'])->name('adminteam.roleUpdatePage');
    Route::put('role-update/{id}', [AdminTeamController::class, 'roleUpdate'])->name('adminteam.roleUpdate');
});

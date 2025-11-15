<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminTeam\App\Http\Controllers\AdminTeamController;

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('adminteams', AdminTeamController::class)->names('adminteam');
});

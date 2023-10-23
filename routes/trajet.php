<?php

use App\Http\Controllers\TrajetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/////////////////////BACKOFFICE////////////////////////////
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/createTrajet', [TrajetController::class, 'createTrajet'])->name('createTrajet');
    Route::get('/getCreateTrajet', [TrajetController::class, 'getCreateTrajet'])->name('getCreateTrajet');
    Route::get('/showTrajet/{id}', [TrajetController::class, 'showTrajet'])->name('showTrajet');
    Route::get('/getEditTrajet/{id}', [TrajetController::class, 'getEditTrajet'])->name('getEditTrajet');
    Route::put('/editTrajet/{id}', [TrajetController::class, 'editTrajet'])->name('editTrajet');
    Route::delete('/trajet/deleteTrajet/{id}', [TrajetController::class, 'deleteTrajet'])->name('deleteTrajet');

});
///////////////////////FRONTOFFICE//////////////////////////////////

Route::post('/rides', [TrajetController::class, 'filterRides'])->name('filterRides');
Route::get('/getAddRide', [TrajetController::class, 'getAddRide'])->name('getAddRide');
Route::post('/addRide', [TrajetController::class, 'addRide'])->name('addRide');
Route::delete('/deleteRide/{id}', [TrajetController::class, 'deleteRide'])->name('deleteRide');
Route::get('/showRide/{id}', [TrajetController::class, 'showRide'])->name('showRide');
Route::get('/showMyRide/{id}', [TrajetController::class, 'showMyRide'])->name('showMyRide');
Route::get('/getEditRide/{id}', [TrajetController::class, 'getEditRide'])->name('getEditRide');
Route::put('/editRide/{id}', [TrajetController::class, 'editRide'])->name('editRide');
Route::get('/showRideByUser/{id}', [TrajetController::class, 'showRideByUser'])->name('showRideByUser');
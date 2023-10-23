<?php

use App\Http\Controllers\RéservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/////////////////////BACKOFFICE////////////////////////////
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Route::get('/showRéservation/{id}', [RéservationController::class, 'showRéservation'])->name('showRéservation');
  Route::delete('/deleteTrajet/{id}', [RéservationController::class, 'deleteRéservation'])->name('deleteRéservation');

});
///////////////////////FRONTOFFICE//////////////////////////////////

Route::match(['get', 'post'],'/addRéservation/{id}', [RéservationController::class, 'addRéservation'])->name('addRéservation');
Route::delete('/destroyRéservation/{id}', [RéservationController::class, 'destroyRéservation'])->name('destroyRéservation');
Route::get('/showReservationByRide/{id}', [RéservationController::class, 'showReservationByRide'])->name('showReservationByRide');
Route::get('/showRéservationByUser/{id}', [RéservationController::class, 'showRéservationByUser'])->name('showRéservationByUser');
Route::match(['get', 'post'],'/acceptReservation/{id}', [RéservationController::class, 'acceptReservation'])->name('acceptReservation');
Route::match(['get', 'post'],'/refuserReservation/{id}', [RéservationController::class, 'refuserReservation'])->name('refuserReservation');
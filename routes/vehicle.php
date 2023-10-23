<?php

use App\Http\Controllers\RentingController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/addVehicle', [VehicleController::class, 'addvehicle'])->name('addVehicle');
    Route::get('/getaddVehicle', [VehicleController::class, 'getaddvehicle'])->name('getaddVehicle');
    Route::get('/getEditVehicle/{Vehicle_id}', [VehicleController::class, 'getEditVehicle'])->name('getEditVehicle');
    Route::put('/edit/{Vehicle_id}', [VehicleController::class, 'Editvehicle'])->name('edit');
    Route::delete('/deletevehicle/{Vehicle_id}', [VehicleController::class, 'deletevehicule'])->name('getDeleteVehicle');
    Route::get('/ShowVehicle/{Vehicle_id}', [VehicleController::class, 'ShowVehicle'])->name('ShowVehicle');
    Route::get('/getEditRenting/{Renting_id}', [RentingController::class, 'getEditRenting'])->name('getEditRenting');
    Route::put('/editRent/{Renting_id}', [RentingController::class, 'update'])->name('editRent');
    Route::delete('/delete/{Renting_id}', [RentingController::class, 'delete']);
    Route::get('/getaddRenting/{Vehicle_id}', [RentingController::class, 'getaddRenting'])->name('getaddRenting');
    Route::post('/stripebackoffice/{vehicle}',[RentingController::class,'stripebackoffice'])->name('stripebackoffice');

});
Route::get('/Show/{Vehicle_id}', [VehicleController::class, 'Show'])->name('Show');
Route::get('/vehiclepricing', [VehicleController::class, 'pricing'])->name('vehiclepricing');
Route::get('/paiement/{vehicle}',[RentingController::class,'paiement'])->name('paiement');
Route::post('/stripe/{vehicle}',[RentingController::class,'stripe'])->name('stripe');
Route::get('/intpaiement/{rentingPrice}/{vehicle}',[RentingController::class,'stripePaiementInterface'])->name('stripePaiementInterface');
Route::post('/stripepayment/{rentingPrice}', [RentingController::class,'stripePost'])->name('stripe.post');
Route::get('/SearchVehicle', [VehicleController::class,'filterVehicles'])->name('SearchVehicle');
Route::get('/clear-filters', [VehicleController::class,'clearFilters'])->name('ClearFilters');

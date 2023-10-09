<?php

use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticControllerB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticControllerF;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Reclamation*/
Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations');
Route::get('/reclamations/create', [ReclamationController::class, 'create'])->name('reclamations.create');
Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
Route::get('/reclamations/{reclamation}/edit', [ReclamationController::class, 'edit'])->name('reclamations.edit');
Route::put('/reclamations/{reclamation}', [ReclamationController::class, 'update'])->name('reclamations.update');
Route::delete('/reclamations/{reclamation}', [ReclamationController::class, 'destroy'])->name('reclamations.destroy');



Route::put('/reclamations/{id}/mark-as-treated', [ReclamationController::class, 'markAsTreated'])->name('markAsTreated');
Route::put('/reclamations/{id}/mark-as-not-treated', [ReclamationController::class, 'markAsNotTreated'])->name('markAsNotTreated');


/* */
Route::get('/blog',[StaticControllerF::class,'blog'])->name('blog');
Route::get('/about',[StaticControllerF::class,'about'])->name('about');
Route::get('/pricing',[StaticControllerF::class,'pricing'])->name('pricing');
Route::get('/contact',[StaticControllerF::class,'contact'])->name('contact');
Route::get('/car',[StaticControllerF::class,'car'])->name('car');
Route::get('/',[StaticControllerF::class,'home'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/',[StaticControllerB::class,'homeAdmin'])->name('admin');
    Route::get('/account', [ProfileAdminController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [ProfileAdminController::class, 'update'])->name('account.update');
    Route::delete('/account', [ProfileAdminController::class, 'destroy'])->name('account.destroy');
    Route::get('/login',[StaticControllerB::class,'loginAdmin'])->name('loginAdmin');
    Route::get('/register',[StaticControllerB::class,'registerAdmin'])->name('registerAdmin');
    Route::get('/forgetpassword',[StaticControllerB::class,'forgetPasswordAdmin'])->name('forgetPAdmin');
    Route::get('/users',[StaticControllerB::class,'UsersAdmin'])->name('UsersAdmin');
    Route::get('/reclamations',[StaticControllerB::class,'ReclamationssAdmin'])->name('ReclamationssAdmin');

    Route::get('/reservations',[StaticControllerB::class,'ReservationsAdmin'])->name('ReservationsAdmin');
    Route::get('/blogs',[StaticControllerB::class,'BlogsAdmin'])->name('BlogsAdmin');
    Route::get('/vehicules',[StaticControllerB::class,'VehiculesAdmin'])->name('VehiculesAdmin');
    Route::get('/trajets',[StaticControllerB::class,'TrajetsAdmin'])->name('TrajetsAdmin');
    Route::get('/contacts',[StaticControllerB::class,'ContactsAdmin'])->name('ContactsAdmin');
});



require __DIR__.'/auth.php';


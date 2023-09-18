<?php

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

Route::get('/',[StaticControllerF::class,'home'])->name('home');
Route::get('/blog',[StaticControllerF::class,'blog'])->name('blog');
Route::get('/about',[StaticControllerF::class,'about'])->name('about');
Route::get('/pricing',[StaticControllerF::class,'pricing'])->name('pricing');
Route::get('/contact',[StaticControllerF::class,'contact'])->name('contact');
Route::get('/car',[StaticControllerF::class,'car'])->name('car');
Route::get('/admin',[StaticControllerB::class,'homeAdmin'])->name('admin');
Route::get('/admin/account',[StaticControllerB::class,'accountAdmin'])->name('account');
Route::get('/admin/login',[StaticControllerB::class,'loginAdmin'])->name('loginAdmin');
Route::get('/admin/register',[StaticControllerB::class,'registerAdmin'])->name('registerAdmin');
Route::get('/admin/forgetpassword',[StaticControllerB::class,'forgetPasswordAdmin'])->name('forgetPAdmin');
Route::get('/admin/users',[StaticControllerB::class,'UsersAdmin'])->name('UsersAdmin');
Route::get('/admin/reservations',[StaticControllerB::class,'ReservationsAdmin'])->name('ReservationsAdmin');
Route::get('/admin/blogs',[StaticControllerB::class,'BlogsAdmin'])->name('BlogsAdmin');
Route::get('/admin/vehicules',[StaticControllerB::class,'VehiculesAdmin'])->name('VehiculesAdmin');
Route::get('/admin/trajets',[StaticControllerB::class,'TrajetsAdmin'])->name('TrajetsAdmin');
Route::get('/admin/contacts',[StaticControllerB::class,'ContactsAdmin'])->name('ContactsAdmin');



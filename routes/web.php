<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;

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

Route::get('/',[StaticController::class,'home'])->name('home');
Route::get('/blog',[StaticController::class,'blog'])->name('blog');
Route::get('/about',[StaticController::class,'about'])->name('about');
Route::get('/pricing',[StaticController::class,'pricing'])->name('pricing');
Route::get('/contact',[StaticController::class,'contact'])->name('contact');
Route::get('/car',[StaticController::class,'car'])->name('car');


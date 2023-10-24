<?php

use App\Http\Controllers\BlogAdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentsClientController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\StaticControllerB;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticControllerF;
use App\Http\Controllers\EventController;
use App\Http\Controllers\risqueController;
use App\Http\Controllers\contactController;



Route::get('/rides',[StaticControllerF::class,'rides'])->name('rides');

Route::post ('ajoutContact', [contactController::class, 'addContact']);
Route::get('/blog',[BlogAdminController::class,'indexFront'])->name('blog');
Route::get('/blog/{id}',[BlogAdminController::class,'showFront']);
Route::get('/translate',[BlogAdminController::class,'translate'])->name('changeLang');
Route::get('/about',[StaticControllerF::class,'about'])->name('about');
Route::get('/event',[EventController::class,'indexFrontOffice'])->name('event');
Route::get('/event/ParticipateEvent',[EventController::class,'indexParticipate'])->name('participatRecu');
Route::post('/participatEvent',[EventController::class,'addParticipation'])->name('participatEvent');
Route::get('/generatepdf', [EventController::class, 'exportPdf'])->name('recu.pdf');
Route::resource('/event/favoris',FavorisController::class)->middleware(['auth']);
Route::get('/event/{id}',[EventController::class,'showFrontOffice']);
Route::get('/contact',[StaticControllerF::class,'ajoutContact'])->name('contact');
Route::get('/car',[StaticControllerF::class,'car'])->name('car');
Route::get('/',[StaticControllerF::class,'home'])->name('home');
Route::get('/pricing',[StaticControllerF::class,'pricing'])->name('pricing');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /*Chat*/
    Route::get('/chat', [ChatController::class, 'chat'])->name('chat');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
    /*Reclamation*/
    Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations');
    Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
    Route::get('/reclamations/{reclamation}/edit', [ReclamationController::class, 'edit'])->name('reclamations.edit');
    Route::put('/reclamations/{reclamation}', [ReclamationController::class, 'update'])->name('reclamations.update');
    Route::delete('/reclamations/{reclamation}', [ReclamationController::class, 'destroy'])->name('reclamations.destroy');
    Route::put('/reclamations/{id}/mark-as-treated', [ReclamationController::class, 'markAsTreated'])->name('markAsTreated');
    Route::put('/reclamations/{id}/mark-as-not-treated', [ReclamationController::class, 'markAsNotTreated'])->name('markAsNotTreated');
    /*Mail*/
});
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::post('/comments/{id}',[CommentsClientController::class, 'store']);
    Route::post('/comments/likes/{id}/{idBlog}',[CommentsClientController::class, 'like']);
    Route::post('/comments/unlike/{id}/{idBlog}',[CommentsClientController::class, 'unlike']);
    Route::delete('/comments/{id}/{idBlog}',[CommentsClientController::class, 'destroy']);
    Route::put('/comments/update/{id}/{idBlog}',[CommentsClientController::class, 'update']);
});
Route::get('/chart/{year?}', [ContactController::class,'chart'])->name('chart.index');

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
    Route::get('/users',[UsersController::class,'index'])->name('UsersAdmin');
    Route::get('/reservations',[StaticControllerB::class,'ReservationsAdmin'])->name('ReservationsAdmin');
    Route::get('/reclamations',[StaticControllerB::class,'ReclamationssAdmin'])->name('ReclamationssAdmin');
    Route::resource('/blogs',BlogAdminController::class);
    Route::delete('/comments/{id}/{idBlog}',[CommentsClientController::class,'destroyComment']);   
    Route::get('/search',[BlogAdminController::class,'search'])->name('search');
    Route::get('/vehicules',[StaticControllerB::class,'VehiculesAdmin'])->name('VehiculesAdmin');
    Route::get('/Rentings',[StaticControllerB::class,'RentingAdmin'])->name('RentingAdmin');
    Route::get('/listContact',[StaticControllerB::class,'ContactsAdmin'])->name('ContactsAdmin');
    Route::get('/ajoutRisque',[StaticControllerB::class,'RisqueAdmin'])->name('RisqueAdmin');
    Route::get('/listRisque',[StaticControllerB::class,'RisquesAdmin'])->name('RisquesAdmin');

    Route::get('/listContact', [ContactController::class, 'getContact'])->name('listContact');
    Route::get ('/deleteContact/{id}', [contactController::class, 'suppContact']);
    Route::get ('modifContact/{id}', [contactController::class, 'getContactId']);
    Route::post('editContact', [contactController::class, 'updateContact']);

    Route::get('listRisque', [risqueController::class, 'getRisque'])->name('listRisque');
    Route::post ('ajoutRisque', [risqueController::class, 'addRisque'])->name('ajoutRisque');
    Route::get ('deleteRisque/{id}', [risqueController::class, 'suppRisque']);
    Route::get ('modifRisque/{id}', [risqueController::class, 'getRisqueId']);
    Route::post('editRisque', [risqueController::class, 'updateRisque']);

    Route::get('/trajets',[StaticControllerB::class,'TrajetsAdmin'])->name('TrajetsAdmin');
    Route::resource('/events',EventController::class);
    Route::get('/search',[EventController::class,'search'])->name('search');
    Route::get('/mails',[StaticControllerB::class,'MailsAdmin'])->name('MailsAdmin');
    Route::post('/send',[EmailController::class,'send'])->name('send.email');
});

require __DIR__.'/auth.php';
require __DIR__.'/trajet.php';
require __DIR__.'/réservation.php';
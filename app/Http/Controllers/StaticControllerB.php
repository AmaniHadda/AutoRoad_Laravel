<?php

namespace App\Http\Controllers;
use App\models\Reclamation;

use Illuminate\Http\Request;

class StaticControllerB extends Controller
{
    public function homeAdmin () {
        return view('BackOffice.dashboard');
    }
    public function accountAdmin () {
        
        return view('BackOffice.account');
    }
    public function loginAdmin () {
        return view('BackOffice.login');
    }
    public function registerAdmin () {
        return view('BackOffice.register');
    }
    public function forgetPasswordAdmin () {
        return view('BackOffice.forgetPassword');
    }
    public function UsersAdmin () {
        return view('BackOffice.users');
    }
    public function ReservationsAdmin () {
        return view('BackOffice.reservations');
    }

    public function  ReclamationssAdmin () {
        $reclamations = Reclamation::all();
        return view('BackOffice.reclamations.index', compact('reclamations'));
    }
   
    public function VehiculesAdmin () {
        return view('BackOffice.vehicules');
    }
    public function BlogsAdmin () {
        return view('BackOffice.blogs');
    }
    public function TrajetsAdmin () {
        return view('BackOffice.trajets');
    }
    public function ContactsAdmin () {
        return view('BackOffice.contacts');
    }
    public function MailsAdmin () {
        return view('BackOffice.send-email-to-driver');
    }
}

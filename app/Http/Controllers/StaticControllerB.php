<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\contact;
use App\Models\Event;
use App\Models\Renting;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Trajet;
use App\Models\Réservation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\models\Reclamation;

class StaticControllerB extends Controller
{
    public function homeAdmin() 
    {
        $users= User::all()->count();
        $blogs= Blog::all()->count();
        $events= Event::all()->count();
        $vehicules= Vehicle::all()->count();
        $reclamations= Reclamation::all()->count();
        // Récupérez les données existantes de la base de données
        $contactsData = Contact::whereYear('created_at', 2023)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->get();
    
        // Créez un tableau associatif pour les jours existants
        $existingData = $contactsData->pluck('count', 'date')->toArray();
    
        // Créez un tableau de jours de la semaine complets avec des valeurs par défaut de zéro
        $daysOfWeek = [];
        $counts = [];
    
        $startOfWeek = Carbon::now()->startOfWeek(); // Obtenez le premier jour de la semaine
        for ($i = 0; $i < 7; $i++) {
            $currentDay = $startOfWeek->copy()->addDays($i);
            $dayKey = $currentDay->toDateString();
            $daysOfWeek[] = $currentDay->format('D'); // Nom abrégé du jour
            $counts[] = $existingData[$dayKey] ?? 0;
        }
    
        return view('BackOffice.dashboard', compact('daysOfWeek', 'counts', 'users', 'blogs', 'events', 'vehicules', 'reclamations'));
    }
    public function accountAdmin () 
    {
        return view('BackOffice.account');
    }
    public function loginAdmin () 
    {
        return view('BackOffice.login');
    }
    public function registerAdmin () 
    {
        return view('BackOffice.register');
    }
    public function forgetPasswordAdmin () 
    {
        return view('BackOffice.forgetPassword');
    }
    public function UsersAdmin () {
        return view('BackOffice.users');
    }
    public function VehiculesAdmin () {
        return view('BackOffice.Vehicle.vehicules',['listvehicules'=>Vehicle::all()]);
    }
    public function RentingAdmin () {
        return view('BackOffice.Renting.RentingList',['listRentings'=>Renting::all()]);
    }
    public function BlogsAdmin () {
        return view('BackOffice.blogs');
    }
    public function TrajetsAdmin () {
        return view('BackOffice.Trajet.trajets',['listTrajets'=>Trajet::all()]);
    }
    public function rechercheRisque () {
        return view('BackOffice.rechercheRisque');
    }
    public function rechercheContacts () {
        return view('BackOffice.rechercheContacts');
    }
    public function ContactsAdmin () {
        return view('BackOffice.listContact');
    }
    public function RisqueAdmin () {
        return view('BackOffice.ajoutRisque');
    }
    public function RisquesAdmin () {
        return view('BackOffice.listRisque');
    }
    public function ReservationsAdmin () {
        return view('BackOffice.Réservation.réservations',['listRéservations'=>Réservation::all()]);
    }
    public function MailsAdmin () {
        return view('BackOffice.send-email-to-driver');
    }
    public function  ReclamationssAdmin () {
        $reclamations = Reclamation::all();
        return view('BackOffice.reclamations.index', compact('reclamations'));
    }
}
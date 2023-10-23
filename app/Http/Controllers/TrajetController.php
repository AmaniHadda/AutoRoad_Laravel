<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trajet;
use App\Models\Réservation;
use Illuminate\Pagination\Paginator;

class TrajetController extends Controller
{
    ////////////////////////BACKOFFICE////////////////////////////////////
    public function showTrajet($id){
        $trajet = Trajet::find($id);
        return view('BackOffice.Trajet.detailsTrajet', compact('trajet'));

    }
    public function createTrajet(Request $request)
    {
        // \Log::info(json_encode($request->all())); 
        $filename = '';
        $formvalidation = $request->validate([
            'depart' => 'required',
            'destination' => 'required',
            'date_depart' => 'required|date',
            'heure_depart' => 'required',
            'nombre_places_disponibles' => 'required|integer',
            'prix_par_passager' => 'required|numeric',
        ]);
     
        $formvalidation['user_id'] = auth()->id();
        Trajet::create($formvalidation);
        return redirect('/admin/trajets');
    }
    public function getCreateTrajet()
    {
        return view('BackOffice.Trajet.createTrajet');
    }
    public function getEditTrajet($id)
    {
        $Trajet = Trajet::find($id);
        return view('BackOffice.Trajet.editTrajet', compact('Trajet'));
    }
    public function editTrajet(Request $request, $id)
    {
        $formvalidation = $request->validate([
            'depart' => 'required',
            'destination' => 'required',
            'date_depart' => 'required|date',
            'heure_depart' => 'required',
            'nombre_places_disponibles' => 'required|integer',
            'prix_par_passager' => 'required|numeric',
        ]);
     

        $Trajet = Trajet::find($id);
      
        $Trajet->depart = $formvalidation['depart'];
        $Trajet->destination = $formvalidation['destination'];
        $Trajet->date_depart = $formvalidation['date_depart'];
        $Trajet->heure_depart = $formvalidation['heure_depart'];
        $Trajet->nombre_places_disponibles = $formvalidation['nombre_places_disponibles'];
        $Trajet->prix_par_passager = $formvalidation['prix_par_passager'];
        $Trajet['user_id'] = auth()->id();
        $Trajet->save();
        return redirect('/admin/trajets');
    }
    public function deleteTrajet($id)
    {
        $trajet = Trajet::find($id);
        $trajet->réservations()->delete(); // This will delete the associated reservations
        $trajet->delete();
        return back();
    }
    ///////////////////////////////////////////////////////////////
    //////////////////////FRONTOFFICE/////////////////////////////
    public function getAddRide()
    {
        return view('FrontOffice.Trajet.createTrajet');
    }
    public function addRide(Request $request)
    {
        // \Log::info(json_encode($request->all())); 
        $filename = '';
        $formvalidation = $request->validate([
            'depart' => 'required',
            'destination' => 'required',
            'date_depart' => 'required|date|after_or_equal:today',
            'heure_depart' => 'required',
            'nombre_places_disponibles' => 'required|integer',
            'prix_par_passager' => 'required|numeric',
        ]);
     
        $formvalidation['user_id'] = auth()->id();
        Trajet::create($formvalidation);
        return redirect(route('showRideByUser', ['id' => auth()->id()]));
    }
    public function deleteRide($id)
    {
        $trajet = Trajet::find($id);
        $trajet->réservations()->delete(); // This will delete the associated reservations
        $trajet->delete();
         // Récupérer l'ID de l'utilisateur authentifié
          $userId = auth()->user()->id;
        return redirect()->route('showRideByUser', ['id' => $userId]);
    }
    public function getEditRide($id)
    {
        $Trajet = Trajet::find($id);
        return view('FrontOffice.Trajet.editTrajet', compact('Trajet'));
    }
    public function editRide(Request $request, $id)
    {
        $formvalidation = $request->validate([
            'depart' => 'required',
            'destination' => 'required',
            'date_depart' => 'required|date|after_or_equal:today',
            'heure_depart' => 'required',
            'nombre_places_disponibles' => 'required|integer',
            'prix_par_passager' => 'required|numeric',
        ]);
     

        $Trajet = Trajet::find($id);
      
        $Trajet->depart = $formvalidation['depart'];
        $Trajet->destination = $formvalidation['destination'];
        $Trajet->date_depart = $formvalidation['date_depart'];
        $Trajet->heure_depart = $formvalidation['heure_depart'];
        $Trajet->nombre_places_disponibles = $formvalidation['nombre_places_disponibles'];
        $Trajet->prix_par_passager = $formvalidation['prix_par_passager'];
        $Trajet['user_id'] = auth()->id();
        $Trajet->save();
        return redirect(route('showRideByUser', ['id' => auth()->id()]));
    }
    public function showRide($id){
        $trajet = Trajet::find($id);
        return view('FrontOffice.Trajet.detailsTrajet', compact('trajet'));

    }
    // public function showMyRide($id){
    //     $trajet = Trajet::find($id);
    //     return view('FrontOffice.Trajet.myTrajetDetails', compact('trajet'));

    // }
    public function showMyRide($id)
    {
        $trajet = Trajet::find($id);
        $reservations = Réservation::where('trajet_id', $id)->get();
        
        return view('FrontOffice.Trajet.myTrajetDetails', compact('trajet', 'reservations'));
    }
    public function showRideByUser($id){
        $trajets = Trajet::where('user_id', $id)->paginate(3);
        return view('FrontOffice.Trajet.myTrajets', compact('trajets'));

    }
  
    public function filterRides(Request $request) {
        $query = Trajet::query();
    
        // Filtrer par date de départ
        if ($request->input('date_depart')) {
            $query->where('date_depart', $request->input('date_depart'));
        }
    
        // Filtrer par départ (contient la chaîne de caractères, insensible à la casse)
        if ($request->input('depart')) {
            $depart = $request->input('depart');
            $query->where('depart', 'LIKE', "%$depart%")->orWhere('depart', 'LIKE', "%$depart%");
        }
    
        // Filtrer par destination (contient la chaîne de caractères, insensible à la casse)
        if ($request->input('destination')) {
            $destination = $request->input('destination');
            $query->where('destination', 'LIKE', "%$destination%")->orWhere('destination', 'LIKE', "%$destination%");
        }
    
        // Exécuter la requête
        $listTrajets = $query->paginate(3);
    
        // Si aucun critère de filtre n'est spécifié, renvoyer tous les trajets
        if (!$request->hasAny(['date_depart', 'depart', 'destination'])) {
            $listTrajets = Trajet::paginate(3);
        }
    
        return view('FrontOffice.Trajet.trajets', compact('listTrajets'));
    }
    
}

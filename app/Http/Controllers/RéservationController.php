<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Réservation;
use App\Models\Trajet;
use Illuminate\Support\Facades\Mail;
use App\Mail\RéservationMail;
use Illuminate\Pagination\Paginator;
class RéservationController extends Controller
{
    

     ////////////////////////BACKOFFICE////////////////////////////////////
   
    public function deleteRéservation($id)
    {
        Réservation::find($id)->delete();
        return redirect('/admin/reservations');
    }
    ///////////////////////////////////////////////////////////////////////////
    ////////////////////FRONTOFFICE////////////////////////////////////////////
    public function addRéservation($id)
    {
        if ($id === null) {
            return back();
        } else {
            $trajet = Trajet::find($id);
    
            if ($trajet->nombre_places_disponibles === 0) {
                return back()->with('message', 'Désolé, ce trajet est complet. Aucune place disponible.');
            }
    
            // Vérifiez si l'utilisateur a déjà effectué une réservation
            $existingReservation = Réservation::where('trajet_id', $id)
                                            ->where('user_id', auth()->user()->id)
                                            ->first();
    
            // Si une réservation existe déjà, retournez un message indiquant à l'utilisateur qu'il a déjà réservé
            if ($existingReservation) {
                return back()->with('message', 'Vous avez déjà effectué une réservation pour ce trajet.');
            }
    
            // Si l'utilisateur n'a pas déjà réservé et qu'il reste des places, créez une nouvelle réservation
            $réservation = new Réservation;
            $réservation->trajet_id = $id;
            $réservation->user_id = auth()->user()->id;
            $réservation->status = 'En cours de traitement'; // Vous pouvez modifier le statut si nécessaire
            $réservation->save();
    
            // Décrémentez le nombre de places disponibles
            $trajet->nombre_places_disponibles -= 1;
            $trajet->save();
    
            // Retournez un message de succès pour indiquer que la réservation a été effectuée avec succès
            return back()->with('message', 'Réservation effectuée avec succès!');
        }
    }
    
    
    
    
    // public function showRéservationByUser($id){
    //     $réservations = Réservation::where('user_id', $id)->get();
    //     return view('FrontOffice.Réservation.myRéservations', compact('réservations'));

    // }
    public function showRéservationByUser($id) {
        $réservations = Réservation::where('user_id', $id)->paginate(3); // Paginer par exemple 10 résultats par page
        return view('FrontOffice.Réservation.myRéservations', compact('réservations'));
    }
    
    public function showReservationByRide($id){
        $reservations = Réservation::where('trajet_id', $id)->get();
        return view('FrontOffice.Trajet.myTrajetDetails', compact('reservations'));

    }
    public function destroyRéservation($id)
    {
        Réservation::find($id)->delete();
        $userId = auth()->user()->id;
        return redirect()->route('showRéservationByUser', ['id' => $userId]);
    }
    public function acceptReservation($id)
    {
        // Trouver la réservation par ID
        $reservation = Réservation::findOrFail($id);
    
        if ($reservation->status === 'Accepté') {
            return redirect()->back()->with('message', 'La réservation a déjà été acceptée.');
        } 
        // Vérifier si l'utilisateur actuel est le propriétaire du trajet
        if ($reservation->trajet->user_id !== auth()->user()->id) {
            return redirect()->back()->with('message', 'Vous n\'êtes pas autorisé à accepter cette réservation.');
        }
    
        // Vérifier s'il y a suffisamment de places disponibles
        $trajet = $reservation->trajet;
        if ($trajet->nombre_places_disponibles > 0) {
            // Mettre à jour le statut de la réservation
            $reservation->status = 'Accepté';
            $reservation->save();
    
            // Mettre à jour le nombre de places disponibles sur le trajet
            $trajet->nombre_places_disponibles -= 1;
            $trajet->save();
    
            // Récupérer la date et l'heure du trajet
            $dateDepart = $trajet->date_depart;
            $heureDepart = $trajet->heure_depart;
    
            // Envoyer un e-mail au propriétaire de la réservation
            $emailData = [
                'subject' => 'Réservation acceptée',
                'message' => 'Votre réservation a été acceptée. Voici les détails du trajet : ' . $trajet->depart . ' à ' . $trajet->destination,
                'recipientEmail' => $reservation->user->name,
            ];
    
            Mail::to($reservation->user->email)->send(new RéservationMail($emailData, $dateDepart, $heureDepart));
    
            return redirect()->back()->with('message', 'La réservation a été acceptée.');
        } else {
            return redirect()->back()->with('message', 'Il n\'y a plus de places disponibles pour ce trajet.');
        }
    }
    
    public function refuserReservation($id)
    {
        // Trouver la réservation par ID
        $reservation = Réservation::findOrFail($id);
    
        // Vérifier si l'utilisateur actuel est le propriétaire du trajet
        if ($reservation->trajet->user_id !== auth()->user()->id) {
            return redirect()->back()->with('message', 'Vous n\'êtes pas autorisé à refuser cette réservation.');
        }
        if (  $reservation->status != 'Refusé') {
      
        $trajet = $reservation->trajet;
       
            // Mettre à jour le statut de la réservation
            $reservation->status = 'Refusé';
            $reservation->save();
    
           
    
            // Récupérer la date et l'heure du trajet
            $dateDepart = $trajet->date_depart;
            $heureDepart = $trajet->heure_depart;
    
            // Envoyer un e-mail au propriétaire de la réservation
            $emailData = [
                'subject' => 'Réservation refusée',
                'message' => 'Votre réservation a été refusée. Voici les détails du trajet : ' . $trajet->depart . ' à ' . $trajet->destination,
                'recipientEmail' => $reservation->user->name,
            ];
    
            Mail::to($reservation->user->email)->send(new RéservationMail($emailData, $dateDepart, $heureDepart));
    
            return redirect()->back()->with('message', 'La réservation a été refusée.');
        } else {
            return redirect()->back()->with('message', 'Vous avez déjà refusé cette réservation');
        }
    }
}

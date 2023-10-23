<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Assurez-vous d'importer le modèle User

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'depart', 'destination', 'date_depart', 'heure_depart', 'nombre_places_disponibles', 'prix_par_passager', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Spécifiez la clé étrangère user_id
    }
    public function réservations()
    {
        return $this->hasMany(Réservation::class, 'trajet_id');
    }
}


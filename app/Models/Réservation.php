<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Assurez-vous d'importer le modèle User
use App\Models\Trajet;
class Réservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'status','trajet_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Spécifiez la clé étrangère user_id
    }
    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'trajet_id'); // Spécifiez la clé étrangère trajet_id
    }
}


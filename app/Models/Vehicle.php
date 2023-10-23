<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable=['Model','Vehicle_Condition','PriceDay','Color','Price','Fuel_Type','Image','Fuel_Consumption','Current_Owner','Features','Status','user_id'];
    public function rentals()
    {
        return $this->hasMany(Renting::class, 'vehicle_id');
    }
    
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renting extends Model
{
    use HasFactory;
    protected $fillable=['PUD','DOD','NbreHours','PUT','NbreDays','rentingPrice','vehicle_id','user_id','STATUS'];
    protected $attributes = [
        'NbreHours' => 0, 
        'NbreDays' => 0,
    ];
    public function vehicle()
{
    return $this->belongsTo(Vehicle::class, 'vehicle_id');
}
}

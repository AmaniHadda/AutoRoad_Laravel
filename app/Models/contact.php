<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{

    use HasFactory;
    protected $fillable=['name','email','subject', 'message','user_id','risque_id'];
    public function risques()
    {
        return $this->belongsTo(Risque::class, 'risque_id');
    }


    //✔ Un «risque» contient plusieurs «contact» ✔ Un «contact» n’appartient qu’à un seule «risque»
}

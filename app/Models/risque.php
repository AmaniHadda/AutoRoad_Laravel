<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class risque extends Model
{
    use HasFactory;
    protected $fillable=['user_id','title','description','categorie','probabilite'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}




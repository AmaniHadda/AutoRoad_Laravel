<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


class Reclamation extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'subject',
        'message',
    ];
    
    // You can remove the incomplete $hidden property.
}

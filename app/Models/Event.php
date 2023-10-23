<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'date_event',
        'image_path',
        'description',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favoris()
    {
        return $this->belongsToMany(Favoris::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
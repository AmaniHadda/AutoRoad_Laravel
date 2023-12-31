<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Vehicle;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model; 
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function blogs(){
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }
    public function Comments(){
        return $this->hasMany(Comment::class, 'user_id', 'id');}
    public function event(){
        return $this->hasMany(Event::class);
    }
    public function favoris(){
        return $this->hasMany(Favoris::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class);}
    public function userssVehicles(){
        return  $this->hasMany(Vehicle::class,'user_id');
    }
    public function userRentals(){
        return  $this->hasMany(Renting::class,'user_id');
    }
    public function usersContacts(){
        return  $this->hasMany(contact::class,'user_id');}

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'user_id');
    }
}

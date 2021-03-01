<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        // add
        'address',
        'piva',
        'phone',
        'description',
        'delivery_cost',
        'photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plates(){
      return $this -> hasMany(Plate::class);
    }

    public function feedback(){
      return $this -> hasMany(Feedback::class);
    }

    public function typologies(){
      return $this -> belongsToMany(Typology::class);
    }
}

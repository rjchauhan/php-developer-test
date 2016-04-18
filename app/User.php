<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**************************************************************
     *                      Relationships
     **************************************************************/

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}

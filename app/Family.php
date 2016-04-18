<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'name',
    ];


    /**************************************************************
     *                      Relationships
     **************************************************************/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function root_member()
    {
        return $this->hasOne(Member::class)->where('parent_id',  null);
    }

}

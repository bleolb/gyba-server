<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'value',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}

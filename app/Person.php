<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Person extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity',
        'nationality',
        'first_name',
        'last_name',
        'email',
        'civil_status',
        'birthdate',
        'gender',
        'phone',
        'cell_phone',
        'address',
        'about_me',
    ];

    public function applications()
    {
        return $this->belongsToMany('App\Application');
    }
}

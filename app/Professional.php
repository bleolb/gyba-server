<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Professional extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity',
        'first_name',
        'last_name',
        'nationality',
        'email',
        'civil_status',
        'birthdate',
        'gender',
        'phone',
        'cell_phone',
        'address',
        'about_me',
    ];

    public function offers()
    {
        return $this->belongsToMany(Offer::class)->withTimestamps();
    }

    public function languages()
    {
        return $this->hasMany('App\Language');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'email',
        'nationality',
        'civil_status',
        'birthdate',
        'gender',
        'phone',
        'address',
        'about_me',
    ];

    public function offers()
    {
        return $this->belongsToMany('App\Offer')->withTimestamps();
    }

    public function languages()
    {
        return $this->hasMany('App\Language');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function academicFormation()
    {
        return $this->hasMany('App\AcademicFormations');
    }
}

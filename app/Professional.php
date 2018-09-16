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
        'nationality',
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

    public function academicFormation()
    {
        return $this->hasMany('App\AcademicFormations');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'contacto',
        'email',
        'phone',
        'cell_phone',
        'contract_type',
        'position',
        'broad_field',
        'specific_field',
        'training_hours',
        'remuneration',
        'working_day',
        'number_jobs',
        'activities',
        'aditional_information',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function profesionals()
    {
        return $this->belongsToMany(Profesional::class)->withTimestamps();
    }
}

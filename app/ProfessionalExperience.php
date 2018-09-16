<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer',
        'position',
        'job_description',
        'start_date',
        'finish_date',
        'reason_leave',
    ];

    public function profsesional()
    {
        return $this->belongsTo('App\Professional');
    }

}
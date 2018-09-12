<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity',
        'type',
        'email',
        'activity',
        'trade_name',
        'comercial_activity',
        'phone',
        'cell_phone',
        'web_page',
        'address',
    ];

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }
}

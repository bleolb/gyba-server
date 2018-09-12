<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use SoftDeletes;

    //Mendefinisikan relationship
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    //mendefinisikan relaations dengan order
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //membuat relationship dengan model user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //relationship many-to-many relationship antara model Book dengan model Order
    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot('quantity');;
    }

    // tambahkan dynamic property
    public function getTotalQuantityAttribute()
    {
        $total_quantity = 0;
        foreach ($this->books as $book) {
            $total_quantity += $book->pivot->quantity;
        }
        return $total_quantity;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public $timestamps = false;

    public function sales()
    {
        //return $this->belongsToMany('App\Sale', 'sale_books', 'sale_id', 'book_id');
        return $this->belongsToMany('App\Sale','sale_books');
    }
}

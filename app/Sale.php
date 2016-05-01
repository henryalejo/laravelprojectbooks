<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    public $timestamps = false;

    public function books()
    {

        return $this->belongsToMany('App\Book','sale_books')->withPivot('num_books','book_curr_val');
    }
}

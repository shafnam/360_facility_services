<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function quote_items(){
        return $this->hasMany('App\QuoteItem');
    }

    public function quote_photos(){
        return $this->hasMany('App\QuotePhoto');
    }
}

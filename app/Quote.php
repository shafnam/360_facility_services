<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function quote_items(){
        return $this->hasMany('App\QuoteItem');
    }
}

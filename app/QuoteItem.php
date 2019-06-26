<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    public function quote(){
        return $this->belongsTo('App\Quote');
    }
}

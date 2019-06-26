<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotePhoto extends Model
{
    public function quote(){
        return $this->belongsTo('App\Quote');
    }
}

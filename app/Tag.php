<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function pots(){
        
        return $this->belongsToMany('App\Post');
        
    }
}

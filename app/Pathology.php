<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pathology extends Model
{
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function visits(){
    	return $this->belongsToMany('App\Visit');
    }
}

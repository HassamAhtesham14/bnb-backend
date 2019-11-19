<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
		protected $hidden = ['created_at', 'updated_at'];

    public function options() 
    {
    	return $this->hasMany('App\VariationOption');
    }
}

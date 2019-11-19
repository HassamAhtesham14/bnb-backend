<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationValue extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function variation() 
    {
    	return $this->belongsTo('App\Variation');
    }

    public function option() 
    {
    	return $this->belongsTo('App\VariationOption');
    }

    public function cartItem() 
    {
    	return $this->belongsTo('App\CartItem');
    }
}

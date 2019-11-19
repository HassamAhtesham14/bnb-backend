<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    protected $with = ['variationValues'];

    public function variationValues()
    {
        return $this->hasMany('App\VariationValue');
    }

    public function menuItem() 
    {
        return $this->belongsTo('App\MenuItem');
    }

    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function amount() 
    {
        $amount = 0;
        foreach($this->orderItems as $orderItem) {
            $price = $orderItem->menuItem->price;
            $quantity = $orderItem->quantity;

            $amount += ($price * $quantity);
        }
        return $amount;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = [];

	protected $with = ['orderItems'];

	public function orderItems() 
	{
		return $this->hasMany('App\OrderItem');
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

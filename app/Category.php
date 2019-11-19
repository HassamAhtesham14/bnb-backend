<?php

namespace App;

use App\MenuItem;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = ['name', 'slug', 'image'];

	public function menuItems() 
	{
		return $this->hasMany(MenuItem::class);
	}

    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}

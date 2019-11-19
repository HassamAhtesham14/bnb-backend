<?php

namespace Tests\Unit;

use App\MenuItem;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartItemTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function it_belongs_to_a_user() 
	{
		$cartItem = create('App\CartItem');
		$this->assertInstanceOf(User::class, $cartItem->user);
	}

	/** @test */
	public function it_belongs_to_a_menu_item() 
	{
		$cartItem = create('App\CartItem');
		$this->assertInstanceOf(MenuItem::class, $cartItem->menuItem);
	}
}

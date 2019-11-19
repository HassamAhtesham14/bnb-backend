<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuItemTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function it_belongs_to_a_category() 
    {
    	$menuItem = create('App\MenuItem');
    	$this->assertInstanceOf('App\Category', $menuItem->category);
    }
}

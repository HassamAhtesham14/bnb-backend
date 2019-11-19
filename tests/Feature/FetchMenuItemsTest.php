<?php

namespace Tests\Feature;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FetchMenuItemsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_fetch_menu_items_by_category()
    {
        $category = create('App\Category');
        $menuItemInCategory = create('App\MenuItem', ['category_id' => $category->id]);
        $menuItemNotInCategory = create('App\MenuItem');

        $this->json('GET', "/api/menu-items/{$category->slug}")
            ->assertStatus(200)
            ->assertJsonFragment([
                'menuItems' => [
                    $menuItemInCategory->toArray()
                ],
            ]);
    }

    /** @test */
    public function it_can_fetch_menu_item_detail()
    {
        $category = create('App\Category');
        $menuItem = create('App\MenuItem', ['category_id' => $category->id]);
        $this->json('GET', "/api/menu-items/" . $category->slug . "/" . $menuItem->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'menuItem' => [
                    'title',
                    'description',
                    'price',
                    'image'
                ]
            ]);
    }

    /** @test */
    public function it_can_fetch_popular_menu_items() 
    {   
        $menuItem = create('App\MenuItem', ['is_popular' => true]);
        $menuItemNotPopular = create('App\MenuItem', ['is_popular' => false]);
        
        $this->json('GET', "/api/menu-items/popular")
            ->assertStatus(200)
            ->assertJsonFragment([
                'menuItems' => [
                    $menuItem->toArray()
                ],
            ])
            ->assertJsonMissing($menuItemNotPopular->toArray());
    }
}
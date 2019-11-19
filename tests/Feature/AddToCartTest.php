<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddToCartTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function it_can_add_items_to_cart()
    {
        $user = $this->signIn();

        $menuItem = create('App\MenuItem');

        $quantity = rand(1, 5);

        $response = $this->json("POST", "/api/cart-items", [
            'menu_item_id' => $menuItem->id,
            'quantity' => $quantity
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('cart_items', ['menu_item_id' => $menuItem->id, 'quantity' => $quantity, 'user_id' => $user->id]);
    }

    /** @test */
    public function it_can_add_variations_in_menu_item_when_adding_into_cart()
    {
        $user = $this->signIn();

        $menuItem = create('App\MenuItem');

        $variation = create('App\Variation');

        $option = create('App\VariationOption', ['variation_id' => $variation->id]);

        $quantity = rand(1, 5);

        $menuItem->variations()->attach($variation->id);

        $response = $this->json("POST", "/api/cart-items", [
            'menu_item_id' => $menuItem->id,
            'quantity' => $quantity,
            'variations' => [
                [
                    'variation_id' => $variation->id,
                    'variation_option' => $variation->options()->first()->id,
                ]
            ]
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'cartItem' => [
                    'id' => 1,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'user_id' => $user->id,
                    'variation_values' => [
                        [
                            'id' => 1,
                            'cart_item_id' => $menuItem->id,
                            'variation_id' => $variation->id,
                            'option_id' => $option->id
                        ]
                ]
            ],
        ]);
    }
}
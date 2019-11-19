<?php

namespace Tests\Feature;

use App\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_checkout_items() 
    {
        $response = $this->json('POST', '/api/checkout');

        $response->assertStatus(401);
    }

    /** @test */
    public function it_can_checkout_items_in_cart() 
    {
        $user = $this->signIn();

        $menuItem = create('App\MenuItem');

        $cartItem = create('App\CartItem', ['user_id' => $user->id, 'menu_item_id' => $menuItem->id]);

        // $variation = create('App\Variation');
        // $option = create('App\VariationOption', ['variation_id' => $variation->id]);

        // $quantity = rand(1, 5);

        // $menuItem->variations()->attach($variation->id);

        // $cart

        $response = $this->json('POST', '/api/checkout');
        $response->assertStatus(200);

        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);

        $order = $response->decodeResponseJson()['order'];
        $order = Order::find($order['id']);

        $this->assertEquals($order->orderItems()->first()->menu_item_id, $menuItem->id);

    }
}

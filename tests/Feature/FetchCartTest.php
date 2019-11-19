<?php
namespace Tests\Feature;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
class FetchCartTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function guests_can_not_fetch_cart() 
    {
        $this->json('GET', '/api/cart-items')->assertStatus(401);
    }

    /** @test */
    public function authorized_users_can_fetch_cart() 
    {
        $user = $this->signIn();

        $cartItem = create('App\CartItem', ['user_id' => $user->id]);

        $response = $this->json('GET', '/api/cart-items');

        $response->assertJsonFragment([
            'cartItems' => [
                [
                    'id' => 1,
                    'menu_item_id' => (string) $cartItem->menu_item_id,
                    'quantity' => (string) $cartItem->quantity,
                    'user_id' => (string) $cartItem->user_id,
                    'variation_values' => []
                ]
            ],
            
        ]);
    }
}

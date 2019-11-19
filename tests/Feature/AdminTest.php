<?php
namespace Tests\Feature;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
class AdminTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function unauthorized_users_can_not_add_categories() 
    {
        $category = make('App\Category');
        
        // Guest
        $this->json('POST', '/api/categories', $category->toArray())
            ->assertStatus(401);

        // Customer
        $this->signIn();
        $this->json('POST', '/api/categories', $category->toArray())
            ->assertStatus(403);

        // Admin
        $user = create('App\User', ['user_type' => 'admin']);
        $this->signIn($user);
    }
}
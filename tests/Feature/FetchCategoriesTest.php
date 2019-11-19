<?php
namespace Tests\Feature;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
class FetchCategoriesTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function it_can_fetch_categories() 
    {
    	$category = create('App\Category');

    	$this->json('GET', "/api/categories")
    		->assertJson([
    			"categories" => [
    				$category->toArray()
    			]
    		]);
    }
}
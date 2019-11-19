<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null) {
    	if (!$user)
    		$user = create('App\User');
    	$this->actingAs($user, 'api');
    	return $user;
    }
}

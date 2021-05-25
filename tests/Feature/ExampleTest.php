<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestUser()
    {
        $this->get('')
            ->assertSeeText('Login to Continue');
    }

    public function testAuthenticatedUser()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user)
            ->get('')
            ->assertRedirect('agreements');
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    public function test_example(): void
    {
        $email = fake()->email();
        $name = fake()->word();
        $password = fake()->password(8);
        $response = $this->post(route('api.auth.register'),[
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'token_type',
            'access_token',
            'refresh_token',
            'expires_in',
        ]);
    }
}

<?php

namespace Tests\Feature\Api;

use Database\Seeders\SantrisTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_login_must_enter_email_and_password(): void
    {
        $response = $this->postJson('api/v1/login');
        $response->assertStatus(422);
        $response->assertJson([
            "status" => "error",
            "message" => [
                "email" => [
                    "The email field is required."
                ],
                "password" => [
                    "The password field is required."
                ]
            ]
        ]);
    }

    public function test_registered_user_can_login()
    {
        $this->seed(SantrisTableSeeder::class);
        $this->seed(UsersTableSeeder::class);

        $loginData = [
            'email'    => 'santri@ponpes.com',
            'password' => 'password'
        ];

        $response = $this->postJson('api/v1/login', $loginData, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJson([
            "status" => "success",
            "message" => "User login success"
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "access_token",
                "token_type",
                "expires_in",
                "santri_id",
                "email",
                "name",
                "role",
            ]
        ]);
        $this->assertAuthenticated();
    }
}

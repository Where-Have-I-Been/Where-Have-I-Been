<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_attempting_to_login_with_correct_credentials(): void
    {
        $email = "test@example.com";

        UserFactory::new()->create(["email" => "$email"]);

        $response = $this->post("/api/login", ["email" => "$email", "password" => "password"]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_user_is_attempting_to_login_with_wrong_credentials(): void
    {
        $credentials = [
            "email" => "test@test.com",
            "password" => "123",
        ];

        $response = $this->post("/api/login", $credentials);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_user_is_attempting_to_login_with_empty_credentials(): void
    {
        $credentials = [];

        $response = $this->post("/api/login", $credentials);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}

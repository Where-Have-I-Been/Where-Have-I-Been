<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_attempting_to_register_with_valid_data(): void
    {
        $data = [
            "email" => "test@example.com",
            "username" => "test",
            "password" => "password",
            "password_confirmation" => "password",
        ];

        $response = $this->post("/api/register", $data);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseCount("users", 1);
    }

    public function test_user_is_attempting_to_register_with_invalid_data(): void
    {
        $data = [
            "email" => "test@",
            "username" => "",
            "password" => "pass",
            "password_confirmation" => "password",
        ];

        $response = $this->post("/api/register", $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    public function test_user_is_attempting_to_register_with_existing_email(): void
    {
        $email = "test@example.com";

        UserFactory::new()->create(["email" => "$email"]);

        $data = [
            "email" => "$email",
            "username" => "test",
            "password" => "password",
            "password_confirmation" => "password",
        ];

        $response = $this->post("/api/register", $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

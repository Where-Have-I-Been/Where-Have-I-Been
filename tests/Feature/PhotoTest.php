<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\CountryFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_trying_to_list_other_user_photos(): void
    {
        UserFactory::new()->create(["email" => "john@example.com"]);

        $response = $this->get("/api/photos/user/1");

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

    }

    public function test_user_is_trying_to_list_own_photos(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);

        $response = $this->actingAs($user)->get("/api/photos/user/$user->id");

        $response->assertStatus(Response::HTTP_OK);
    }
}

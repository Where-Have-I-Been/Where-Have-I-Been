<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\CountryFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_when_user_is_created_profile_should_be_assigned(): void
    {
        /** @var User $user */
        $user = UserFactory::new()->create();

        $this->assertTrue($user->userProfile()->exists());
    }

    public function test_guest_is_trying_to_show_user_profile(): void
    {
        UserFactory::new()->createMany([
            ["email" => "john@example.com"],
            ["email" => "oliver@example.com"],
            ["email" => "alice@example.com"]
        ]);

        $response = $this->get("/api/profiles/1");

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

    }

    public function test_user_is_trying_to_show_own_profile(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);

        UserFactory::new()->createMany([
            ["email" => "oliver@example.com"],
            ["email" => "alice@example.com"]
        ]);

        $response = $this->actingAs($user)->get("/api/profiles/1");

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_user_is_trying_to_show_non_existing_profile(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);

        $response = $this->actingAs($user)->get("/api/profiles/87362");

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_user_is_trying_to_update_own_profile(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);

        $response = $this->actingAs($user)->put("/api/profiles/$user->id");

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_user_is_trying_to_update_other_profile(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);

        UserFactory::new()->createMany([
            ["email" => "oliver@example.com"],
            ["email" => "alice@example.com"]
        ]);

        $response = $this->actingAs($user)->put("/api/profiles/2");

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_user_can_update_nationality_with_correct_data(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);
        CountryFactory::new()->create(["country_name" => "poland"]);

        $response = $this->actingAs($user)->put("/api/profiles/$user->id", ["country_id" => 1]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas("users_profiles", [
            "id" => $user->id,
            "country_id" => 1,
        ]);
    }

    public function test_user_can_update_nationality_with_incorrect_data(): void
    {
        $user = UserFactory::new()->create(["email" => "john@example.com"]);
        CountryFactory::new()->create(["country_name" => "poland"]);

        $response = $this->actingAs($user)->put("/api/profiles/$user->id", ["country_id" => 2]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertDatabaseMissing("users_profiles", [
            "id" => $user->id,
            "country_id" => 2,
        ]);
    }
}

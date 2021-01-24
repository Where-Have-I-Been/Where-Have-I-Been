<?php

declare(strict_types=1);

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BasicTest extends TestCase
{
    public function test_homepage_works(): void
    {
        $response = $this->get("/");

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_http_not_found_when_page_non_exists(): void
    {
        $response = $this->get("/non-existing-page-123");

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}

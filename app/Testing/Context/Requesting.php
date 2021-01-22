<?php

declare(strict_types=1);

namespace App\Testing\Context;

use Behat\Behat\Context\Context;
use Illuminate\Http\Request;
use KrzysztofRewak\Larahat\Helpers\SimpleRequesting;
use PHPUnit\Framework\Assert;

class Requesting implements Context
{
    use SimpleRequesting;

    protected Request $request;

    /**
     * @Given a user is requesting :url
     * @Given a user is requesting :url using :method
     */
    public function aUserIsRequesting(string $endpoint, string $method = Request::METHOD_GET): void
    {
        $this->request = Request::create($endpoint, $method);
    }

    /**
     * @When a request is sent
     */
    public function aRequestIsSent(): void
    {
        $this->request($this->request);
    }

    /**
     * @Then a response status code should be :status
     */
    public function aResponseStatusCodeShouldBe(int $status): void
    {
        Assert::assertEquals($status, $this->response->getStatusCode());
    }
}

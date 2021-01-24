<?php

declare(strict_types=1);

namespace App\Testing\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use KrzysztofRewak\Larahat\Helpers\SimpleRequesting;
use PHPUnit\Framework\Assert;

class Requesting implements Context
{
    use SimpleRequesting;

    protected Request $request;
    protected UploadedFile $file;

    /**
     * @Given a user is requesting :url
     * @Given a user is requesting :url using :method
     */
    public function aUserIsRequesting(string $endpoint, string $method = Request::METHOD_GET): void
    {
        $this->request = Request::create($endpoint, $method, [], [], $file ?? []);
    }

    /**
     * @Given request body contains :key equal :value
     */
    public function requestBodyContains(string $key, string $value): void
    {
        $this->request[$key] = $value;
    }

    /**
     * @Then response body should contain:
     */
    public function responseBodyShouldContain(TableNode $table): void
    {
        $response = $this->getResponseContent();

        foreach ($table as $row) {
            Assert::assertEquals($response[$row["key"]], $row["value"]);
        }
    }

    /**
     * @When a request is sent
     */
    public function aRequestIsSent(): void
    {
        $this->request($this->request);
    }

    /**
     * @Given request body contains image :image
     */
    public function requestContainsImage(string $name): void
    {
        $this->file = UploadedFile::fake()->image($name, 400, 400);
    }

    /**
     * @Then a response status code should be :status
     */
    public function aResponseStatusCodeShouldBe(int $status): void
    {
        Assert::assertEquals($status, $this->response->getStatusCode());
    }
}

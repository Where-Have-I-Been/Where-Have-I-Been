<?php

declare(strict_types=1);

namespace App\Testing\Context\Model;

use App\Models\User;
use App\Testing\Traits\CreatingUsers;
use Behat\Behat\Context\Context;
use Database\Factories\UserFactory;
use KrzysztofRewak\Larahat\Helpers\RefreshingDatabase;
use PHPUnit\Framework\Assert;

class Users implements Context
{
    use RefreshingDatabase;
    use CreatingUsers;

    protected User $user;

    /**
     * @When there is a user created
     */
    public function thereIsAUserCreated(): void
    {
        $this->user = UserFactory::new()->create();
    }

    /**
     * @Then it should have profile assigned
     */
    public function itShouldHaveProfileAssigned(): void
    {
        Assert::assertTrue($this->user->userProfile()->exists());
    }
}

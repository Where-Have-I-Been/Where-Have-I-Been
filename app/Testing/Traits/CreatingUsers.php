<?php

declare(strict_types=1);

namespace App\Testing\Traits;

use Behat\Gherkin\Node\TableNode;
use Database\Factories\UserFactory;

trait CreatingUsers
{
    /**
     * @When there are users created:
     * @When there is a user created:
     */
    public function thereAreUsersCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $user) {
            UserFactory::new()->create($user);
        }
    }
}

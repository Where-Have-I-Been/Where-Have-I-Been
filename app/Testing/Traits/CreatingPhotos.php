<?php

declare(strict_types=1);

namespace App\Testing\Traits;

use Behat\Gherkin\Node\TableNode;
use Database\Factories\PhotoFactory;

trait CreatingPhotos
{
    /**
     * @When there are photos created:
     * @When there is a photo created:
     */
    public function thereArePhotosCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $photo) {
            PhotoFactory::new()->create($photo);
        }
    }
}

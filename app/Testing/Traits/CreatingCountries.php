<?php

declare(strict_types=1);

namespace App\Testing\Traits;

use Behat\Gherkin\Node\TableNode;
use Database\Factories\CountryFactory;

trait CreatingCountries
{
    /**
     * @When there are countries created:
     * @When there is a country created:
     */
    public function thereAreCountriesCreated(TableNode $table): void
    {
        foreach ($table->getHash() as $country) {
            CountryFactory::new()->create($country);
        }
    }
}

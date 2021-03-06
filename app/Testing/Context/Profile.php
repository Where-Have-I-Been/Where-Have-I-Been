<?php

declare(strict_types=1);

namespace App\Testing\Context;

use App\Testing\Traits\CreatingCountries;
use App\Testing\Traits\CreatingUsers;
use App\Testing\Traits\LoggingIn;
use Behat\Behat\Context\Context;
use KrzysztofRewak\Larahat\Helpers\RefreshingDatabase;

class Profile implements Context
{
    use RefreshingDatabase;
    use CreatingUsers;
    use CreatingCountries;
    use LoggingIn;
}

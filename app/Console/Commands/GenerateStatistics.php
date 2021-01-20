<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateStatistics extends Command
{
    protected $signature = 'command:name';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        return 0;
    }
}

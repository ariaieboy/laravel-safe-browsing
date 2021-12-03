<?php

namespace Ariaieboy\LaravelSafeBrowsing\Commands;

use Illuminate\Console\Command;

class LaravelSafeBrowsingCommand extends Command
{
    public $signature = 'laravel-safe-browsing';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

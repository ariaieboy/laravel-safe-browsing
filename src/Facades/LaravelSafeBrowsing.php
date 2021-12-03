<?php

namespace Ariaieboy\LaravelSafeBrowsing\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ariaieboy\LaravelSafeBrowsing\LaravelSafeBrowsing
 */
class LaravelSafeBrowsing extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-safe-browsing';
    }
}

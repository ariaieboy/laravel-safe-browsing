<?php

namespace Ariaieboy\LaravelSafeBrowsing;

class LaravelSafeBrowsing
{
    protected ?string $apiKey = null;

    public function __construct()
    {
        $this->apiKey = config('laravel-safe-browsing.api_key');
    }
}

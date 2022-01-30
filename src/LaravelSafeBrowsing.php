<?php

namespace Ariaieboy\LaravelSafeBrowsing;

class LaravelSafeBrowsing
{
    protected ?string $apiKey = null;
    protected string $clientId;
    protected string $clientVersion;
    protected array $threatTypes;
    protected array $platformTypes;

    public function __construct(?string $apiKey = null)
    {
        $this->apiKey = $apiKey ?? config('laravel-safe-browsing.google.api_key');
        $this->clientId = config('laravel-safe-browsing.google.clientId');
        $this->clientVersion = config('laravel-safe-browsing.google.clientVersion');
        $this->threatTypes = config('laravel-safe-browsing.google.threatTypes');
        $this->platformTypes = config('laravel-safe-browsing.google.threatPlatforms');
    }

    protected function getApiResult(string $url)
    {
    }
}

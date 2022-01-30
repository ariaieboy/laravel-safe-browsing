<?php

namespace Ariaieboy\LaravelSafeBrowsing;

use Illuminate\Support\Facades\Http;

class LaravelSafeBrowsing
{
    protected ?string $apiKey = null;
    protected string $clientId;
    protected string $clientVersion;
    protected array $threatTypes;
    protected array $platformTypes;

    /**
     * @throws \Exception
     */
    public function __construct(?string $apiKey = null)
    {
        $this->apiKey = $apiKey ?? config('laravel-safe-browsing.google.api_key');
        $this->clientId = config('laravel-safe-browsing.google.clientId');
        $this->clientVersion = config('laravel-safe-browsing.google.clientVersion');
        $this->threatTypes = config('laravel-safe-browsing.google.threatTypes');
        $this->platformTypes = config('laravel-safe-browsing.google.threatPlatforms');
        if (is_null($this->apiKey) or empty($this->apiKey)) {
            throw new \Exception('API Key is required');
        }
    }

    public function isSafeUrl(string $url, bool $returnType = false): bool|string
    {
        $result = $this->getApiResult($url);
        if (is_array($result) and isset($result['matches'])) {
            if ($returnType) {
                foreach ($result['matches'] as $match) {
                    if ($match['threat']['url'] === $url) {
                        return $match['threatType'];
                    }
                }
            }

            return false;
        }

        return true;
    }

    /**
     * @throws \Exception
     */
    protected function getApiResult(string $url): array|string
    {
        $lookupUrl = sprintf("https://safebrowsing.googleapis.com/v4/threatMatches:find?key=%s", $this->apiKey);
        $lookupData = [
            'client' => [
                'clientId' => $this->clientId,
                'clientVersion' => $this->clientVersion,
            ],
            'threatInfo' => [
                'threatTypes' => $this->threatTypes,
                'platformTypes' => $this->platformTypes,
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [
                    [
                        'url' => $url,
                    ],
                ],
            ],
        ];
        $response = Http::post($lookupUrl, $lookupData);
        if ($response->failed()) {
            throw new \Exception($response->json('error.message'));
        }

        return $response->json();
    }
}

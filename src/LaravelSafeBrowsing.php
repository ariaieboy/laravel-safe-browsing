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
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function setClientVersion(string $clientVersion): self
    {
        $this->clientVersion = $clientVersion;

        return $this;
    }

    public function setThreatTypes(array $threatTypes): self
    {
        $this->threatTypes = $threatTypes;

        return $this;
    }

    public function setPlatformTypes(array $platformTypes): self
    {
        $this->platformTypes = $platformTypes;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function isSafeUrl(string $url, bool $returnType = false): bool|string
    {
        $this->checkApiKey();
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

    protected function checkApiKey(): void
    {
        if (is_null($this->apiKey) or empty($this->apiKey)) {
            throw new \Exception('API Key is required');
        }
    }

    /**
     * @throws \Exception
     */
    protected function getApiResult(string $url): array|string
    {
        $apiDomain = config('laravel-safe-browsing.google.api_domain', 'https://safebrowsing.googleapis.com/');
        $lookupUrl = sprintf($apiDomain."v4/threatMatches:find?key=%s", $this->apiKey);
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

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function getClientVersion(): ?string
    {
        return $this->clientVersion;
    }

    public function getThreatTypes(): ?array
    {
        return $this->threatTypes;
    }

    public function getPlatformTypes(): ?array
    {
        return $this->platformTypes;
    }
}

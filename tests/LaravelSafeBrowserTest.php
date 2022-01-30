<?php

use Ariaieboy\LaravelSafeBrowsing\Facades\LaravelSafeBrowsing;

it('throw exception on missing api_key', function () {
    config(['laravel-safe-browsing.google.api_key' => '']);
    LaravelSafeBrowsing::isSafeUrl('http://malware.testing.google.test/testing/malware/');
})->throws(Exception::class, 'API Key is required');
it('will throw exception if api_key is not valid', function () {
    config(['laravel-safe-browsing.google.api_key' => 'fake_api_key']);
    LaravelSafeBrowsing::isSafeUrl('http://malware.testing.google.test/testing/malware/');
})->throws(Exception::class);
it('can determine unsafe url', function () {
    $this->assertFalse(LaravelSafeBrowsing::isSafeUrl('http://malware.testing.google.test/testing/malware/'));
});
it('can return threatTypes', function () {
    $result = LaravelSafeBrowsing::isSafeUrl('http://malware.testing.google.test/testing/malware/', true);
    $this->assertContains($result, ['MALWARE', 'SOCIAL_ENGINEERING', 'UNWANTED_SOFTWARE']);
});
it('can determine safe URL', function () {
    $result = LaravelSafeBrowsing::isSafeUrl('https://google.com', true);
    $this->assertTrue($result);
});
it('can change configuration on the fly', function () {
    $api = LaravelSafeBrowsing::setApiKey('test_key');
    $this->assertEquals('test_key', $api->getApiKey());
    $api = $api->setClientId('test_client_id');
    $this->assertEquals('test_client_id', $api->getClientId());
    $api = $api->setClientVersion('test_client_version');
    $this->assertEquals('test_client_version', $api->getClientVersion());
    $api = $api->setThreatTypes(['TEST']);
    $this->assertEquals(['TEST'], $api->getThreatTypes());
    $api = $api->setPlatformTypes(['TEST']);
    $this->assertEquals(['TEST'], $api->getPlatformTypes());
});

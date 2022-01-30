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

<?php
use Ariaieboy\LaravelSafeBrowsing\Facades\LaravelSafeBrowsing;

it('can determine unsafe url',function(){
    $this->assertFalse(LaravelSafeBrowsing::isSafeUrl('http://malware.testing.google.test/testing/malware/'));
});

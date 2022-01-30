<?php
// config for Ariaieboy/LaravelSafeBrowsing
return [
    'google'=>[
        'api_key'=>env('SAFEBROWSING_GOOGLE_API_KEY',null),
        'timeout'=>30,
        'threatTypes' => [
            'THREAT_TYPE_UNSPECIFIED',
            'MALWARE',
            'SOCIAL_ENGINEERING',
            'UNWANTED_SOFTWARE',
            'POTENTIALLY_HARMFUL_APPLICATION',
        ],

        'threatPlatforms' => [
            'ANY_PLATFORM'
        ],
        'clientId' => 'ariaieboy-safebrowsing',
        'clientVersion' => '1.0.0',
    ]
];

<?php

namespace Ariaieboy\LaravelSafeBrowsing;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSafeBrowsingServiceProvider extends PackageServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->bind('laravel-safe-browsing', function () {
            return new LaravelSafeBrowsing();
        });
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-safe-browsing')
            ->hasConfigFile('laravel-safe-browsing');
    }
}

<?php

namespace Ariaieboy\LaravelSafeBrowsing;

use Ariaieboy\LaravelSafeBrowsing\Commands\LaravelSafeBrowsingCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSafeBrowsingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-safe-browsing')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-safe-browsing_table')
            ->hasCommand(LaravelSafeBrowsingCommand::class);
    }
}

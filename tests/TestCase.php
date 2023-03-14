<?php

namespace Ariaieboy\LaravelSafeBrowsing\Tests;

use Ariaieboy\LaravelSafeBrowsing\LaravelSafeBrowsingServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCase extends AbstractPackageTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Ariaieboy\\LaravelSafeBrowsing\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelSafeBrowsingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-safe-browsing_table.php.stub';
        $migration->up();
        */
    }
}

<?php

namespace Ariaieboy\LaravelSafeBrowsing\Tests;

use Ariaieboy\LaravelSafeBrowsing\LaravelSafeBrowsingServiceProvider;
use GrahamCampbell\TestBench\AbstractAppTestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCase extends AbstractAppTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Ariaieboy\\LaravelSafeBrowsing\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelSafeBrowsingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-safe-browsing_table.php.stub';
        $migration->up();
        */
    }
}

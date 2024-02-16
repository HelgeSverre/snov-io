<?php

namespace HelgeSverre\Snov\Tests;

use Dotenv\Dotenv;
use HelgeSverre\Snov\SnovServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Saloon\Laravel\SaloonServiceProvider;
use Spatie\LaravelData\LaravelDataServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SaloonServiceProvider::class,
            SnovServiceProvider::class,
            LaravelDataServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // Load .env.test into the environment.
        if (file_exists(dirname(__DIR__).'/.env')) {
            (Dotenv::createImmutable(dirname(__DIR__), '.env'))->load();
        }

        config()->set('snov-io.client_id', env('SNOV_CLIENT_ID'));
        config()->set('snov-io.client_secret', env('SNOV_CLIENT_SECRET'));
    }
}

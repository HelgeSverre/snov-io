<?php

namespace HelgeSverre\Snov;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SnovServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('snov-io')->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this->app->bind(Snov::class, function () {
            return new Snov(
                clientId: config('snov-io.client_id'),
                clientSecret: config('snov-io.client_secret'),
            );
        });
    }
}

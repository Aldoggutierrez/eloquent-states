<?php

namespace Aldoggutierrez\EloquentStates;

use Aldoggutierrez\EloquentStates\Commands\EloquentStatesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EloquentStatesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('eloquent-states')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_eloquent_states_table')
            ->hasCommand(EloquentStatesCommand::class);
    }
}

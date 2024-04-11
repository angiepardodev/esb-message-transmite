<?php

namespace App\Providers;

use App\Support\Faker\Json;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class CustomFakerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new Json($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

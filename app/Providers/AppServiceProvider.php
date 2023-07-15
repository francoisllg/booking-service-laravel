<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Interfaces\Accommodation\AccommodationRepositoryInterface::class,
            \App\Repositories\Accommodation\CsvAccommodationRepository::class,
        );
        $this->app->bind(
            \App\Interfaces\User\UserRepositoryInterface::class,
            \App\Repositories\User\CsvUserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

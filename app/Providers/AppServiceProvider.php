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
           \App\Repositories\Accommodation\InMemoryAccommodationRepository::class
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

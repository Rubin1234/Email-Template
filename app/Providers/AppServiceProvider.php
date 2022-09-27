<?php

namespace App\Providers;

use Queue;

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
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Queue::failing(function ($connection, $job, $data) {
        //     dd('failed');
        //     // Notify team of failing job...
        // });
    }
}

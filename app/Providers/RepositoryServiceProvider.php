<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\MailVariableRepository::class, \App\Repositories\MailVariableRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmailTemplateRepository::class, \App\Repositories\EmailTemplateRepositoryEloquent::class);
        //:end-bindings:
    }
}

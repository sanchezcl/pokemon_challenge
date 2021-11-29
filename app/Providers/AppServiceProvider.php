<?php

namespace App\Providers;

use App\Repositories\CardMysqlRepository;
use App\Repositories\CardRepositoryInterface;
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
            CardRepositoryInterface::class,
            CardMysqlRepository::class
        );
    }
}

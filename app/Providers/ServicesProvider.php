<?php

namespace App\Providers;

use App\Services\Contracts\VehiclesService;
use App\Services\VehiclesServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\OwnerService;
use App\Services\OwnerServiceImpl;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(OwnerService::class, OwnerServiceImpl::class);
        $this->app->bind(VehiclesService::class, VehiclesServiceImpl::class);
    }
}

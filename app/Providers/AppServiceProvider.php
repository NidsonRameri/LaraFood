<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\PlanObserver;
use App\Observers\TenantObserver;
use App\Models\Plan;
use App\Models\Tenant;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
    }
}

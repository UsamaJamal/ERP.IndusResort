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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // The cashbook keeps its sums for the length of a request. Any change to the
        // records they are built from throws them away, so a later read is never stale.
        foreach ([\App\Models\Booking::class, \App\Models\KitchenOrder::class, \App\Models\Expense::class, \App\Models\CashMovement::class] as $model) {
            $model::saved(fn () => \App\Support\Cashbook::flush());
            $model::deleted(fn () => \App\Support\Cashbook::flush());
        }
    }
}

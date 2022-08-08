<?php

namespace App\Providers;

use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        $order_count = Orders::select(DB::raw("count(*) as jami"))->where('order_status','=',0)->groupBy('serial_number')->get();
        View::share('order_count', $order_count);
    }
}

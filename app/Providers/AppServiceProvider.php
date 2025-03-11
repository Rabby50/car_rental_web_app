<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Rental;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $view->with([
                'User_rentals' => Rental::where('user_id', Auth::id())->get(),
                'rentals' => Rental::all(),
                'cars' => Car::all(),
                'brands' => Car::pluck('brand')->unique(),
                'models' => Car::pluck('model')->unique(),
            ]);
        });
    }
}

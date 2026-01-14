<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('manage-product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });

        Gate::define('view-product', function (User $user, Product $product) {
            if ($product->is_public) {
                return true;
            }
            return $user->id === $product->user_id;
        });
    }
}

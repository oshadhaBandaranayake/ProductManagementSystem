<?php

namespace App\Providers;

use App\Repositories\Products\ProductsInterface;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductsInterface::class, ProductsRepository::class);
  }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

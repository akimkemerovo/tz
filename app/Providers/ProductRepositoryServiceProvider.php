<?php
namespace App\Providers;

use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductRepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->singleton("productRepository", function ($app) {
            return new ProductRepository();
        });
    }
}

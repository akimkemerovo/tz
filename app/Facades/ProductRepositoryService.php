<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ProductRepositoryService extends Facade{
    protected static function getFacadeAccessor() {
        return 'productRepository';
    }
}

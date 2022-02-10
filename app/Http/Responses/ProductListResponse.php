<?php

namespace App\Http\Responses;

use App\Dto\ProductDto;

class ProductListResponse
{
    /* @var ProductDto[] */
    private $products;


    public function __construct(array $products) {
        $this->products = $products;
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        foreach ($this->products as $product) {
            $data[] = $product->toArray();
        }

        return $data;
    }
}

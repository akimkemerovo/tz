<?php

namespace App\Http\Responses;

use App\Models\Category;

class CategoryListResponse
{
    /* @var Category[] */
    private $categories;


    public function __construct(array $categories) {
        $this->categories = $categories;
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        foreach ($this->categories as $category) {
            $data[] = $category->toArray();
        }

        return $data;
    }
}

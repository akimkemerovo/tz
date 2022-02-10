<?php

namespace App\Http\Responses;

use App\Dto\CategoryDto;

class CategoryResponse
{
    private $id;
    private $name;


    public function __construct(CategoryDto $dto) {
        $this->id = $dto->getId();
        $this->name = $dto->getName();
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}

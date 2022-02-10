<?php

namespace App\Http\Responses;

use App\Dto\ProductDto;

class ProductResponse
{
    private $id;
    private $name;
    private $price;
    private $isPublished;
    private $isDeleted;


    public function __construct(ProductDto $dto) {
        $this->id = $dto->getId();
        $this->name = $dto->getName();
        $this->price = $dto->getPrice();
        $this->isPublished = $dto->isPublished();
        $this->isDeleted = $dto->isDeleted();
    }
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'isPublished' => $this->isPublished,
            'isDeleted' => $this->isDeleted,
        ];
    }
}

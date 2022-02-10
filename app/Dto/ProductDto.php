<?php

namespace App\Dto;

class ProductDto
{
    private $id;
    private $name;
    private $price;
    private $categoryIds;
    private $is_published;
    private $is_deleted;



    public function __construct(array $params) {
        $this->id = (int)($params['id'] ?? 0);
        $this->name = (string)($params['name'] ?? null);
        $this->price = (double)($params['price'] ?? 0);
        $this->categoryIds = ($params['categoryIds'] ?? []);
        $this->is_published = (boolean)($params['is_published'] ?? false);
        $this->is_deleted = (boolean)($params['is_deleted'] ?? false);

    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'is_published' => $this->is_published,
            'is_deleted' => $this->is_deleted,
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->is_published;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->is_deleted;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array|mixed
     */
    public function getCategoryIds()
    {
        return $this->categoryIds;
    }
}

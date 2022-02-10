<?php

namespace App\Dto;

class CategoryDto
{
    private $id;
    private $name;


    public function __construct(array $params) {
        $this->id = (int)($params['id'] ?? 0);
        $this->name = (string)($params['name'] ?? null);
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
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
}

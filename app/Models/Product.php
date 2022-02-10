<?php

namespace App\Models;

use App\Dto\ProductDto;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property double $price
 * @property boolean $is_published
 * @property boolean $is_deleted
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'is_published', 'is_deleted'];
    protected $table = 'product';
    public $timestamps = false;

    public function submit(ProductDto $dto): bool {
        $this->fillFromDto($dto);
        return $this->save();
    }

    public function fillFromDto(ProductDto $dto) {
        $this->name = $dto->getName();
        $this->price = $dto->getPrice();
        $this->is_published = $dto->isPublished();
        $this->is_deleted = $dto->isDeleted();
    }

    public function categories() {
        return $this->belongsToMany('App\Models\Category', 'product_category');
    }
}

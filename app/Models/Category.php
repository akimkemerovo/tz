<?php

namespace App\Models;

use App\Dto\CategoryDto;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'category';
    public $timestamps = false;

    public function submit(CategoryDto $dto): bool {
        $this->fillFromDto($dto);
        return $this->save();
    }

    private function fillFromDto(CategoryDto $dto) {
        $this->name = $dto->getName();
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_category');
    }
}

<?php

namespace App\Repositories;

use App\Dto\ProductDto;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Throwable;

class ProductRepository
{

    /**
     * @throws Throwable
     */
    public function insert(ProductDto $dto): ProductDto {

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->submit($dto);
            $dto->setId($product->fresh()->id);
            foreach ($dto->getCategoryIds() as $categoryId) {
                $product->categories()->attach($categoryId);
            }

            DB::commit();

            return $dto;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function get(int $id): ?ProductDto
    {
        $product = Product::find($id);
        if ($product != null) {
            return new ProductDto($product->toArray());
        }

        return null;
    }


    /**
     * @throws Throwable
     */
    public function update(ProductDto $dto): bool
    {
        DB::beginTransaction();
        try {
            $product = Product::find($dto->getId());
            $updated = $product
                ->update($dto->toArray());

            $ids = $dto->getCategoryIds();
            foreach ($ids as $id) {
                Category::findOrFail($id);
                $product->categories()->attach($id);
            }

            DB::commit();

            return $updated;
        } catch (Throwable $e) {
            DB::rollBack();
            return false;
        }
    }

    public function delete(int $productId)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($productId);
            /*foreach ($product->categories as $category) {
                $product->ca
            }*/
            $product->categories()->detach($product->categories);
            $product->delete();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function list($name, $categoryName, $categoryId, $priceFrom, $priceTo, $isPublished): array
    {
        $products = Product::where('is_deleted', false);

        if ($priceFrom != null) {
            $products->where('price', '>=', $priceFrom);
        }
        if ($priceTo != null) {
            $products->where('price', '<=', $priceTo);
        }
        if ($name != null) {
            $products->where('name', 'like', '%' . $name . '%');
        }
        if ($categoryName != null) {
            $products->whereHas('categories', function ($query) use ($categoryName) {
                $query->where('category.name', 'like', '%'.$categoryName.'%');
            });
        }
        if ($isPublished == 'yes') {
            $products->where('is_published', true);
        } else if ($isPublished == 'no') {
            $products->where('is_published', false);
        }
        if ($categoryId != null) {
            $products->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category.id', $categoryId);
            });
        }


        $products = $products->get();

        $list = [];
        foreach ($products as $product) {
            $list[] = new ProductDto($product->toArray());
        }

        return $list;
    }
}

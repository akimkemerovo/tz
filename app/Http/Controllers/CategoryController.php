<?php

namespace App\Http\Controllers;

use App\Dto\CategoryDto;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Responses\CategoryListResponse;
use App\Http\Responses\CategoryResponse;
use App\Models\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;


class CategoryController extends BaseController
{
    use ValidatesRequests;

    public function create(CreateCategoryRequest $request): JsonResponse
    {

        $category = new Category();
        $category->submit(
            $request
                ->toDto()
        );

        return response()->json(
            (new CategoryResponse(
                new CategoryDto($category->toArray())
            ))->toArray()
        );
    }

    public function get($categoryId): JsonResponse
    {

        $category = Category::find($categoryId);

        if ($category == null) {
            return response()->json([
                'message' => "Category not found",
                'code' => 404
            ], 404);
        }

        return response()->json(
            (new CategoryResponse(
                new CategoryDto($category->toArray())
            ))->toArray()
        );
    }

    public function update(UpdateCategoryRequest $request, $categoryId): JsonResponse
    {

        $category = Category::find($categoryId);

        if ($category == null) {
            return response()->json([
                'message' => "Category not found",
                'code' => 404
            ], 404);
        }

        $category->submit($request->toDto());

        return response()->json(
            (new CategoryResponse(
                new CategoryDto($category->toArray())
            ))->toArray()
        );
    }

    public function delete($categoryId): JsonResponse
    {

        $category = Category::find($categoryId);

        if ($category->products->isNotEmpty()) {
            return response()->json([
                'message' => "Category has products",
                'code' => 409
            ], 409);
        }

        if ($category == null) {
            return response()->json([
                'message' => "Category not found",
                'code' => 404
            ], 404);
        }

        $category->delete();

        return response()->json();
    }

    public function list(): JsonResponse
    {

        $categories = Category::all()->all();

        return response()->json(
            (new CategoryListResponse($categories))->toArray()
        );
    }
}

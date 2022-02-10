<?php

namespace App\Http\Controllers;

use App\Dto\ProductDto;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Responses\ProductListResponse;
use App\Http\Responses\ProductResponse;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ValidatesRequests;


    /**
     * @var ProductRepository
     */
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(CreateProductRequest $request): JsonResponse
    {

        $newDto = $this->productRepository->insert($request->toDto());

        return response()->json(
            (new ProductResponse($newDto))->toArray()
        );
    }

    public function get($productId): JsonResponse
    {

        $product = $this->productRepository->get($productId);

        if ($product == null) {
            return response()->json([
                'message' => "Product not found",
                'code' => 404
            ], 404);
        }

        return response()->json(
            (new ProductResponse(
                new ProductDto($product->toArray())
            ))->toArray()
        );
    }

    public function update(
        UpdateProductRequest $request,
        $productId
    ): JsonResponse {

        $product = $this->productRepository->get($productId);

        if ($product == null) {
            return response()->json([
                'message' => "Product not found",
                'code' => 404
            ], 404);
        }

        $dto = $request->toDto();
        $dto->setId($productId);
        if (!$this->productRepository->update($dto)) {
            return response()->json([
                'message' => "Product not saved",
                'code' => 500
            ], 500);
        }

        return response()->json(
            (new ProductResponse($dto))->toArray()
        );
    }

    public function delete($productId): JsonResponse
    {

        $product = $this->productRepository->get($productId);

        if ($product == null) {
            return response()->json([
                'message' => "Product not found",
                'code' => 404
            ], 404);
        }

        $this->productRepository->delete($productId);

        return response()->json();
    }

    public function list(Request $request): JsonResponse
    {

        $products = $this->productRepository->list(
            $request->input('name'),
            $request->input('category_name'),
            $request->input('category_id'),
            $request->input('price_from'),
            $request->input('price_to'),
            $request->input('is_published')
        );

        return response()->json(
            (new ProductListResponse($products))->toArray()
        );
    }
}

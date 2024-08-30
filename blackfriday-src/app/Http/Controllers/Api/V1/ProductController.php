<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class ProductController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function categories(): JsonResponse
    {
        $products = Product::select(['categoryName'])
            ->groupBy('categoryName')
            ->pluck('categoryName')
            ->toArray();

        return $this->response->success($products);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = Product::findOrFail($id);

        return $this->response->success($product);
    }

    /**
     * @param $category
     * @return JsonResponse
     */
    public function byCategory($category): JsonResponse
    {
        $products = Product::where('categoryName', $category)->get();

        return $this->response->success($products);
    }
}

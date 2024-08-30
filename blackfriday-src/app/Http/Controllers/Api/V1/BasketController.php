<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AddToBasketRequest;
use App\Http\Requests\CheckoutBasketRequest;

class BasketController extends Controller
{
    public function addToBasket(AddToBasketRequest $request): JsonResponse
    {
        $basket = Basket::create([
            'ProductId' => $request->input('product-id'),
            'BasketId' => $request->input('basket-id'),
            'UserId' => $request->input('user-id'),
            'IsCheckedOut' => false,
        ]);

        return $this->response->success($basket, [], 201);
    }

    public function checkoutBasket(CheckoutBasketRequest $request): JsonResponse
    {
        $basket = Basket::where('BasketId', $request->input('basket-id'))
            ->where('UserId', $request->input('user-id'))
            ->where('IsCheckedOut', false)
            ->firstOrFail();

        $basket->update(['IsCheckedOut' => true]);

        /*$invoice = Invoice::create([
            'BasketId' => $basket->BasketId,
            'UserId' => $basket->UserId,
            'Items' => json_encode([$basket->product->toArray()]),
        ]);*/

        return $this->response->success(/*$invoice*/);
    }
}

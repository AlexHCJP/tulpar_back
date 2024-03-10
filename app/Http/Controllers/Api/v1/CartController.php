<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Cart\IndexCartRequest;
use App\Models\Cart;
use App\Models\Part;
use App\Services\v1\CartService;

class CartController extends ApiController
{
    public function __construct(public CartService $cartService)
    {
    }

    public function get(IndexCartRequest $request)
    {
        return $this->result($this->cartService->get($request->validated()));
    }

    public function add(Part $part)
    {
        return $this->result($this->cartService->add($part));
    }

    public function delete(Cart $cart)
    {
        return $this->result($this->cartService->delete($cart));
    }
}

<?php

namespace App\Services\v1;

use App\Models\Cart;
use App\Models\Part;
use App\Presenters\v1\CartPresenter;
use App\Repositories\CartRepository;
use App\Services\Service;

class CartService extends Service
{
    public function __construct(public CartRepository $cartRepository)
    {
    }

    public function get(array $params = []): array
    {
        return $this->resultCollections(
            $this->cartRepository->getPaginated($params),
            CartPresenter::class,
            'list',
            $this->cartRepository->count($params)
        );
    }

    public function add(Part $part): array
    {
        Cart::create([
            'user_id' => auth('api')->id(),
            'part_id' => $part->id,
        ]);

        return $this->ok('Часть добавлена в корзину');
    }

    public function delete(Cart $cart): array
    {
        if ($cart->user_id != auth('api')->id()) {
            return $this->errFobidden('Доступ запрещен');
        }
        $cart->delete();
        return $this->ok('Часть удалена из корзины');
    }
}

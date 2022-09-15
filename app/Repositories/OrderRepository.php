<?php

namespace App\Repositories;

use App\Helpers\TransactionDataAdapter;
use App\Models\OrderStatus;
use App\Models\Order;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderRepository implements Contracts\OrderRepositoryContract
{
    const ORDER_STATUSES = [
        'completed' => 'COMPLETED'
    ];

    public function create(array $request, float $total): Order|bool
    {
        $user = auth()->user();
        $status = OrderStatus::defaultStatus()->first();

        $request = array_merge($request, [
            'status_id' => $status->id,
            'total' => $total
        ]);

        $order = $user->orders()->create($request);

//        $this->addProductsToOrder($order);

        return $order;
    }

    public function setTransaction(string $transactionOrderId, TransactionDataAdapter $adapter): Order
    {
        $order = Order::where('vendor_order_id', $transactionOrderId)->firstOrFail();
        $transaction = $order->transaction()->create((array) $adapter);

        if ($adapter->status === self::ORDER_STATUSES['completed']) {
            $order->update([
                'status_id' => OrderStatus::paidStatus()->firstOrFail()?->id,
                'transaction_id' => $transaction->id
            ]);
        }

        $order->transaction()->create((array) $adapter);

        return $order;
    }

    public function addProductsToOrder(Order $order)
    {
        Cart::instance('cart')->content()->each(function($cartItem) use ($order) {
            $order->products()->attach(
                $cartItem->model,
                [
                    'quantity' => $cartItem->qty,
                    'single_price' => $cartItem->price
                ]
            );

            $inStock = $cartItem->model->in_stock - $cartItem->qty;

            if (!$cartItem->model->update(['in_stock' => $inStock])) {
                throw new Exception("Smth went wrong with product ID({$cartItem->id}) while updating qty");
            }
        });
    }
}

<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\ProductUpdateInStockNotification;
use App\Notifications\ProductUpdatePriceNotification;

class ProductObserver
{
    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $old_count = $product->getOriginal('in_stock');

        if ($old_count <= 0 && $old_count < $product->in_stock) {
            $product->followers()
                ->get()
                ->each
                ->notify(new ProductUpdateInStockNotification($product));
        }

        $old_price = $product->getOriginal('end_price');

        if ($old_price > $product->end_price) {
            $product->followers()
                ->get()
                ->each
                ->notify(new ProductUpdatePriceNotification($product));
        }

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}

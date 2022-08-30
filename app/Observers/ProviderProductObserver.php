<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProviderProduct;

class ProviderProductObserver
{
    /**
     * Handle the ProviderProduct "created" event.
     *
     * @param  \App\Models\ProviderProduct  $providerProduct
     * @return void
     */
    public function created(ProviderProduct $providerProduct)
    {
        if(empty($providerProduct->icon_path)){
            $providerProduct->icon_path = Product::find($providerProduct->product_id)->icon_path;
            $providerProduct->saveQuietly();
        }
    }

    /**
     * Handle the ProviderProduct "updated" event.
     *
     * @param  \App\Models\ProviderProduct  $providerProduct
     * @return void
     */
    public function updated(ProviderProduct $providerProduct)
    {
        //
    }

    /**
     * Handle the ProviderProduct "deleted" event.
     *
     * @param  \App\Models\ProviderProduct  $providerProduct
     * @return void
     */
    public function deleted(ProviderProduct $providerProduct)
    {
        //
    }

    /**
     * Handle the ProviderProduct "restored" event.
     *
     * @param  \App\Models\ProviderProduct  $providerProduct
     * @return void
     */
    public function restored(ProviderProduct $providerProduct)
    {
        //
    }

    /**
     * Handle the ProviderProduct "force deleted" event.
     *
     * @param  \App\Models\ProviderProduct  $providerProduct
     * @return void
     */
    public function forceDeleted(ProviderProduct $providerProduct)
    {
        //
    }
}

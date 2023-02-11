<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProviderProduct;

class ProviderProductObserver
{

    public function creating(ProviderProduct $providerProduct){
        $providerProduct->is_active=1;
        if($provider_id = auth()->user()->provider_id){
            $providerProduct->provider_id = $provider_id;
        }
        $mainProduct = Product::find($providerProduct->product_id);
        if(empty($providerProduct->icon_path)){
            $providerProduct->icon_path = $mainProduct->icon_path;
        }
        if(empty($providerProduct->discount)){
            $providerProduct->discount = $mainProduct->discount??0;
        }
    }

    /**
     * Handle the ProviderProduct "created" event.
     *
     * @param  \App\Models\ProviderProduct  $providerProduct
     * @return void
     */
    public function created(ProviderProduct $providerProduct)
    {
        
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

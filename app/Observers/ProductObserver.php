<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;


class ProductObserver
{
    // SE ESTIVER USANDO O MODEL PARA CADASTRAR...
    /**CREATING, ANTES DE CADASTRAR // REGISTRAR OBSERVER NO APPSERVICEPROVIDER
     * Handle the Product "creating" event. 
     *
     * @param  \App\Models\Product  $Product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->uuid = Str::uuid();
        $product->flag = Str::kebab($product->title);
    }

    /**
     * Handle the Product "updating" event.
     *
     * @param  \App\Models\Product  $Product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->flag = Str::kebab($product->title);
    }
}

<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    // SE ESTIVER USANDO O MODEL PARA CADASTRAR...
    /**CREATING, ANTES DE CADASTRAR // REGISTRAR OBSERVER NO APPSERVICEPROVIDER
     * Handle the Category "creating" event. 
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->uuid = Str::uuid();
        $category->url = Str::kebab($category->name);
    }

    /**
     * Handle the Category "updating" event.
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function updating(Category $category)
    {
        $category->url = Str::kebab($category->name);
    }
}

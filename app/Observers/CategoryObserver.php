<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**CREATING, ANTES DE CADASTRAR // REGISTRAR OBSERVER NO APPSERVICEPROVIDER
     * Handle the Category "creating" event. 
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function creating(Category $category)
    {
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

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $Category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Product extends Model
{
    use TenantTrait; //Produtos separados por tenant, então todos os models precisam

    protected $fillable = [
        'title',
        'description',
        'flag',
        'price',
        'image'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    /**
     * Categories not linked with this product
     */
    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn('categories.id', function($query){ //subquery
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        }) //SELECT * FROM 'categories' WHERE id NOT IN (SELECT category_id FROM 'category_product' WHERE product_id=2)
        ->where(function ($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })        
        ->paginate();

        return $categories;
    }
}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> RepositoryServiceProvider
    //queryBuilder (não eloquent)
    protected $table;
    public function __construct()
    {
        $this->table = 'products';       
    }

    public function getProductsByTenantId(string $idTenant, array $categories) // valor pre definido se quiser $categories = [] ** colocar tb na interface!!
    {
        return DB::table($this->table)
                    ->join('category_product', 'category_product.product_id', '=', 'products.id') 
                    ->join('categories', 'category_product.category_id', '=', 'categories.id')
                    ->where('products.tenant_id', $idTenant)
                    ->where('categories.tenant_id', $idTenant) //depois passar função caso produto não tenha categoria
                    ->where(function ($query) use ($categories){
                        if($categories != [])
                            $query->whereIn('categories.uuid', $categories);
                    })
                    ->select('products.*')
                    ->get();
    }
    public function getProductByUuid(String $uuid){
        return DB::table($this->table)
                    ->where('uuid', $uuid)
                    ->first();
    }
    
}
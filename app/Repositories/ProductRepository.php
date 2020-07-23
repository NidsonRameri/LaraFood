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

    public function getProductsByTenantId(string $idTenant)
    {
        return DB::table($this->table)
                    ->where('tenant_id', $idTenant)
                    ->get();
    }
    
}
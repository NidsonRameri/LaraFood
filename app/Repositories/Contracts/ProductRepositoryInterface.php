<?php

namespace App\Repositories\Contracts;


interface ProductRepositoryInterface{
    public function getProductsByTenantId(String $idTenant, array $categories);
    public function getProductByUuid(String $flag);
}
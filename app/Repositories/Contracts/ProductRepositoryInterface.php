<?php

namespace App\Repositories\Contracts;


interface ProductRepositoryInterface{
    public function getProductsByTenantId(String $idTenant);
}
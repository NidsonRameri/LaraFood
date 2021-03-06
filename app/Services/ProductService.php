<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\ProductRepository;

class ProductService{
    //Criando API --- 3º PASSO =>(prox)=> ProductRepositoryInterface && ProductRepository
    protected $productRepository, $tenantRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;   
    }

    public function getProductsByTenantUuid(String $uuid, array $categories){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductByUuid(string $uuid){
        return $this->productRepository->getProductByUuid($uuid);
    }

}
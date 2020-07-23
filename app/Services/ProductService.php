<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService{
    //Criando API --- 3º PASSO =>(prox)=> ProductRepositoryInterface && ProductRepository
    protected $productService, $tenantRepository;

    public function __construct(
        ProductRepositoryInterface $productService,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->productService = $productService;
        $this->tenantRepository = $tenantRepository;   
    }

    public function getProductsByTenantUuid(String $uuid){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productService->getProductsByTenantId($tenant->id);
    }

}
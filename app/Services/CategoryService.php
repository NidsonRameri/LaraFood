<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService{
    //Criando API --- 3º PASSO =>(prox)=> CategoryRepositoryInterface && CategoryRepository

    protected $categoryRepository, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, 
                                CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getCategoriesByUuid(string $uuid){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
    
        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByUuid(string $uuid){
        return $this->categoryRepository->getCategoryByUuid($uuid);
    }
}
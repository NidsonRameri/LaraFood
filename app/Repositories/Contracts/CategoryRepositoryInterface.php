<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> 
    public function getCategoriesByTenantUuid(string $uuid);
    public function getCategoriesByTenantId(int $idTenant);
    public function getCategoryByUuid(string $uuid);
}
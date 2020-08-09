<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> 
    public function getTablesByTenantUuid(string $uuid);
    public function getTablesByTenantId(int $idTenant);
    public function getTableByUuid(string $uuid);
}
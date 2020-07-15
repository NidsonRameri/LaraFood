<?php
namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface{

    //eloquent orm do laravel
    protected $entity;

    public function __construct(Tenant $tenant)
    {
        $this->entity = $tenant;
    }

    public function getAllTenants()
    {
        return $this->entity->all();
    }

    public function getTenantByUuid(String $uuid){
        return $this->entity->where("uuid", $uuid)->first();
    }
}
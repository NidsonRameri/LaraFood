<?php

namespace App\Models\Traits;

use App\Models\Tenant;
use phpDocumentor\Reflection\Types\Boolean;

trait UserACLTrait{
    public function permissions(): array{
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();
        
        $permissions = [];
        foreach($permissionsRole as $permissionRole){
            if (in_array($permissionRole, $permissionsPlan)){
                array_push($permissions, $permissionRole);
            }
        }

        return $permissions;
        
    }

    public function permissionsPlan(): array{
        // $tenant = $this->tenant()->first(); ou
        // $tenant = $this->tenant;
        // $plan = $tenant->plan()->first(); ou
        // $plan = $tenant->plan;
        /**
         * OTIMIZANDO BUSCA COM O 'WITH'
         */
        $tenant = Tenant::with("plan.profiles.permissions")->where("id", $this->tenant_id)->first();
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile){
            foreach ($profile->permissions as $permission){
                array_push($permissions, $permission->name); // incluir permission no array permissionS []
            }
        }
        return  $permissions;
    }

    public function permissionsRole(): array {
        $roles = $this->roles()->with("permissions")->get();
        $permissions = [];
        //trabalhando com o nome das permissões, mas pode retornar o objeto tb....
        foreach($roles as $role){
            foreach ($role->permissions as $permission){
                array_push($permissions, $permission->name); // incluir permission no array permissionS []
            }
        }

        return $permissions;
    
    }

    public function hasPermission(String $permissionName): bool{
        return in_array($permissionName, $this->permissions()); // verificar se há permissão no array de permissoes
    }

    public function isAdmin(): bool{
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool{
        return !in_array($this->email, config('acl.admins'));
    }
}
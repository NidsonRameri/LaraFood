<?php

namespace App\Models\Traits;

use phpDocumentor\Reflection\Types\Boolean;

trait UserACLTrait{
    public function permissions(){
        
        // $tenant = $this->tenant()->first(); ou
        $tenant = $this->tenant;
        // $plan = $tenant->plan()->first(); ou
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile){
            foreach ($profile->permissions as $permission){
                array_push($permissions, $permission->name); // incluir permission no array permissionS []
            }
        }
        return  $permissions;
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
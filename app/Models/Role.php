<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get Permissions
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);    //Se tabela tivesse nome diferente ao tradicional criado pelo larave, passar aqui como segundo parametro
    }

    /**
     * Get Users
     */
    public function users(){
        return $this->belongsToMany(User::class);    //Se tabela tivesse nome diferente ao tradicional criado pelo larave, passar aqui como segundo parametro
    }

    /**
     * Permission not linked with this role
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query){ //subquery
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id={$this->id}");
        }) //SELECT * FROM 'permissions' WHERE id NOT IN (SELECT permission_id FROM 'permission_role' WHERE role_id=2)
        ->where(function ($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })        
        ->paginate();

        return $permissions;
    }
}

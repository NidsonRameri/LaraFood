<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get Permissions
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);    //Se tabela tivesse nome diferente ao tradicional criado pelo larave, passar aqui como segundo parametro
    }

    /**
     * Permission not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query){ //subquery
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        }) //SELECT * FROM 'permissions' WHERE id NOT IN (SELECT permission_id FROM 'permission_profile' WHERE profile_id=2)
        ->where(function ($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })        
        ->paginate();

        return $permissions;
    }
}


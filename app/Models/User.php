<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tenant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Tenant
     */
    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get Roles
     */
    public function roles(){
        return $this->belongsToMany(Role::class);    //Se tabela tivesse nome diferente ao tradicional criado pelo larave, passar aqui como segundo parametro
    }

    /**
     * The "booted" method of the model. ESCOPO GLOBAL
     *
     * @return void
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope('tenant', function (Builder $builder) {
    //         $builder->where('tenant_id', auth()->user()->tenant_id); //trazer usuario cujo o tenant sejam o tenant do usuário autenticado
    //     });
    // }

    /**
     * Scope a query to only users by tenant. ESCOPO LOCAL
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query){
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    /**
     * Role not linked with this user
     */
    public function rolesAvailable($filter = null)
    {
        $roles = Role::whereNotIn('roles.id', function($query){ //subquery
            $query->select('role_user.role_id');
            $query->from('role_user');
            $query->whereRaw("role_user.user_id={$this->id}");
        }) //SELECT * FROM 'roles' WHERE id NOT IN (SELECT role_id FROM 'role_role' WHERE role_id=2)
        ->where(function ($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('roles.name', 'LIKE', "%{$filter}%");
        })        
        ->paginate();

        return $roles;
    }
}

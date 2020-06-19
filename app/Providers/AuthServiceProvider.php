<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::all();

        foreach ($permissions as $permission){
            Gate::define($permission->name, function(User $user) use ($permission){ //passando permission pra dentro da funçao de CB
                return $user->hasPermission($permission->name); 
            }); 
        }



        // Gate::define('Mandar em tudo', function(User $user){ //nome da permissão e funcao de CB
        //     return $user->hasPermission('Mandar em tudo'); 
        // }); 

        Gate::define('owner', function(User $user, $object){ //User -> auto user autenticado
            return $user->id === $object->user_id; //usuário é dono do produto?
        });

        //Gate::allows('owner', $object); // verificar se usuário tem essa habilidade|| denies => bloquear **contrario do allows
        Gate::before(function (User $user){
            if ($user->isAdmin()){
                return true;
            }
        });
    }
}

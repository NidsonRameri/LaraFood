<?php

namespace App\Tenant\Scopes;

use App\Tenant\MenageTenant;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TenantScope implements Scope{ //CRIANDO SCOPE
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model){
        
        $builder->where('tenant_id', app(MenageTenant::class)->getTenantIdentify());
        //filtrar pela coluna 'tenant_id' => igual, nao precisa passar indicador ('<'), ->
    }
}
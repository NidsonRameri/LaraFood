<?php

namespace App\Tenant\Observers;

use App\Tenant\MenageTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver{

    /*
     * Handle the Category "creating" event. 
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $menagerTenant = app(MenageTenant::class);

        $identify = $menagerTenant->getTenantIdentify();

        if ($identify)
            $model->tenant_id = $identify;
    }
}
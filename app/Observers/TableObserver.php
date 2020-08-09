<?php

namespace App\Observers;

use App\Models\Table;
use Illuminate\Support\Str;


class TableObserver
{
    // SE ESTIVER USANDO O MODEL PARA CADASTRAR...
    /**CREATING, ANTES DE CADASTRAR // REGISTRAR OBSERVER NO APPSERVICEPROVIDER
     * Handle the Table "creating" event. 
     *
     * @param  \App\Models\Table  $Table
     * @return void
     */
    public function creating(Table $table)
    {
        $table->uuid = Str::uuid();
    }
}

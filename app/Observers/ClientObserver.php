<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;


class ClientObserver
{   // SE ESTIVER USANDO O MODEL PARA CADASTRAR...
    /**CREATING, ANTES DE CADASTRAR // REGISTRAR OBSERVER NO APPSERVICEPROVIDER
     * Handle the Client "creating" event. 
     *
     * @param  \App\Models\Client  $Client
     * @return void
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
    }
}

<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> RepositoryServiceProvider
    //(sim eloquent) model
    protected $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;       
    }

    public function createNewClient(array $data){
        $data['password'] = bcrypt($data['password']);
        return $this->entity->create($data);
    }
    public function getClient(int $id){

    }
    
}
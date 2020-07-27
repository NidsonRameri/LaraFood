<?php

namespace App\Repositories\Contracts;

interface ClientRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> 
    public function createNewClient(array $data);
    public function getClient(int $id);
}
<?php

namespace App\Repositories\Contracts;

interface OrderEvaluationRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> 
    public function newEvaluationOrder(int $idOrder, int $idClient, array $evaluationData);
    public function getEvaluationsByOrder(int $idOrder);
    public function getEvaluationsByClient(int $idClient);
    public function getEvaluationsById(int $id);
    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient);
}
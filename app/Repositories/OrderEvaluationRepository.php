<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\OrderEvaluationRepositoryInterface;

class OrderEvaluationRepository implements OrderEvaluationRepositoryInterface{
    //Criando API --- 4º PASSO =>(prox)=> RepositoryServiceProvider
    protected $entity;
    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;       
    }

    public function newEvaluationOrder(int $idOrder, int $idClient, array $evaluationData)
    {
        $data = [
            'client_id' => $idClient,
            'order_id' => $idOrder,
            'stars' => $evaluationData['stars'],
            'comment' => isset($evaluationData['comment']) ? $evaluationData['comment'] : '', //isset = SE EXISTIR
        ];

        return $this->entity->create($data);
    }
    public function getEvaluationsByOrder(int $idOrder)
    {
        return $this->entity->where('order_id', $idOrder)->get();
    }
    public function getEvaluationsByClient(int $idClient)
    {
        return $this->entity->where('client_id', $idClient)->get();
    }
    public function getEvaluationsById(int $id)
    {
        return $this->entity->find($id);
    }
    public function getEvaluationsByClientIdByOrderId(int $idOrder, int $idClient)
    {
        return $this->entity
                    ->where('client_id', $idClient)
                    ->where('order_id', $idOrder)
                    ->first();
    }
    
    
}
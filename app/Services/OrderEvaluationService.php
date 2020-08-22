<?php

namespace App\Services;

use App\Repositories\Contracts\OrderEvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderEvaluationService{
    //Criando API --- 3º PASSO =>(prox)=> CategoryRepositoryInterface && CategoryRepository

    protected $evaluationRepository, $orderRepository;

    public function __construct(
            OrderEvaluationRepositoryInterface $evaluation,
            OrderRepositoryInterface $order)
    {
        $this->evaluationRepository = $evaluation;
        $this->orderRepository = $order;
    }

    public function createNewEvaluation(string $identifyOrder, array $evaluationData)
    {
        $idClient = $this->getIdClient();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->newEvaluationOrder($order->id, $idClient, $evaluationData);
    }

    private function getIdClient()
    {
        return auth()->user()->id;
    }
}
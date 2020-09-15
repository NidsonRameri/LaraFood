<?php

namespace Tests\Feature\Api;

use App\Models\Order;
use Illuminate\Support\Str;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * Test Error create new evaluation.
     *
     * @return void
     */
    public function testErrorCreateNewEvaluation()
    {
        $order = "fake_value";

        $response = $this->postJson("/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }

    /**
     * Test create new evaluation.
     *
     * @return void
     */
    public function testCreateNewEvaluation()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken; //sanctum || criando token para esse client acima

        $order = $client->orders()->save(factory(Order::class)->make());

        $payload = [
            'stars' => 5,
            'comment' => Str::random(15),
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson(
            "/auth/v1/orders/{$order}/evaluations",
            $payload,
            $headers
        );

        $response->assertStatus(201); //200||201 por conta da url fora do padrão...
                                      // especificado no evaluationApiController
    }
}

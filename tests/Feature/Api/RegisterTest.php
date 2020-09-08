<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Erro create new client.
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'email' => 'test@teste.com.br',
            'name' => 'Testino da Silva'
        ]; 

        $response = $this->postJson('/api/auth/register', $payload);

        $response->dump();

        $response->assertStatus(422);
                //    ->assertExactJson([
                //        "message" => "The given data was invalid.",
                //         "errors" => [
                //             "password" => [trans('validation.required', ['attribute' => 'password'])] //ou escrever a mensagem de erro exatamente
                //         ]
                //    ]);
    }

    /**
     * Success create new client.
     *
     * @return void
     */
    public function testSuccessCreateNewClient()
    {
        $payload = [
            'email' => 'test@teste.com.br',
            'name' => 'Testino da Silva',
            'password' => '123456'
        ]; 

        $response = $this->postJson('/api/auth/register', $payload);

        $response->dump();

        $response->assertStatus(201)
                    ->assertExactJson([ //Levar em consideração maiusc ou min, ou carac especial
                        'data' => [
                            'name' => $payload['name'],
                            'email' => $payload['email'],
                        ]
                    ]);
    }
}

<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Validate create a new order.
     *
     * @return void
     */
    public function testValidationCreateNewOrder()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422)
                    ->assertJsonPath('errors.token_company', [
                        trans('validation.required', ['attribute' => 'token company'])
                    ])
                    ->assertJsonPath('errors.products', [
                        trans('validation.required', ['attribute' => 'products'])
                    ]);
    }

    /**
     * Create a new order.
     *
     * @return void
     */
    public function testCreateNewOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 10)->create();

        foreach ($products as $product)
        {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Total order.
     *
     * @return void
     */
    public function testTotalOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];
 
        $products = factory(Product::class, 2)->create();

        foreach ($products as $product)
        {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);
        // $response->dump();

        $response->assertStatus(201)
                    ->assertJsonPath('data.total', 25.8);
    }

    /**
     * Test order not found.
     *
     * @return void
     */
    public function testOrderNotFound(){
        $order = 'fake_value';

        $response = $this->getJson("/api/v1/orders/{$order}");
    
        $response->assertStatus(404);
    }

    /**
     * Test get order.
     *
     * @return void
     */
    public function testGetOrder(){
        $order = factory(Order::class)->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");
    
        $response->assertStatus(200);
    }

    /**
     * Test create new total authenticated.
     *
     * @return void
     */
    public function testCreateNewOrderAuthenticated()
    {
        $client =  factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken; //sanctum || criando token para esse client acima
        
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];
 
        $products = factory(Product::class, 2)->create();

        foreach ($products as $product)
        {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/auth/v1/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);
        //$response->dump();

        $response->assertStatus(201);
    }

    /**
     * Test create new total with table.
     *
     * @return void
     */
    public function testCreateNewOrderWithTable()
    {
        $table = factory(Table::class)->create();        
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'table' => $table->uuid,
            'products' => [],
        ];
 
        $products = factory(Product::class, 2)->create();

        foreach ($products as $product)
        {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);
        $response->dump();

        $response->assertStatus(201);
    }

    /**
     * Test get my orders.
     *
     * @return void
     */
    public function testGetMyOrders()
    {
        $client =  factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken; //sanctum || criando token para esse client acima

        factory(Order::class, 10)->create(['client_id' => $client->id]);

        $response = $this->getJson('/api/auth/v1/my-orders', [
            'Authorization' => "Bearer {$token}"
        ]);

        // $response->assertStatus(200);
 
        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }
}

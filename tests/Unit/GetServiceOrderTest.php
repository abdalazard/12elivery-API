<?php

namespace Tests\Unit;

use App\Models\ServiceOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetServiceOrderTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_list_service_orders() {
        //Arrange
        $authUser = $this->user;        
        $serviceOrderA = ServiceOrder::factory()->create();
        $serviceOrderB = ServiceOrder::factory()->create();
        $serviceOrderC = ServiceOrder::factory()->create();

        //Act
        $response = $this->actingAs($authUser)->getJson("/api/service-orders/");

        //Assert 
         $response->assertStatus(200)
         ->assertJsonCount(3, 'data')
         ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'vehiclePlate',
                    'entryDateTime',
                    'exitDateTime',
                    'priceType',
                    'price',
                    'userId'
                ],
            ],
        ])
        ->assertJsonFragment(['id' => $serviceOrderA->id])
        ->assertJsonFragment(['id' => $serviceOrderB->id])
        ->assertJsonFragment(['id' =>  $serviceOrderC->id]);
     }
}

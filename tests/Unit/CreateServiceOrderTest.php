<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateServiceOrderTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

    public function test_create_service_order() {
        //Arrange
        $authUser = $this->user;
 
         $data = [
             'vehiclePlate' => 'ABC1234',
             'entryDateTime' => now()->format('Y-m-d H:i:s'),
             'exitDateTime' => now()->format('Y-m-d H:i:s'),
             'priceType' => 'Hourly',
             'price' => '100.00',
             'userId' => $authUser->id,
         ];
 
        //Act
        $response = $this->actingAs($authUser)->postJson('/api/service-orders', $data);
 
        //Assert 
         $response->assertStatus(201);
     }
}

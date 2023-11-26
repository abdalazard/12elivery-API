<?php

namespace Tests\Unit;

use App\Models\ServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceOrderTest extends TestCase
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

    public function test_delete_service_order() {
        //Arrange
        $authUser = $this->user;

        $serviceOrder = new ServiceOrder([
            'vehiclePlate' => 'ABC1234',
            'entryDateTime' => now()->format('Y-m-d H:i:s'),
            'exitDateTime' => now()->format('Y-m-d H:i:s'),
            'priceType' => 'Hourly',
            'price' => '100.00',
            'userId' => $authUser->id,
        ]);
        $serviceOrder->save();

         //Act
        $response = $this->actingAs($authUser)->delete("/api/service-orders/$serviceOrder->id");

        //Assert 
        $response->assertStatus(200);
    }
}

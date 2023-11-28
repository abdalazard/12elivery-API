<?php

namespace Tests\Unit;

use App\Models\ServiceOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteServiceOrderTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;

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

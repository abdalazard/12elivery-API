<?php

namespace Tests\Unit;

use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateServiceOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_validates_request_data()
    {
        // Arrange
        $user = User::factory()->create();
        $serviceOrder = ServiceOrder::factory()->create();

        // Act
        $response = $this->actingAs($user)->putJson("/api/service-orders/{$serviceOrder->id}", []);

        // Assert
        $response->assertStatus(Response::HTTP_OK)
        ->assertJsonMissingValidationErrors([
            'vehiclePlate',
            'entryDateTime',
            'exitDateTime',
            'priceType',
            'price',
            'userId',
        ]);
    }

    public function test_update_updates_service_order()
    {
        // Arrange
        $user = User::factory()->create();
        $data = [
            'vehiclePlate' => 'ABC1234',
            'entryDateTime' => now()->format('Y-m-d H:i:s'),
            'exitDateTime' => now()->tomorrow()->format('Y-m-d H:i:s'),
            'priceType' => 'hourly',
            'price' => 50.00,
            'userId' => $user->id,
        ];
        $serviceOrder = ServiceOrder::create($data);

        $updated = [
            'vehiclePlate' => 'DEF4568',
            'entryDateTime' => now()->format('Y-m-d H:i:s'),
            'exitDateTime' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'priceType' => 'hourly',
            'price' => 90.00,
            'userId' => $user->id,
        ];

        // Act
        $response = $this->actingAs($user)->putJson("/api/service-orders/{$serviceOrder->id}", $updated);

        // Assert
        $response->assertStatus(Response::HTTP_OK)
        ->assertJson(['message' => 'Service order updated successfully']);

        $this->assertDatabaseHas('service_orders', $updated);
    }

    public function test_update_returns_not_found_error()
    {
        // Arrange
        $user = User::factory()->create();
        $nonExistingServiceOrderId = 999;

        // Act
        $response = $this->actingAs($user)->putJson("/api/service-orders/{$nonExistingServiceOrderId}", []);

        // Assert
        $response->assertStatus(Response::HTTP_NOT_FOUND)
        ->assertJson(['message' => 'Service order not updated.']);
    }
}
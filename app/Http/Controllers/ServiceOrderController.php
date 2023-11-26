<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrder;

class ServiceOrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'vehiclePlate' => 'required|string|unique:service_orders|size:7',
            'entryDateTime' => 'required|date',
            'exitDateTime' => 'required|date',
            'priceType' => 'sometimes|string',
            'price' => 'sometimes|string',
            'userId' => 'required|integer',
        ]);

        $serviceOrder = ServiceOrder::create($request->all());

        return response()->json($serviceOrder, 201);
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
        $serviceOrder = ServiceOrder::findOrFail($id);

        if (!$serviceOrder) {
            return response()->json(['message' => 'Service order not found'], 404);
        }
    
        $serviceOrder->delete();
    
        return response()->json(['service_order' => $serviceOrder->id, 'status' => 200]);
    }

    public function index(Request $request)
    {
    }
}

<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Register
Route::post('/register', [RegisterController::class, 'create']);

//Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::get('/service-orders', [ServiceOrderController::class, 'index']);
    Route::post('/service-orders', [ServiceOrderController::class, 'create']);
//     Route::put('/service-orders/{id}', [ServiceOrderController::class, 'update']);
    Route::delete('/service-orders/{id}', [ServiceOrderController::class, 'delete']);
});

// Route::get('/test', function() {
//     return "teste sem autenticação";
// });
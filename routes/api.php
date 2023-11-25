<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
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

//Register ----> À fazer
Route::post('/register', [RegisterController::class, 'create']);

//Login
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/authtest', function() {
        return "teste com autenticação";
    });
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});

// Route::get('/test', function() {
//     return "teste sem autenticação";
// });
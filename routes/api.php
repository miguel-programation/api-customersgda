<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




/*Para poder proteger todas las rutas api, debemos colocar estas dentro del grupo middleeare....
autenticacion con el paquete laravel sanctum */


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('customers', [CustomerController::class, 'index']);

    Route::post('register', [AuthController::class, 'register']);

    Route::post('login', [AuthController::class, 'login']);

    Route::post('store', [CustomerController::class, 'store']);

    Route::get('consulta', [CustomerController::class, 'index']);

    Route::delete('borrar/{dni}', [CustomerController::class, 'destroy']);
});

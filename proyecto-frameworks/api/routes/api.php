<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\CategoriaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/gasto/select', [GastoController::class, 'select']);
Route::post('/gasto/store', [GastoController::class, 'store']);
Route::put('/gasto/update/{id}', [GastoController::class, 'update']);
Route::get('/gasto/find/{id}', [GastoController::class, 'find']);
Route::delete('/gasto/delete/{id}', [GastoController::class, 'delete']);


Route::get('/ingreso/select', [IngresoController::class, 'select']);
Route::post('/ingreso/store', [IngresoController::class, 'store']);
Route::put('/ingreso/update/{id}', [IngresoController::class, 'update']);
Route::get('/ingreso/find/{id}', [IngresoController::class, 'find']);
Route::delete('/ingreso/delete/{id}', [IngresoController::class, 'delete']);

Route::get('/categoria/select', [CategoriaController::class, 'select']);
Route::post('/categoria/store', [CategoriaController::class, 'store']);
Route::get('/categoria/find/{id}', [CategoriaController::class, 'find']);
Route::put('/categoria/update/{id}', [CategoriaController::class, 'update']);
Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'delete']);

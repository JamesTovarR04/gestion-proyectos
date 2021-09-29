<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ProyectoController;
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


Route::post('proyectos', [ProyectoController::class, 'store']);

Route::post('empleados', [EmpleadoController::class, 'store']);

Route::post('tareas', [TareaController::class, 'store']);

Route::post('documentos', [DocumentoController::class, 'store']);


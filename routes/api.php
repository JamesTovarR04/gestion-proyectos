<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ProyectoController;
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

// RUTAS DE PROYECTOS
Route::apiResource('proyectos', ProyectoController::class);
Route::post('proyectos/{idProyecto}/tareas',[ProyectoController::class,'addTarea']);
Route::get('proyectos/{idProyecto}/tareas', [ProyectoController::class, 'showTareas']);

// RUTAS DE EMPLEADOS
Route::apiResource('empleados', EmpleadoController::class);

// RUTAS DE LAS TAREAS
Route::apiResource('tareas', TareaController::class);
Route::post('tareas/{idTarea}/empleado/{idEmpleado}', [TareaController::class, 'setEmpleado']);
Route::post('tareas/{idTarea}/documentos', [TareaController::class, 'addDocument']);

// RUTAS DE LOS DOCUMENTOS
Route::apiResource('documentos', DocumentoController::class);

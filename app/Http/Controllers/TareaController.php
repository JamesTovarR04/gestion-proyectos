<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Empleado;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    // Listar tareas
    public function index(){
        return Tarea::get();
    }

    // Buscar tareas porsu tipo
    public function show($id)
    {
        $tarea = Tarea::find($id);
        $tarea['recurso-empleado'] = $tarea->empleado;
        return $tarea;
    }

    //Eliminar tarea
    public function destroy($id){
        $tareaAEliminar = Tarea::find($id);
        $tareaAEliminar->delete();
        return response()->json(["result"=>" tarea eliminada"], 200);
    }

    //Editar tarea
    public function update(Request $request, $id){
        
        $validacion = Validator::make($request->all(),[
            'nombre' => 'string|min:1',
            'descripcion' => 'string|min:5|max:200',
            'tipo' => 'string|min:1',
            'fecha_ini_estimada' => 'date',
            'fecha_ini_real' => 'date',
            'duracion_estimada' => 'int',
            'duracion_real' => 'int',
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $tarea = Tarea::find($id);

        if($request['nombre']){
            $tarea->nombre = $request['nombre'];
        }
        if($request['descripcion']) {
            $tarea->descripcion = $request['descripcion'];
        }
        if ($request['tipo']) {
            $tarea->descripcion = $request['tipo'];
        }
        if ($request['fecha_ini_estimada']) {
            $tarea->fecha_ini_estimada = $request['fecha_ini_estimada'];
        }
        if ($request['fecha_ini_real']) {
            $tarea->descripcion = $request['fecha_ini_real'];
        }
        if ($request['duracion_estimada']) {
            $tarea->duracion_estimada = (int)$request['duracion_estimada'];
        }
        if ($request['duracion_real']) {
            $tarea->duracion_real = (int)$request['duracion_real'];
        }

        $tarea->save();

        return response()->json(["result" => " tarea actualizada"], 200);
    }

    // Establecer empleado de tarea
    public function setEmpleado($idTarea,$idEmpleado)
    {
        $tarea = Tarea::find($idTarea);
        $empleado = Empleado::find($idEmpleado);

        $tarea->empleado()->associate($empleado);

        $tarea->save();

        return response()->json(["result" => "se estableció el empleado"], 200);
    }

    // Agregar documento
    public function addDocument(Request $request, $idTarea)
    {
        $validacion = Validator::make($request->all(), [
            'codigo'    => 'required|string|max:20',
            'descripcion'  => 'required|string|max:200',
            'tipo' => 'required|string|max:20'
        ]);

        if ($validacion->fails()) {
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $documento = new Documento;

        $documento->codigo = $request->codigo;
        $documento->descripcion = $request->descripcion;
        $documento->tipo = $request->tipo;

        $tarea = Tarea::find($idTarea);
        $tarea->documentos()->save($documento);

        return response()->json(["result" => "creado"], 201);
    }

}

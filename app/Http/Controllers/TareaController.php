<?php

namespace App\Http\Controllers;

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
        return Tarea::find($id);
    }

    //Crear tarea
    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(),[
            'nombre' => 'required|string|min:1',
            'descripcion' => 'required|string|min:5|max:200',
            'tipo' => 'required|string|min:1',
            'fecha_ini_estimada' => 'required|date',
            'fecha_ini_real' => 'required|date',
            'duracion_estimada' => 'required|int',
            'duracion_real' => 'required|int'
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $tarea = new Tarea;

        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->tipo = $request->tipo;
        $tarea->fecha_ini_estimada = $request->fecha_ini_estimada;
        $tarea->fecha_ini_real = $request->fecha_ini_real;
        $tarea->duracion_estimada = (int)$request->duracion_estimada;
        $tarea->duracion_real = (int)$request->duracion_real;

        $tarea->save();

        return response()->json(["result"=>"creado"], 201);
    }

    //Eliminar tarea
    public function destroy($id){
        $tareaAEliminar = Tarea::find($id);
        $tareaAEliminar->delete();
        return response()->json(["result"=>"eliminado"], 200);
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
            'duracion_real' => 'int'
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

        return response()->json(["result" => "actualizado"], 200);
    }
}

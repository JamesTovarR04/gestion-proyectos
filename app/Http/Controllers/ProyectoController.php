<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProyectoController extends Controller
{

    //listar todos los proyectos
    public function index()
    {
        return Proyecto::get();
    }

    //Busqueda
    public function show($id)
    {
        return Proyecto::find($id);
    }

    //crea el proyecto
    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(),[
            'nombre_clave'    => 'required|unique:true|string|max:100',
            'denominacion_comercial'  => 'required|string|max:40',
            'fecha_inicio'     => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'estado' => 'required|boolean',
            'id_promotor' => 'required|string'
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $proyecto = new Proyecto;

        $proyecto->nombre_clave = $request->nombre_clave;
        $proyecto->denominacion_comercial = $request->denominacion_comercial;
        $proyecto-> fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_finalizacion = $request->fecha_finalizacion;
        $proyecto->estado = boolval($request->estado);

        $promotor = Empleado::find($request->id_promotor);

        $proyecto->promotor()->associate($promotor);

        $proyecto->save();

        return response()->json(["result"=>"creado"], 201);
    }

    //eliminar
    public function destroy($id)
    {
        $proyectoAEliminar = Proyecto::find($id);
        $proyectoAEliminar->delete();
        return response()->json(["result"=>"eliminado"], 200);
    }

    // Editar proyecto
    public function update(Request $request, $id)
    {
        
        $validacion = Validator::make($request->all(),[
            'nombre_clave'    => 'string|max:100',
            'denominacion_comercial'  => 'string|max:40',
            'fecha_inicio'     => 'date',
            'fecha_finalizacion' => 'date',
            'estado' => 'boolean'
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $proyecto = Proyecto::find($id);

        if($request['nombre_clave']){
            $proyecto->nombre_clave = $request['nombre_clave'];
        }
        if($request['denominacion_comercial']){
            $proyecto->denominacion_comercial = $request['denominacion_comercial'];
        }
        if($request['fecha_inicio']){
            $proyecto->fecha_inicio = $request['fecha_inicio'];
        }
        if($request['fecha_finalizacion']){
            $proyecto->fecha_finalizacion = $request['fecha_finalizacion'];
        }
        if($request['estado']){
            $proyecto->estado = $request['estado'];
        }

        $proyecto->save();

        return response()->json(["result" => "actualizado"], 200);
    }

    // Agregar Tareas
    public function addTarea(Request $request, $idProyecto)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required|string|min:1',
            'descripcion' => 'required|string|min:5|max:200',
            'tipo' => 'required|string|min:1',
            'fecha_ini_estimada' => 'required|date',
            'fecha_ini_real' => 'required|date',
            'duracion_estimada' => 'required|int',
            'duracion_real' => 'required|int',
            'id_empleado' => 'string'
        ]);

        if ($validacion->fails()) {
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

        if($request['id_empleado']){
            $empleado = Empleado::find($request->id_empleado);
            $tarea->empleado()->associate($empleado);
            $tarea->save();
        }

        $proyecto = Proyecto::find($idProyecto);
        $proyecto->tareas()->save($tarea);

        return response()->json(["result" => "se agregó la tarea"], 200);

    }

    // Ver Tareas
    public function showTareas($idProyecto)
    {
        $tareas = Tarea::where('proyecto_id',$idProyecto)->get();

        return $tareas;
    }

}
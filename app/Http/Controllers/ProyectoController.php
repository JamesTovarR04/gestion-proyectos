<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
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
            'denominacion_comercial'  => 'required|string|max:20',
            'fecha_inicio'     => 'required|date',
            'fecha_finalizacion' => 'required|date',
            'estado' => 'required|boolean'
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

}
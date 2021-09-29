<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    //crear tarea

    public function store(Request $request)
    {
        $tarea = new Tarea;

        $tarea->descripcion = $request->descripcion;
        $tarea->tipo = $request->tipo;
        $tarea->fecha_ini_estimada = $request->fecha_ini_estimada;
        $tarea->fecha_ini_real = $request->fecha_ini_real;
        $tarea->duracion_estimada = $request->duracion_estimada;
        $tarea->duracion_real = $request->duracion_real;


        $tarea->save();

        return response()->json(["result"=>"creado"], 201);
    }
}

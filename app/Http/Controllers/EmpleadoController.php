<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    //crear el empleado 

    public function store(Request $request)
    {
        $empleado = new Empleado;

        $empleado->identificacion = $request->identificacion;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->direccion = $request->direccion;
        $empleado->telefono = $request->telefono;
        $empleado->correo_electronico = $request->correo_electronico;
        $empleado->feha_contrato = $request-> fecha_contrato;


        $empleado->save();

        return response()->json(["result"=>"creado"], 201);
    }

}

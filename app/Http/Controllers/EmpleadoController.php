<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    
    public function store(Request $request)
    {
        $empleado = new Empleado;

        $empleado->nombre = $request->nombre;

        $empleado->save();

        return response()->json(["result"=>"creado"], 201);
    }

}

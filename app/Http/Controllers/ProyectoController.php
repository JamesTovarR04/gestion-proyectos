<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    //crea el proyecto
    public function store(Request $request)
    {
        $proyecto = new Proyecto;

        $proyecto->nombre_clave = $request->nombre_clave;
        $proyecto->denominacion_comercial = $request->denominacion_comercial;
        $proyecto-> fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_finalizacion = $request->fecha_finalizacion;
        $proyecto->estado = $request-> estado;

        $proyecto->save();

        return response()->json(["result"=>"creado"], 201);
    }


      //listar proyectos
      public function delProyecto(Request $request)
      {
          $proyectos = DB::connection('gestion_proyectos')
              ->table('proyectos')
              ->select(
                  'id',
                  'nombre_clave',
                  'denominacion_comercial',
                  'fecha_inicio',
                  'fecha_finalizacion',
                  'estado',
              )
              ->where('id',$request->delProyecto()->id)
              ->paginate(5);
  
          return response()->json($proyectos);
      }



  

   

}
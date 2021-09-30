<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    //listar todos los empleados 
    public function index()
    {
        return Empleado::get();
    }

    //Busqueda
    public function show(Request $request, $id)
    {
        return Empleado::find($id);
    }

    //crear el empleado 

    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(),[
            'identificacion'    => 'required|int',
            'nombre'  => 'required|string|max:200',
            'apellido'  => 'required|string|max:200',
            'direccion'  => 'required|string|max:40',
            'telefono'  => 'required|string|max:30',
            'correo_electronico'  => 'required|string|max:200',
            'fecha_contrato'     => 'required|date',
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $empleado = new Empleado;

        $empleado->identificacion = $request->identificacion;
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->direccion = $request->direccion;
        $empleado->telefono = $request->telefono;
        $empleado->correo_electronico = $request->correo_electronico;
        $empleado->fecha_contrato = $request-> fecha_contrato;


        $empleado->save();

        return response()->json(["result"=>"creado"], 201);
    }

    //eliminar empleado 
    public function destroy($id)
    {
        $empleadoAEliminar = Empleado::fint($id);
        $empleadoAEliminar->delete();
        return response()->json(["result"=>"eliminado"], 200);
    }

    //Editar un empleado 
    public function update(Request $request, $id){

        $validacion = Validator::make($request->all(),[
            'identificacion'    => 'int',
            'nombre'  => 'string|max:200',
            'apellido'  => 'string|max:200',
            'direccion'  => 'string|max:40',
            'telefono'  => 'string|max:30',
            'correo_electronico'  => 'string|max:200',
            'fecha_contrato'     => 'date',
        ]);
        
        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $empleado = Empleado::find($id);

        if($request['identificacion']){
            $empleado->identificacion = $request['identificacion'];
        }

        if($request['nombre']){
            $empleado->nombre = $request['nombre'];
        }

        if($request['apellido']){
            $empleado->apellido = $request['apellido'];
        }

        if($request['direccion']){
            $empleado->direccion = $request['direccion'];
        }

        if($request['telefono']){
            $empleado->telefono = $request['telefono'];
        }

        if($request['correo_electronico']){
            $empleado->correo_electronico = $request['correo_electronico'];
        }
        
        if($request['fecha_contrato']){
            $empleado->fecha_contrato = $request['fecha_contrato'];
        }

        $empleado->save();

        return response()->json(["result" => "actualizado"], 200);

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentoController extends Controller
{
    //listar documentos
    public function index()
    {
        return Documento::get();
    }

    //buscar documento
    public function show($id)
    {
        return Documento::find($id);
    }
  
    //eliminar documento 
    public function destroy($id)
    {
        $documentoAEliminar = Documento::find($id);
        $documentoAEliminar->delete();
        return response()->json(["result"=>"documento eliminado"], 200);
    }

    //actualizar un documento
    public function update(Request $request, $id){

        $validacion = Validator::make($request->all(),[
            'codigo'    => 'string|max:20',
            'descripcion'  => 'string|max:200',
            'tipo' => 'string|max:20'
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $documento = Documento::find($id);

        if($request['codigo']){
            $documento->codigo = $request['codigo'];
        }

        if($request['descripcion']){
            $documento->descripcion = $request['descripcion'];
        }

        if($request['tipo']){
            $documento->tipo = $request['tipo'];
        }

        $documento->save();

        return response()->json(["result" => " documento actualizado"], 200);
    }

}

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

    //crear documento

    public function store(Request $request)
    {

        $validacion = Validator::make($request->all(),[
            'codigo'    => 'required|string|max:20',
            'descripcion'  => 'required|string|max:200',
            'tipo' => 'required|string|max:20'
        ]);

        if($validacion->fails()){
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $documento = new Documento;

        $documento->codigo = $request->codigo;
        $documento->descripcion = $request-> descripcion;
        $documento->tipo = $request->tipo;

        $documento->save();

        return response()->json(["result"=>"creado"], 201);
    }

    //eliminar documento 
    public function destroy($id)
    {
        $documentoAEliminar = Documento::find($id);
        $documentoAEliminar->delete();
        return response()->json(["result"=>"eliminado"], 200);
    }

}

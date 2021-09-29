<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    //crear documento

    public function store(Request $request)
    {
        $documento = new Documento;

        $documento->codigo = $request->codigo;
        $documento->descripcion = $request-> descripcion;
        $documento->tipo = $request->tipo;


        $documento->save();

        return response()->json(["result"=>"creado"], 201);
    }
}

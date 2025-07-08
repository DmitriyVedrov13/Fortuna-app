<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{
    public function index()
    {
        return Entrada::where('activo', true)->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo'   => 'required|string|max:255',
            'contenido'=> 'required|string',
            'imagen'   => 'nullable|string', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $entrada = Entrada::create([
            'titulo'    => $request->titulo,
            'contenido' => $request->contenido,
            'imagen'    => $request->imagen,
            'user_id'   => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Publicación creada',
            'entrada' => $entrada,
        ], 201);
    }

    public function show($id)
    {
        $entrada = Entrada::findOrFail($id);
        return response()->json($entrada);
    }

    public function update(Request $request, $id)
    {
        $entrada = Entrada::findOrFail($id);

        if ($entrada->user_id !== Auth::id()) {
            return response()->json(['message' => 'Sin derechos'], 403);
        }

        $entrada->update($request->only('titulo', 'contenido', 'imagen', 'activo'));

        return response()->json([
            'message' => 'Publicación actualizada',
            'entrada' => $entrada
        ]);
    }

    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);

        if ($entrada->user_id !== Auth::id()) {
            return response()->json(['message' => 'Sin derechos'], 403);
        }

        $entrada->delete();

        return response()->json(['message' => 'Publicación eliminadaа']);
    }
}

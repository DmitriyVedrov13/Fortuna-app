<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FortunePhrase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FortunePhraseController extends Controller
{
    /**
     * Mostrar la vista con todas las frases
     */
    public function index()
    {
        if (!Auth::user()->is_admin) {
            abort(Response::HTTP_FORBIDDEN, 'Acceso denegado. Solo administradores.');
        }

        $phrases = FortunePhrase::orderBy('created_at', 'desc')->get();
        return view('admin.frases.index', compact('phrases'));
    }

    /**
     * Guardar una nueva frase
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            abort(Response::HTTP_FORBIDDEN, 'Acceso denegado. Solo administradores.');
        }

        $validator = Validator::make($request->all(), [
            'phrase' => 'required|string|unique:fortune_phrases,phrase',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            FortunePhrase::create([
                'phrase' => $request->input('phrase')
            ]);
            return redirect()->back()->with('success', 'Frase agregada correctamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al guardar la frase: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar una frase existente
     */
    public function destroy($id)
    {
        if (!Auth::user()->is_admin) {
            abort(Response::HTTP_FORBIDDEN, 'Acceso denegado. Solo administradores.');
        }

        try {
            $phrase = FortunePhrase::findOrFail($id);
            $phrase->delete();
            return redirect()->back()->with('success', 'Frase eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la frase: ' . $e->getMessage());
        }
    }
}

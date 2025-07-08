<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\EntradaController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/user', [AuthController::class, 'user'])->middleware('auth');

Route::middleware('auth')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware('auth')->put('/user', function (Request $request) {
    $user = $request->user();

    $data = $request->validate([
        'name'  => 'sometimes|string|max:255',
        'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update($data);

    return response()->json([
        'message' => 'Datos de usuario actualizados',
        'user' => $user,
    ]);
});

Route::middleware('auth')->put('/user/password', function (Request $request) {
    $request->validate([
        'current_password' => 'required|string',
        'new_password'     => 'required|string|min:6|confirmed',
    ]);

    $user = $request->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'message' => 'La contraseña actual es incorrecta',
        ], 422);
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return response()->json([
        'message' => 'Contraseña actualizada con éxito',
    ]);
});

Route::middleware('auth')->delete('/user', function (Request $request) {
    $user = $request->user();
    $user->delete();

    return response()->json([
        'message' => 'Usuario eliminado'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::apiResource('entradas', EntradaController::class);
});

Route::get('/fortuna', function () {
    $mensajes = [
        "Hoy es un buen día para empezar algo nuevo.",
        "La paciencia es la llave del éxito.",
        "Recibirás una buena noticia muy pronto.",
        "Confía en ti mismo, los demás lo harán también.",
        "Cada día trae nuevas oportunidades.",
        "Tu esfuerzo pronto será recompensado.",
        "No tengas miedo de soñar en grande.",
        "Lo que das al mundo, vuelve a ti.",
        "Tu sonrisa cambiará el día de alguien.",
        "La suerte favorece a los valientes."
    ];

    $mensajeAleatorio = $mensajes[array_rand($mensajes)];

    return response()->json([
        'mensaje' => $mensajeAleatorio
    ]);
});
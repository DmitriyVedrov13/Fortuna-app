<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FortunaController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\FortunePhraseController;


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);
    return redirect('/galleta');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        // >> REGLA: Después del login, redirigir a /galleta
        return redirect()->intended('/galleta');
    }

    return back()->withErrors([
        'email' => 'Email o contraseña incorrectos.',
    ]);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/galleta', [FortunaController::class, 'vista'])->name('galleta');
    Route::get('/api/fortuna', [FortunaController::class, 'api']);
});

Route::get('/', function () {
    return redirect(route('galleta'));
});


//Route::middleware(['auth'])->group(function () {
//    Route::get('/admin/frases', [FortunePhraseController::class, 'index']);
//    Route::post('/admin/frases', [FortunePhraseController::class, 'store'])->name('admin.frases.store');
//});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/frases', [FortunePhraseController::class, 'index'])->name('admin.frases.index');
    Route::post('/admin/frases', [FortunePhraseController::class, 'store'])->name('admin.frases.store');
    Route::delete('/admin/frases/{id}', [FortunePhraseController::class, 'destroy'])->name('admin.frases.destroy');
});

//Route::middleware(['auth', 'is_admin'])->group(function () {
//    //dd('Middleware is_admin работает!');
//    Route::get('/admin/frases', [FortunePhraseController::class, 'index'])->name('admin.frases.index');
//    Route::post('/admin/frases', [FortunePhraseController::class, 'store'])->name('admin.frases.store');
//    Route::delete('/admin/frases/{id}', [FortunePhraseController::class, 'destroy'])->name('admin.frases.destroy');
//});


@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px;">
    <h2 style="margin-bottom: 20px;">Gestión de Frases de la Fortuna</h2>

    {{-- Mensajes de éxito y error --}}
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
    @endif

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul style="margin: 0; padding-left: 15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para agregar nueva frase --}}
    <form method="POST" action="{{ route('admin.frases.store') }}" style="margin-bottom: 20px;">
        @csrf
        <label for="phrase">Nueva Frase:</label>
        <input type="text" name="phrase" id="phrase" required style="margin-left: 5px; padding: 5px;">
        <button type="submit" style="margin-left: 10px; padding: 5px 10px; border: 1px solid #ccc; background-color: #e0e0e0; cursor: pointer;">Agregar</button>
    </form>

    <hr style="margin: 20px 0;">

    {{-- Lista de frases existentes con opción de eliminar --}}
    <h3>Frases Existentes:</h3>
    <ul style="list-style-type: none; padding-left: 0;">
        @forelse($phrases as $frase)
            <li style="margin-bottom: 10px;">
                {{ $frase->phrase }}
                <form action="{{ route('admin.frases.destroy', $frase->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar esta frase?')" style="margin-left: 10px; padding: 5px 8px; border: 1px solid #e53935; background-color: #ffcdd2; cursor: pointer;">Eliminar</button>
                </form>
            </li>
        @empty
            <li>No hay frases registradas.</li>
        @endforelse
    </ul>
</div>
@endsection


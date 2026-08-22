@extends('layouts.app')

@section('titulo', 'Editar contador')

@section('contenido')
<h1 class="h3 mb-4">Editar contador</h1>

<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body">
        <form action="{{ route('contadores.update', $contador) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">N° de contador</label>
                <input type="text" name="numero_contador"
                    class="form-control @error('numero_contador') is-invalid @enderror"
                    value="{{ old('numero_contador', $contador->numero_contador) }}">
                @error('numero_contador')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion"
                    class="form-control @error('direccion') is-invalid @enderror"
                    value="{{ old('direccion', $contador->direccion) }}">
                @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Lectura actual</label>
                <input type="number" step="0.01" name="lectura_actual"
                    class="form-control @error('lectura_actual') is-invalid @enderror"
                    value="{{ old('lectura_actual', $contador->lectura_actual) }}">
                @error('lectura_actual')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('contadores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
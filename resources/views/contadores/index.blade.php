@extends('layouts.app')

@section('titulo', 'Listado de contadores')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Contadores</h1>
    <a href="{{ route('contadores.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Nuevo contador
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>N° de contador</th>
                    <th>Dirección</th>
                    <th>Lectura actual</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contadores as $contador)
                <tr>
                    <td>{{ $contador->id }}</td>
                    <td>{{ $contador->numero_contador }}</td>
                    <td>{{ $contador->direccion }}</td>
                    <td>{{ number_format($contador->lectura_actual, 2) }}</td>
                    <td class="text-end">
                        <a href="{{ route('contadores.edit', $contador) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('contadores.destroy', $contador) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('¿Eliminar este contador?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No hay contadores registrados todavía.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
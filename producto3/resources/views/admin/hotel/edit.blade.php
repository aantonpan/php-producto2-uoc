@extends('admin.layout')

<!-- resources/views/admin/hotel/edit.blade.php -->
<div class="container py-4">
    <h2 class="mb-4 text-dark">
        <i class="bi bi-building"></i> Editar Hotel – {{ $hotel->nombre }}
    </h2>

    <form method="POST" action="{{ route('hoteladmin.update', $hotel->id_hotel) }}">
        @csrf
        @method('PUT') <!-- Metode PUT per a update segons REST -->

        <div class="card p-4 shadow-sm border-0">
            @include('admin.hotel._form_fields')

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-check-circle"></i> Guardar cambios
                </button>
                <a href="{{ route('hoteladmin.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>

@if (request('error') === 'empty')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            Swal.fire({ icon:'error', title:'Campos vacíos', text:'Por favor, rellena todos los campos obligatorios.' });
        });
    </script>
@elseif (request('success') === 'updated')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            Swal.fire({ icon:'success', title:'Hotel actualizado', text:'Los cambios se han guardado correctamente.' });
        });
    </script>
@endif

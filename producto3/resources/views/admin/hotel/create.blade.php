@extends('admin.layout')

<div class="container py-4">
    <h2 class="mb-4 text-dark"><i class="bi bi-building"></i> Crear Hotel</h2>

    <form method="POST" action="{{ route('hoteladmin.store') }}">
        @csrf <!-- Token CSRF de Laravel -->
        <div class="card p-4 shadow-sm border-0">
            @php
                $hotel = $hotel ?? null;
            @endphp

            @include('admin.hotel._form_fields')

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-check-circle"></i> Guardar
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
@elseif (request('success') === 'created')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            Swal.fire({ icon:'success', title:'Hotel creado', text:'El hotel se ha creado correctamente.' });
        });
    </script>
@endif

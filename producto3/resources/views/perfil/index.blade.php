@extends('layout')

@php
    $editando = request()->query('edit') === '1';
    $usuario = session('usuario');
@endphp

<div class="container py-4">
    <h2 class="mb-4 d-flex align-items-center gap-2 {{ $usuario['tipo'] === 'admin' ? 'text-dark' : '' }}">
        <i class="bi bi-person"></i> Mi Perfil
    </h2>

    @if (!empty($perfil))
        <div style="max-width: 960px;" class="mx-auto">
            <form method="POST" action="{{ route('perfil.edit') }}" enctype="multipart/form-data" class="card shadow-sm border-0 p-4">
                @csrf
                <div class="row align-items-start g-4">
                    <!-- Imagen de perfil -->
                    <div class="col-md-3 text-center d-flex flex-column align-items-center">
                        <img id="preview-perfil"
                             src="{{ !empty($perfil['imagen_perfil']) ? $perfil['imagen_perfil'] : 'https://via.placeholder.com/150' }}"
                             alt="Perfil"
                             class="img-thumbnail perfil-foto mb-2 rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">

                        @if ($editando)
                            <input type="file" class="form-control form-control-sm mt-2" name="imagen_perfil" id="imagen_perfil" accept="image/*" onchange="previewImagen(this)">
                        @endif
                    </div>

                    <!-- Información personal -->
                    <div class="col-md-9">
                        <div class="row g-3 mb-3">
                            @foreach (['nombre' => 'Nombre', 'apellido1' => 'Apellido 1', 'apellido2' => 'Apellido 2'] as $campo => $label)
                                <div class="col-md-3">
                                    <label class="form-label text-muted text-uppercase small fw-semibold">{{ $label }}</label>
                                    @if ($editando)
                                        <input type="text" name="{{ $campo }}" class="form-control" value="{{ $perfil[$campo] }}">
                                    @else
                                        <div class="form-control-plaintext">{{ $perfil[$campo] }}</div>
                                    @endif
                                </div>
                            @endforeach
                            <div class="col-md-3">
                                <label class="form-label text-muted text-uppercase small fw-semibold">Email</label>
                                @if ($editando)
                                    <input type="email" name="email" class="form-control" value="{{ $usuario['email'] }}">
                                @else
                                    <div class="form-control-plaintext">{{ $usuario['email'] }}</div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="row g-3 mb-2">
                            @foreach (['direccion' => 'Dirección', 'codigoPostal' => 'Código Postal', 'ciudad' => 'Ciudad', 'pais' => 'País'] as $campo => $label)
                                <div class="col-md-3">
                                    <label class="form-label text-muted text-uppercase small fw-semibold">{{ $label }}</label>
                                    @if ($editando)
                                        <input type="text" name="{{ $campo }}" class="form-control" value="{{ $perfil[$campo] }}">
                                    @else
                                        <div class="form-control-plaintext">{{ $perfil[$campo] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if ($editando)
                            <hr class="my-3">
                            <div class="row g-3 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label text-muted text-uppercase small fw-semibold">Nueva contraseña</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted text-uppercase small fw-semibold">Repetir contraseña</label>
                                    <input type="password" name="password2" class="form-control">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($editando)
                    <div class="mt-3 text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-save"></i> Guardar
                        </button>
                        <a href="{{ route('perfil.index') }}" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
                    </div>
                @endif
            </form>

            @unless($editando)
                <div class="mt-3 text-end">
                    <a href="{{ route('perfil.index', ['edit' => 1]) }}" class="btn btn-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square"></i> Editar Perfil
                    </a>
                </div>
            @endunless
        </div>
    @else
        <p><strong>Usuario:</strong> {{ $usuario['username'] ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $usuario['email'] ?? '-' }}</p>
        <p><strong>Tipo:</strong> {{ $usuario['tipo'] ?? '-' }}</p>
    @endif

    @if ($editando)
        <script>
            function previewImagen(input) {
                const file = input.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('preview-perfil').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>
    @endif
</div>

@if (session('success_perfil'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Perfil actualizado!',
            text: "{{ session('success_perfil') }}",
            confirmButtonColor: '#8e44ad'
        });
    </script>
@endif

@if (session('error_perfil'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error_perfil') }}",
            confirmButtonColor: '#8e44ad'
        });
    </script>
@endif

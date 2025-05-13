@php
    $type = request()->query('type', 'particular');
    $rol = $type === 'admin' ? 'Administrador' : 'Usuario Particular';
    $bg = $type === 'admin' ? 'bg-dark' : 'bg-primary';
@endphp

<style>
    .object-fit-cover {
        object-fit: cover;
    }

    .fade-slide-in {
        animation: fadeSlideIn 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="position-relative" style="min-height: 100vh; overflow: hidden;">
    <a href="{{ route('home') }}" class="position-absolute top-0 start-0 m-4 text-primary fs-3 z-2">
        <i class="bi bi-arrow-left-circle-fill"></i>
    </a>

    <img src="{{ asset('img/banner-login-registro.png') }}" alt="Fondo login" 
         class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
         style="z-index: 0; filter: none;">

    <div class="position-relative z-1 d-flex align-items-center justify-content-end" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="card text-white {{ $bg }} shadow fade-slide-in">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4">Login - {{ $rol }}</h2>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="type" value="{{ $type }}">

                                <div class="mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-light">Iniciar sesión</button>
                                </div>
                            </form>

                            @if ($type === 'particular')
                                <div class="mt-3 text-center">
                                    ¿No tienes cuenta? <a class="text-white" href="{{ route('register.form', ['type' => 'particular']) }}">Regístrate</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#8e44ad'
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Registro exitoso!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#8e44ad'
    });
</script>
@endif

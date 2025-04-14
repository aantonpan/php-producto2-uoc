<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registro de Usuario Particular</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="?r=auth/register">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirm" class="form-label">Repetir contraseña</label>
                            <input type="password" class="form-control" id="confirm" name="confirm" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Crear cuenta</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        ¿Ya tienes cuenta? <a href="?r=auth/login&type=particular">Inicia sesión</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

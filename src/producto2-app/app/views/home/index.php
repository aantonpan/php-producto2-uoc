<div class="container py-5">
    <h1 class="text-center mb-5">Bienvenido a TransfersApp</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <!-- CLIENTE -->
        <div class="col">
            <div class="card h-100 text-white bg-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Cliente</h5>
                    <p class="card-text">Accede como particular o empresa para hacer y consultar reservas.</p>
                    <div class="d-grid gap-2">
                        <a href="?r=auth/login&type=particular" class="btn btn-light">Soy Particular</a>
                        <a href="#" class="btn btn-outline-light disabled">Soy Empresa (no disponible)</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- HOTEL -->
        <div class="col">
            <div class="card h-100 text-white bg-secondary">
                <div class="card-body text-center">
                    <h5 class="card-title">Hotel</h5>
                    <p class="card-text">Acceso exclusivo para hoteles. (No implementado en este producto)</p>
                    <a href="#" class="btn btn-outline-light disabled">Acceder</a>
                </div>
            </div>
        </div>

        <!-- ADMINISTRADOR -->
        <div class="col">
            <div class="card h-100 text-white bg-dark">
                <div class="card-body text-center">
                    <h5 class="card-title">Administrador</h5>
                    <p class="card-text">Gestión completa de reservas, usuarios, hoteles y zonas.</p>
                    <a href="?r=auth/login&type=admin" class="btn btn-light">Soy Administrador</a>
                </div>
            </div>
        </div>

    </div>
</div>

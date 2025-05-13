<style>
    .cards-overlay {
        position: absolute;
        top: 60%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        width: 90%;
        animation: fadeInUp 0.8s ease-out;
    }
    .banner-wrapper {
        position: relative;
    }
    .banner-wrapper img {
        filter: none;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate(-50%, 20px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
    @media (max-width: 768px) {
        .cards-overlay {
            top: 15px;
            position: relative;
            transform: none;
            width: 100%;
            animation: none;
        }
    }
</style>

<div class="container-fluid p-0 banner-wrapper">
    <!-- BANNER -->
    <div class="banner-home">
        <img src="{{ asset('img/banner-home.png') }}" alt="Bienvenido a TransfersApp" class="img-fluid w-100">
    </div>

    <!-- TARJETAS FLOTANTES -->
    <div class="row row-cols-1 row-cols-md-3 g-4 cards-overlay">

        <!-- CLIENTE -->
        <div class="col">
            <div class="card h-100 text-white bg-primary shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Cliente</h5>
                    <p class="card-text">Accede como particular o empresa para hacer y consultar reservas.</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('auth.login', ['type' => 'particular']) }}" class="btn btn-light">Soy Particular</a>
                        <a href="#" class="btn btn-outline-light disabled">Soy Empresa (no disponible)</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- HOTEL -->
        <div class="col">
            <div class="card h-100 text-white bg-success shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Hotel</h5>
                    <p class="card-text">Acceso exclusivo para hoteles. (No implementado en este producto)</p>
                    <a href="#" class="btn btn-outline-light disabled">Acceder</a>
                </div>
            </div>
        </div>

        <!-- ADMINISTRADOR -->
        <div class="col">
            <div class="card h-100 text-white bg-dark shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Administrador</h5>
                    <p class="card-text">Gestión completa de reservas, usuarios, hoteles y zonas.</p>
                    <a href="{{ route('auth.login', ['type' => 'admin']) }}" class="btn btn-light">Soy Administrador</a>
                </div>
            </div>
        </div>

    </div>
</div>

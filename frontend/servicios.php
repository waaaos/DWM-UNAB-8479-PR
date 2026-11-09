<?php $titulo = "BIG BITE - Servicios"; include 'header.php'; ?>

<div class="container flex-grow-1 text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mb-4">
            <div class="section-box h-100 d-flex flex-column justify-content-center">
                <h4 class="mb-3 text-warning fw-bold">RESERVACIÓN</h4>
                <div class="w-100 mb-3 rounded reserva-img" style="background-image: url('mesas.jpg'); height: 200px; background-size: cover; background-position: center;"></div>
                <p class="fs-5 text-light mb-4">Quieres comer con nosotros de forma presencial? Asegura tu lugar en cualquiera de nuestras sucursales.</p>
                <button class="btn btn-outline-warning mt-auto mx-auto w-75 fw-bold" data-bs-toggle="modal" data-bs-target="#modalSucursales">VER MESAS DISPONIBLES</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
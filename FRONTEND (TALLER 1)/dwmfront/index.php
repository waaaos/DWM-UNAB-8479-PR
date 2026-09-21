<?php $titulo = "BIG BITE - Inicio"; include 'header.php'; ?>

<div class="container flex-grow-1 mt-4">
    <!-- PROMOS -->
    <div class="section-box">
        <h4 class="mb-4 text-warning">PROMOS</h4>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-5 mb-3">
                <img src="promo_hamburguesa.jpg" alt="Promo" class="img-fluid rounded shadow border border-2 border-warning img-promo">
            </div>
            
            <div class="col-md-5 mb-3">
                <div class="p-4 d-flex align-items-center justify-content-center" style="height: 100%; min-height: 220px;">
                    <div class="text-center">
                        <span class="fs-3 text-danger fw-bold d-block mb-1">Combo Clásico</span>
                        <span class="text-light fs-5">Hamburguesa Deluxe + Bebida</span>
                        <h4 class="text-warning mt-2 mb-3">$8.900</h4>
                        <button class="btn btn-outline-warning fw-bold px-4 py-2" onclick="cambiarCantidad('Combo Clásico', 1, 8900)">
                            + Añadir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-md-6 mb-3">
                <div class="section-box h-100">
                    <h4 class="mb-3 text-warning">SOMOS "BIG BITE"</h4>
                    <p>¡Bienvenidos a Big Bite! Nacimos con la idea de hacer las hamburguesas más deliciosas del mundo y para el mundo!. Nuestras carnes son 100% de verdad, tambien ofrecemos opciones veganas.</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="section-box h-100 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-2 text-warning">RESEÑAS</h4>
                        <blockquote class="blockquote mb-0 fs-6">
                            "La mejor hamburguesa q he comido xaval"
                            <footer class="blockquote-footer mt-2 text-light">BENJAMIN ARAYA</footer>
                        </blockquote>
                    </div>
                    <div class="bg-secondary rounded ms-3" style="min-width: 100px; height: 100px; background-image: url('hamburguesa.jpg'); background-size: cover; background-position: center;"></div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mb-5">
            <div class="col-md-7 col-lg-8 mb-3">
                <div class="section-box h-100">
                    <h4 class="mb-4 text-warning fw-bold fs-3 text-center">NUESTROS DESTACADOS</h4>
                    
                    <div id="contenedor-productos">
                        <div class="d-flex mb-3 align-items-center justify-content-between border-bottom border-dark pb-2 mt-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 rounded menu-img" style="background-image: url('hamburguesa.jpg'); width: 60px; height: 60px; background-size: cover; background-position: center;"></div>
                                <div>
                                    <p class="mb-0 fw-bold fs-5">Hamburguesa Clásica</p>
                                    <small class="text-light d-block mb-1" style="line-height:1.2;">Carne 200g, queso cheddar, lechuga, tomate y salsa especial.</small>
                                    <span class="text-light fw-bold">$7.500</span>
                                </div>
                            </div>
                            <button class="btn btn-outline-warning btn-agregar fw-bold" data-nombre="Hamburguesa Clásica" data-precio="7500">Agregar</button>
                        </div>

                        <div class="d-flex mb-3 align-items-center justify-content-between border-bottom border-dark pb-2 mt-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 rounded menu-img" style="background-image: url('hamburguesadoble.jpg'); width: 60px; height: 60px; background-size: cover; background-position: center;"></div>
                                <div>
                                    <p class="mb-0 fw-bold fs-5">Hamburguesa Doble Big</p>
                                    <small class="text-light d-block mb-1" style="line-height:1.2;">Doble carne, doble queso, tocino crujiente y cebolla caramelizada.</small>
                                    <span class="text-light fw-bold">$9.900</span>
                                </div>
                            </div>
                            <button class="btn btn-outline-warning btn-agregar fw-bold" data-nombre="Hamburguesa Doble Big" data-precio="9900">Agregar</button>
                        </div>
                    </div>
                    
                    <h5 class="text-light mb-3 border-bottom border-secondary pb-2 mt-4 text-uppercase fw-bold">🍟 Acompañamientos</h5>
                    <div class="d-flex mb-3 align-items-center justify-content-between border-bottom border-dark pb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3 rounded menu-img" style="background-image: url('papas_fritas.jpg');"></div>
                            <div><p class="mb-0 fw-bold fs-5">Porción de Papas</p><span class="text-light">$6.000</span></div>
                        </div>
                        <button class="btn btn-outline-warning btn-agregar fw-bold" data-nombre="Porción de Papas" data-precio="6000">+ Añadir</button>
                    </div>

                    <div class="text-center mt-4 pt-3">
                        <a href="productos.php" class="btn btn-warning btn-lg w-100 fw-bold text-dark text-uppercase shadow-sm">¡Ver más productos!</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
            <div class="section-box h-100 m-0 d-flex flex-column justify-content-center text-center">
                <h4 class="mb-3 text-warning fw-bold">RESERVA TU MESA</h4>
                <div class="w-100 mb-3 rounded" style="background-image: url('mesas.jpg'); height: 160px; background-size: cover; background-position: center;"></div>
                
                <p class="text-light mb-4 small">Quieres comer con nosotros de forma presencial? Asegura tu lugar en cualquiera de nuestras sucursales.</p>
                
                <a href="servicios.php" class="btn btn-outline-warning mt-auto mx-auto w-100 fw-bold">RESERVA YA!</a>
            </div>
        </div>
    </div>    
</div>

<?php include 'footer.php'; ?>
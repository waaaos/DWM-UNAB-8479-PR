<?php $titulo = "BIG BITE - Nuestros Productos"; include 'header.php'; ?>


<div class="container flex-grow-1 mt-4">
    <div class="row mt-2 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-8 mb-3">
                <div class="section-box h-100">
                    <h4 class="mb-4 text-warning fw-bold fs-3 text-center">NUESTRO MENÚ COMPLETO</h4>
                    
                    <!-- HAMBURGUESAS -->
                    <h5 class="text-light mb-3 border-bottom border-secondary pb-2 mt-5 text-uppercase fw-bold">Hamburguesas</h5>
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

                        <div class="d-flex mb-3 align-items-center justify-content-between border-bottom border-dark pb-2 mt-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3 rounded menu-img" style="background-image: url('vegana.jpg'); width: 60px; height: 60px; background-size: cover; background-position: center;"></div>
                                <div>
                                    <p class="mb-0 fw-bold fs-5">Hamburguesa Vegana</p>
                                    <small class="text-light d-block mb-1" style="line-height:1.2;">Hamburguesa de lentejas, queso vegano, lechuga, tomate y mayo not.</small>
                                    <span class="text-light fw-bold">$8.500</span>
                                </div>
                            </div>
                            <button class="btn btn-outline-warning btn-agregar fw-bold" data-nombre="Hamburguesa Vegana" data-precio="8500">Agregar</button>
                        </div>
                    </div>

                    <!-- ACOMPAÑAMIENTOS -->
                    <h5 class="text-light mb-3 border-bottom border-secondary pb-2 mt-5 text-uppercase fw-bold">Acompañamientos</h5>
                    <div class="d-flex mb-3 align-items-center justify-content-between border-bottom border-dark pb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3 rounded menu-img" style="background-image: url('papas_fritas.jpg');"></div>
                            <div><p class="mb-0 fw-bold fs-5">Porción de Papas</p><span class="text-light">$6.000</span></div>
                        </div>
                        <button class="btn btn-outline-warning btn-agregar fw-bold" data-nombre="Porción de Papas" data-precio="6000">+ Añadir</button>
                    </div>
                    
                    <div class="d-flex mb-3 align-items-center justify-content-between border-bottom border-dark pb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3 rounded menu-img" style="background-image: url('aros.jpg');"></div>
                            <div><p class="mb-0 fw-bold fs-5">Aros de Cebolla</p><span class="text-light">$5.500</span></div>
                        </div>
                        <button class="btn btn-outline-warning btn-agregar fw-bold" data-nombre="Aros de Cebolla" data-precio="5500">+ Añadir</button>
                    </div>

                    <!-- SALSAS -->
                    <h5 class="text-white fw-bold mb-3 mt-5">SALSAS EXTRAS</h5>
                    <hr class="border-secondary mb-4">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border border-secondary rounded p-2 d-flex align-items-center justify-content-between h-100">
                                <div class="d-flex align-items-center">
                                    <img src="queso cheddar.png" alt="Queso Cheddar" class="rounded me-3 object-fit-cover" style="width: 50px; height: 50px;">
                                    <div>
                                        <h6 class="text-white fw-bold mb-1 fs-6">Queso Cheddar</h6>
                                        <p class="text-warning mb-0 small">$1.500</p>
                                    </div>
                                </div>
                                <button class="btn btn-outline-warning btn-sm px-2 py-0 fs-5" onclick="cambiarCantidad('Queso Cheddar', 1, 1500)">+</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border border-secondary rounded p-2 d-flex align-items-center justify-content-between h-100">
                                <div class="d-flex align-items-center">
                                    <img src="salsa bbq.png" alt="Salsa BBQ" class="rounded me-3 object-fit-cover" style="width: 50px; height: 50px;">
                                    <div>
                                        <h6 class="text-white fw-bold mb-1 fs-6">Salsa BBQ</h6>
                                        <p class="text-warning mb-0 small">$1.000</p>
                                    </div>
                                </div>
                                <button class="btn btn-outline-warning btn-sm px-2 py-0 fs-5" onclick="cambiarCantidad('Salsa BBQ', 1, 1000)">+</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border border-secondary rounded p-2 d-flex align-items-center justify-content-between h-100">
                                <div class="d-flex align-items-center">
                                    <img src="mayo ajo.png" alt="Mayo Ajo Casera" class="rounded me-3 object-fit-cover" style="width: 50px; height: 50px;">
                                    <div>
                                        <h6 class="text-white fw-bold mb-1 fs-6">Mayo Ajo Casera</h6>
                                        <p class="text-warning mb-0 small">$1.000</p>
                                    </div>
                                </div>
                                <button class="btn btn-outline-warning btn-sm px-2 py-0 fs-5" onclick="cambiarCantidad('Mayo Ajo Casera', 1, 1000)">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- BEBIDAS -->
                    <h5 class="text-white fw-bold mb-3 mt-5">🥤 BEBIDAS</h5>
                    <hr class="border-secondary mb-4">

                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary">
                        <img src="lata coca cola.png" alt="Lata Coca-Cola 350cc" class="rounded me-3 object-fit-cover" style="width: 70px; height: 70px;">
                        <div class="flex-grow-1">
                            <h6 class="text-white fw-bold mb-1">Lata Coca-Cola 350cc</h6>
                            <p class="text-warning mb-0">$2.000</p>
                        </div>
                        <button class="btn btn-outline-warning btn-sm fw-bold px-3" onclick="cambiarCantidad('Lata Coca-Cola 350cc', 1, 2000)">+ Añadir</button>
                    </div>

                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary">
                        <img src="lata sprite.png" alt="Lata Sprite 350cc" class="rounded me-3 object-fit-cover" style="width: 70px; height: 70px;">
                        <div class="flex-grow-1">
                            <h6 class="text-white fw-bold mb-1">Lata Sprite 350cc</h6>
                            <p class="text-warning mb-0">$2.000</p>
                        </div>
                        <button class="btn btn-outline-warning btn-sm fw-bold px-3" onclick="cambiarCantidad('Lata Sprite 350cc', 1, 2000)">+ Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
// Modal Reserva
<div class="modal fade" id="modalReserva" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-warning fw-bold" id="reservaLabel">Reserva tu mesa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formReserva">
                    <input type="hidden" id="sucursalOculta" value="General">
                    <div class="mb-3"><label class="form-label">A nombre de:</label><input type="text" class="form-control bg-dark text-white border-secondary" id="reservaNombre" required></div>
                    <div class="row">
                        <div class="col-6 mb-3"><label class="form-label">Fecha:</label><input type="date" class="form-control bg-dark text-white border-secondary" id="reservaFecha" required></div>
                        <div class="col-6 mb-3"><label class="form-label">Hora:</label><input type="time" class="form-control bg-dark text-white border-secondary" id="reservaHora" required></div>
                    </div>
                    <div class="mb-4"><label class="form-label">Personas:</label><input type="number" class="form-control bg-dark text-white border-secondary" id="reservaPersonas" min="1" value="2" required></div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold">Confirmar Reserva</button>
                </form>
            </div>
        </div>
    </div>
</div>

// Modal Mis Reservas
<div class="modal fade" id="modalMisReservas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-bottom border-secondary"><h5 class="modal-title text-warning fw-bold">📅 Mis Reservas</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body text-center py-5" id="cuerpoMisReservas">
                <span class="fs-1 d-block mb-3 text-secondary">📅</span>
                <p class="text-muted fs-5 mb-0">Aún no tienes reservas activas...</p>
                <small class="text-secondary">Tus próximas visitas aparecerán aquí.</small>
            </div>
        </div>
    </div>
</div>

// Modal Login / Registro
<div class="modal fade" id="modalLogin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-bottom border-secondary"><h5 class="modal-title text-warning fw-bold">👤 Acceso y Registro</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-3 border-secondary">
                    <li class="nav-item"><a class="nav-link active text-warning bg-dark border-secondary" data-bs-toggle="tab" href="#tabLogin">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link text-light border-secondary" data-bs-toggle="tab" href="#tabRegistro">Nuevo Registro</a></li>
                </ul>
                <div class="tab-content">
                    <!-- Login -->
                    <div class="tab-pane fade show active" id="tabLogin">
                        <form id="formLogin">
                            <div class="mb-3"><label class="form-label">Correo Electrónico:</label><input type="email" id="logCorreo" class="form-control bg-dark text-white border-secondary" required></div>
                            <div class="mb-3"><label class="form-label">Contraseña:</label><input type="password" id="logPass" class="form-control bg-dark text-white border-secondary" required></div>
                            <button type="submit" class="btn btn-warning w-100 fw-bold">Ingresar</button>
                        </form>
                    </div>
                    <!-- Registro -->
                    <div class="tab-pane fade" id="tabRegistro">
                        <form id="formRegistro">
                            <div class="row">
                                <div class="col-md-12 mb-2"><label class="form-label small">Nombre Completo:</label><input type="text" id="regNombre" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-12 mb-2"><label class="form-label small">Dirección Exacta:</label><input type="text" id="regDireccion" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-4 mb-2"><label class="form-label small">Comuna:</label><input type="text" id="regComuna" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-4 mb-2"><label class="form-label small">Provincia:</label><input type="text" id="regProvincia" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-4 mb-2"><label class="form-label small">Región:</label><input type="text" id="regRegion" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-4 mb-2"><label class="form-label small">Fecha Nacimiento:</label><input type="date" id="regFechaNac" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-4 mb-2"><label class="form-label small">Sexo:</label><select id="regSexo" class="form-select form-select-sm bg-dark text-white border-secondary"><option>Masculino</option><option>Femenino</option><option>Otro</option></select></div>
                                <div class="col-md-4 mb-2"><label class="form-label small">Teléfono:</label><input type="tel" id="regTelefono" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label small text-warning">Correo:</label><input type="email" id="regCorreo" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label small text-warning">Contraseña:</label><input type="password" id="regPass" class="form-control form-control-sm bg-dark text-white border-secondary" required></div>
                            </div>
                            <button type="submit" class="btn btn-info w-100 fw-bold text-dark">Crear Cuenta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

// Modal Cerrar Sesión
<div class="modal fade" id="modalLogout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-warning fw-bold">Cerrar Sesión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="fs-5 mb-4">¿Estás seguro de que deseas cerrar sesion?</p>
                <button type="button" class="btn btn-outline-secondary px-4 me-2 fw-bold" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger px-4 fw-bold" onclick="cerrarSesion()">Sí, cerrar sesión</button>
            </div>
        </div>
    </div>
</div>

// Panel Carrito
<div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="carritoPanel" style="width: 400px;">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title fw-bold">🛒 Tu Pedido</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <ul id="lista-carrito" class="list-group list-group-flush mb-auto">
            <li class="list-group-item bg-dark text-muted text-center border-0 mt-5 pt-5">
                <img src="tu_imagen.png" alt="Carrito vacío" style="max-width: 150px; margin-bottom: 15px;">
                <p class="fs-5 mb-1 fw-bold text-white">Aún no has pedido nada...</p>
                <small class="text-light">¡Anímate a probar nuestras monstruosas hamburguesas!</small>
            </li>
        </ul>
        <div class="mt-4 border-top border-secondary pt-3">
            <h4 class="d-flex justify-content-between"><span>Total:</span><span class="text-warning">$<span id="total-carrito">0</span></span></h4>
            <div class="d-flex flex-column gap-2 mt-3">
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-danger w-50 fw-bold py-2" onclick="vaciarCarrito()">Vaciar Todo</button>
                    <button class="btn btn-success w-50 fw-bold py-2" onclick="confirmarCompra()">Pagar Pedido</button>
                </div>
                <button class="btn btn-outline-secondary w-100 fw-bold py-2" onclick="anularCompra()">Anular Compra 🚫</button>
            </div>
        </div>
    </div>
</div>

// Modal Sucursales
<div class="modal fade" id="modalSucursales" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-warning fw-bold">Nuestras Sucursales</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-3">
                    <button class="btn btn-outline-warning text-start fs-5" onclick="abrirReservaDesdeSucursal('Providencia', 'disponible')">📍 Big Bite - Providencia <span class="badge bg-success float-end mt-1">Disponible</span></button>
                    <button class="btn btn-outline-danger text-start fs-5" onclick="abrirReservaDesdeSucursal('Ñuñoa', 'lleno')">📍 Big Bite - Ñuñoa <span class="badge bg-danger float-end mt-1">Lleno</span></button>
                    <button class="btn btn-outline-warning text-start fs-5" onclick="abrirReservaDesdeSucursal('Santiago Centro', 'disponible')">📍 Big Bite - Santiago Centro <span class="badge bg-success float-end mt-1">Disponible</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

// Modal de Alerta Personalizado
<div class="modal fade" id="modalAlerta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary shadow-lg">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title text-warning fw-bold">Big Bite - Aviso</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p id="textoAlerta" class="fs-5 mb-0 text-light"></p>
            </div>
            <div class="modal-footer border-top border-secondary justify-content-center">
                <button type="button" class="btn btn-warning px-4 fw-bold text-dark" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER GLOBALES -->
<footer class="bg-brown text-white py-4 mt-auto">
    <div class="container text-center text-md-start">
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <span class="d-block mb-2 small text-uppercase fw-bold text-warning">Síguenos en</span>
                <a href="https://www.instagram.com/" target="_blank" class="text-white mx-2 fs-4 redes-link"><i class="bi bi-instagram"></i></a>
                <a href="https://www.facebook.com/" target="_blank" class="text-white mx-2 fs-4 redes-link"><i class="bi bi-facebook"></i></a>
                <a href="https://x.com/" target="_blank" class="text-white mx-2 fs-4 redes-link"><i class="bi bi-twitter-x"></i></a>
                <a href="https://tiktok.com/" target="_blank" class="text-white mx-2 fs-4 redes-link"><i class="bi bi-tiktok"></i></a>
            </div>
            <div class="col-md-4 text-center small mb-3 mb-md-0"><p class="mb-0">Términos y Condiciones<br>Benjamin Briones & Pablo Contreras<br></p></div>
            <div class="col-md-4 text-center small mb-3 mb-md-0"><p class="mb-0">Big Bite © 2026</p></div>
            <div class="col-md-4 text-center"><a href="contacto.php" class="text-white fw-bold">CONTACTO</a></div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
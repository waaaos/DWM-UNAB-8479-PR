let usuarioLogueado = localStorage.getItem('bb_usuario') === 'true';
let carrito = JSON.parse(localStorage.getItem('bb_carrito')) || [];
let misReservas = JSON.parse(localStorage.getItem('bb_reservas')) || [];

document.addEventListener('DOMContentLoaded', () => {

    // Renderizar datos guardados previamente
    if (usuarioLogueado) actualizarUIUsuario();
    actualizarCarritoUI();
    actualizarMisReservasUI();

    // Resaltar página actual
    const enlaces = document.querySelectorAll('.nav-link');
    const urlActual = window.location.pathname.split('/').pop() || 'index.php';
    enlaces.forEach(enlace => {
        if (enlace.getAttribute('href') === urlActual) {
            enlace.classList.add('text-info');
            enlace.style.fontWeight = 'bold';
        }
    });

    // Formulario de Contacto
    const btnEnviar = document.getElementById('btnEnviar');
    if (btnEnviar) {
        btnEnviar.addEventListener('click', () => {
            const email = document.getElementById('email').value.trim();
            const comentario = document.getElementById('comment').value.trim();
            if (email === '' || comentario === '') {
                mostrarAlerta('Por favor, rellena todos los campos para continuar.');
            } else {
                mostrarAlerta('Mensaje enviado exitosamente!');
                document.getElementById('contactForm').reset();
            }
        });
    }

    // Formulario de Inicio de Sesión
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', e => {
            e.preventDefault();
            const correo = document.getElementById('logCorreo').value;
            const nombreL = correo.split('@')[0]; 
            
            localStorage.setItem('bb_nombre_usuario', nombreL);
            ejecutarLogin();
        });
    }

    // Formulario de Registro
    const formRegistro = document.getElementById('formRegistro');
    if (formRegistro) {
        formRegistro.addEventListener('submit', e => {
            e.preventDefault();
            mostrarAlerta("¡Registro exitoso! Ahora puedes iniciar sesión.");
            document.querySelector('[href="#tabLogin"]').click();
            formRegistro.reset();
        });
    }

    // Formulario de Reserva de Mesa
    const formReserva = document.getElementById('formReserva');
    if (formReserva) {
        formReserva.addEventListener('submit', e => {
            e.preventDefault();
            const sucursalInput = document.getElementById('sucursalOculta');
            const sucursal = sucursalInput ? sucursalInput.value : 'General';
            const nombre = document.getElementById('reservaNombre').value;
            const fecha = document.getElementById('reservaFecha').value;
            const hora = document.getElementById('reservaHora').value;
            const personas = document.getElementById('reservaPersonas').value;

            const localStr = sucursal !== 'General' ? `Big Bite - ${sucursal}` : 'Big Bite';
            mostrarAlerta(`¡Reserva confirmada exitosamente en ${localStr}! Te esperamos.`);

            misReservas.push({ localStr, nombre, fecha, hora, personas });
            localStorage.setItem('bb_reservas', JSON.stringify(misReservas));
            actualizarMisReservasUI();

            const modalEl = document.getElementById('modalReserva');
            if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
            formReserva.reset();
        });
    }

    document.querySelectorAll('.btn-agregar').forEach(boton => {
        boton.addEventListener('click', () => {
            cambiarCantidad(boton.dataset.nombre, 1, parseInt(boton.dataset.precio));
        });
    });
});



function ejecutarLogin() {
    usuarioLogueado = true;
    localStorage.setItem('bb_usuario', 'true');
    
    const modalLoginEl = document.getElementById('modalLogin');
    if (modalLoginEl) bootstrap.Modal.getOrCreateInstance(modalLoginEl).hide();
    
    actualizarUIUsuario();
    mostrarAlerta("Sesión iniciada correctamente. Ya puedes realizar pedidos web.");
}

function actualizarUIUsuario() {
    const nombreCompleto = localStorage.getItem('bb_nombre_usuario') || 'Cliente';
    const primerNombre = nombreCompleto.split(' ')[0];

    document.querySelectorAll('.btn-login-nav').forEach(btn => {
        btn.innerText = `Hola, ${primerNombre}`;
        btn.setAttribute('data-bs-target', '#modalLogout');
    });
}

function cerrarSesion() {
    localStorage.removeItem('bb_usuario');
    localStorage.removeItem('bb_nombre_usuario');
    usuarioLogueado = false;

    const modalLogoutEl = document.getElementById('modalLogout');
    if (modalLogoutEl) bootstrap.Modal.getInstance(modalLogoutEl).hide();

    document.querySelectorAll('.btn-login-nav').forEach(btn => {
        btn.innerText = "Ingresar";
        btn.setAttribute('data-bs-target', '#modalLogin');
    });

    mostrarAlerta("Has cerrado sesión exitosamente.");
}

function cambiarCantidad(nombre, cambio, precioBase = 0) {
    const prod = carrito.find(i => i.nombre === nombre);
    if (prod) {
        prod.cantidad += cambio;
        if (prod.cantidad <= 0) {
            carrito = carrito.filter(i => i.nombre !== nombre);
        }
    } else if (cambio > 0) {
        carrito.push({ nombre, precio: precioBase, cantidad: 1 });
    }
    actualizarCarritoUI();
}

function borrarDelCarrito(nombre) {
    carrito = carrito.filter(i => i.nombre !== nombre);
    actualizarCarritoUI();
}

function vaciarCarrito() {
    carrito = [];
    actualizarCarritoUI();
}

function actualizarCarritoUI() {
    localStorage.setItem('bb_carrito', JSON.stringify(carrito));

    const listaCarrito = document.getElementById('lista-carrito');
    if (!listaCarrito) return;

    listaCarrito.innerHTML = '';
    let total = 0, c = 0;

    if (carrito.length === 0) {
        listaCarrito.innerHTML = `
            <li class="list-group-item bg-dark text-light text-center border-0 mt-5 pt-5">
                <img src="pedidovacio.png" alt="Carrito vacío" style="max-width: 150px; margin-bottom: 15px;">
                <p class="fs-5 mb-1 fw-bold text-white">Aún no has pedido nada...</p>
            </li>`;
    } else {
        carrito.forEach(p => {
            const sub = p.precio * p.cantidad; total += sub; c += p.cantidad;
            listaCarrito.innerHTML += `
                <li class="list-group-item bg-dark text-white d-flex flex-column justify-content-center border-secondary px-0 py-3">
                    <div class="d-flex justify-content-between w-100 mb-2">
                        <span class="fw-bold">${p.nombre}</span>
                        <button class="btn btn-sm btn-danger px-2 py-0 fw-bold" onclick="borrarDelCarrito('${p.nombre}')">X</button>
                    </div>
                    <div class="d-flex justify-content-between w-100">
                        <div class="d-flex align-items-center gap-2 bg-secondary rounded p-1">
                            <button class="btn-contador fw-bold" onclick="cambiarCantidad('${p.nombre}', -1)">-</button>
                            <span class="mx-2 fw-bold">${p.cantidad}</span>
                            <button class="btn-contador fw-bold" onclick="cambiarCantidad('${p.nombre}', 1)">+</button>
                        </div>
                        <span class="text-warning fw-bold">$${sub.toLocaleString('es-CL')}</span>
                    </div>
                </li>`;
        });
    }
    document.getElementById('total-carrito').innerText = total.toLocaleString('es-CL');
    document.getElementById('contador-carrito').innerText = c;
}

function confirmarCompra() {
    if (carrito.length === 0) return mostrarAlerta("Tu carrito está vacío. ¡Agrega hamburguesas primero!");
    if (!usuarioLogueado) {
        mostrarAlerta("Atención: Debes iniciar sesión para armar un pedido web.");
        const modalLoginEl = document.getElementById('modalLogin');
        if (modalLoginEl) new bootstrap.Modal(modalLoginEl).show();
        return;
    }
    const fakeId = Math.floor(Math.random() * 100000);
    localStorage.setItem('bb_ultima_venta_id', fakeId);
    
    mostrarAlerta("¡Pago confirmado! La orden ha sido procesada exitosamente.");
    vaciarCarrito();
}

function anularCompra() {
    const ultimaVentaId = localStorage.getItem('bb_ultima_venta_id');
    
    if (!ultimaVentaId) {
        return mostrarAlerta("No tienes un pedido reciente registrado para anular.");
    }

    const motivo = prompt("Anulación de pedido. Indique el motivo:");
    
    if (motivo && motivo.trim() !== "") {
        mostrarAlerta("Compra anulada exitosamente.\nMotivo registrado: " + motivo);
        localStorage.removeItem('bb_ultima_venta_id'); 
    } else {
        mostrarAlerta("Operación cancelada. Es obligatorio indicar un motivo.");
    }
}

function actualizarMisReservasUI() {
    const cuerpoMisReservas = document.getElementById('cuerpoMisReservas');
    if (!cuerpoMisReservas) return;

    if (misReservas.length === 0) {
        cuerpoMisReservas.innerHTML = `
            <span class="fs-1 d-block mb-3">📅</span>
            <p class="text-white fs-5 mb-0 fw-bold">Aún no tienes reservas activas...</p>
            <small class="text-light">Tus próximas visitas aparecerán aquí.</small>`;
        cuerpoMisReservas.classList.add('py-5', 'text-center');
        cuerpoMisReservas.classList.remove('text-start');
    } else {
        cuerpoMisReservas.innerHTML = '';
        cuerpoMisReservas.classList.remove('py-5', 'text-center');
        cuerpoMisReservas.classList.add('text-start');
        
        misReservas.forEach((r, index) => {
            cuerpoMisReservas.innerHTML += `
                <div class="card bg-secondary text-white mb-2 border-0">
                    <div class="card-body py-2 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-warning mb-1">${r.localStr}</h6>
                            <p class="card-text small mb-0"><strong>A nombre de:</strong> ${r.nombre}</p>
                            <p class="card-text small mb-0"><strong>Fecha:</strong> ${r.fecha} a las ${r.hora}</p>
                            <p class="card-text small mb-0"><strong>Personas:</strong> ${r.personas}</p>
                        </div>
                        <button class="btn btn-outline-danger btn-sm fw-bold px-3 py-2 ms-2" onclick="eliminarReserva(${index})">Eliminar</button>
                    </div>
                </div>`;
        });
    }
}

function eliminarReserva(index) {
    misReservas.splice(index, 1);
    localStorage.setItem('bb_reservas', JSON.stringify(misReservas));
    actualizarMisReservasUI();
}

function abrirReservaDesdeSucursal(nombreSucursal, estado) {
    if (estado === 'lleno') {
        mostrarAlerta("Lo sentimos, no hay mesas disponibles.");
        return;
    }
    const modalSucursalesEl = document.getElementById('modalSucursales');
    if (modalSucursalesEl) bootstrap.Modal.getInstance(modalSucursalesEl).hide();
    document.getElementById('reservaLabel').innerText = `Reserva en Big Bite - ${nombreSucursal}`;
    document.getElementById('sucursalOculta').value = nombreSucursal;
    new bootstrap.Modal(document.getElementById('modalReserva')).show();
}

function mostrarAlerta(mensaje) {
    const textoElemento = document.getElementById('textoAlerta');
    if (textoElemento) {
        textoElemento.innerText = mensaje;
        const modalEl = document.getElementById('modalAlerta');
        if (modalEl) {
            new bootstrap.Modal(modalEl).show();
            return;
        }
    }
    mostrarAlerta(mensaje); 
}


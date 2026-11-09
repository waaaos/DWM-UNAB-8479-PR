<?php $titulo = "BIG BITE - Contacto"; include 'header.php'; ?>

<div class="container flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="section-box text-center mt-5">
                <h2 class="mb-2 text-warning fw-bold">¡Hablemos!</h2>
                <p class="text-light mb-4">¿Tienes dudas o sugerencias? Déjanos tu mensaje.</p>
                <form id="contactForm" class="text-start">
                    <div class="mb-3">
                        <label for="email" class="form-label text-warning fw-bold">Correo Electrónico:</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" id="email">
                    </div>                
                    <div class="mb-4">
                        <label for="comment" class="form-label text-warning fw-bold">Comentarios:</label>
                        <textarea class="form-control bg-dark text-white border-secondary" rows="5" id="comment"></textarea>
                    </div>
                    <button type="button" id="btnEnviar" class="btn btn-warning w-100 fw-bold">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
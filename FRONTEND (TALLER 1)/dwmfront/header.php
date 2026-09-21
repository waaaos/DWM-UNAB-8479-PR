<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($titulo) ? $titulo : 'BIG BITE'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-image: url('fondo.jpg'); background-color: #fcfcfc; background-size: cover; background-attachment: fixed; color: #ffffff; }
        .bg-brown { background-color: #583924 !important; border-bottom: 1px solid #555; }
        .section-box { background-color: rgba(0, 0, 0, 0.85); border: 1px solid #555; padding: 20px; margin-bottom: 30px; border-radius: 8px; }
        .menu-img { width: 70px; height: 70px; background-size: cover; background-position: center; flex-shrink: 0; }
        .img-promo { max-height: 220px; object-fit: cover; width: 100%; }
        .reserva-img { height: 150px; background-size: cover; background-position: center; border: 1px solid #555; }
        a { text-decoration: none; }
        .btn-contador { background-color: #333; color: white; border: none; padding: 0 8px; border-radius: 4px; }
        .btn-contador:hover { background-color: #555; }
        .btn-nav-custom { background-color: transparent; border: none; color: #ffffff !important; transition: background-color 0.3s ease; }
        .btn-nav-custom:hover { background-color: #d8bf73; color: #ffffff !important; }
        .btn-carrito-custom { background-color: #d8bf73 !important; border: none; color: #ffffff !important; transition: opacity 0.3s ease; }
        .nav-link-hover { background-color: transparent !important; font-weight: bold; font-size: 17px; color: #ffffff !important; transition: font-size 0.1s ease, color 0.1s ease; }
        .nav-link-hover:hover { color: #d8bf73 !important; font-size: 18px !important; }
        .btn-carrito-custom:hover { opacity: 0.85; color: #ffffff !important;}
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-brown py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="logo_nuevo.png" alt="Logo Big Bite" width="70" height="70" class="me-3 rounded">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item"><a class="nav-link nav-link-hover mx-2" href="servicios.php">Reserva tu mesa</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-hover mx-2" href="productos.php">Nuestro menú</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-hover mx-2" href="contacto.php">Contacto</a></li>
                </ul>
                <div class="d-flex flex-column flex-lg-row gap-3 mt-3 mt-lg-0 align-items-lg-center">
                    <button class="btn btn-nav-custom fw-bold btn-login-nav" type="button" data-bs-toggle="modal" data-bs-target="#modalLogin">Ingresar</button>
                    <button class="btn btn-nav-custom fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#modalMisReservas">Mis reservas</button>
                    <button class="btn btn-carrito-custom fw-bold position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#carritoPanel">
                        Tu carrito <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white" id="contador-carrito">0</span>
                    </button>
                </div>
            </div>                               
        </div>
    </nav>
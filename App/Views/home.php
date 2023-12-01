<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- cdn de bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <!-- api para utilizar ajax y cargar ciertos elementos mediante jquery 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     llamar al nav-bar y footer mediante el id 
    <script src="MVC/Views/js/componentes.js"></script> Esto ya no es necesario porque lo realiza php-->
    <!-- en vista de que el router ha causado problemas para cargar el css externo mediante utilizando import o
    link hemos decidido cargarlo con php (en el turtorial que segui no ocurrio ese error, es raro la verdad)
    <link rel="stylesheet" href="Public/static/css/style.css">-->
    <style> <?php include_once 'Public/static/css/style.css'; include_once 'Public/static/css/carrusel.css'; ?> </style>
</head>

<body>
    <?php require_once('App/Views/componentes/header.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto my-5 ml-1 mr-1">

                <!--Bienvenida-->
                <div style="text-align: center;" class="p-3">
                    <h1>¡Bienvenido!</h1>
                    <p>Descubre una experiencia culinaria única en tus restaurantes favoritos. Explora menús deliciosos, reserva mesas con facilidad y disfruta de sabores inolvidables. ¡Tu mesa te espera!"</p>
                </div>

                <div class="d-inline-flex ms-1 ms-lg-0  card-navigation">
                  <a href="<?php echo LOCAL_HOST; ?>/restaurant/search" class="ms-4">
                    <img src="<?php echo $restaurante ?>" alt="Restaurantes" class="i-opciones">
                  </a>
 
                  <a href="<?php echo LOCAL_HOST; ?>/preorder/search">
                    <img src="<?php echo $reservas ?>"" alt="Mis Reservas" class="i-opciones">
                  </a>
                </div>

                <!--Carrusel-->
                <!--Barras Inferiores para pasar el carrusel-->
                <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="true">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <!--Los 3 elementos del carrusel con sus leyendas-->
                    <div class="carousel-inner">
                      <div class="carousel-item active d-item">
                        <img class="d-block w-100 d-img" src="<?php echo $restaurante_cafe ?>" alt="Restaturantes de Café">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="mt-2 fs-3 fw-bolder text-uppercase">2x1 en café</p>
                            <h1 class="display-4">Aplican todos los restaurantes</h1>
                        </div>
                      </div>
                      
                      <div class="carousel-item d-item">
                        <img class="d-block w-100 d-img" src="<?php echo $helado ?>" alt="Promo de Helados">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="mt-2 fs-3 fw-bolder text-uppercase">2x1 en helados</p>
                            <h1 class="display-4">Aplican todos los restaurantes</h1>
                        </div>
                      </div>

                      <div class="carousel-item d-item">
                        <img class="d-block w-100 d-img" src="<?php echo $navidad ?>" alt="Galletas de navidad">
                        <div class="carousel-caption top-0 mt-4">
                            <p class="mt-2 fs-3 fw-bolder text-uppercase">Galletas de Navidad</p>
                            <h1 class="display-4">Disponibles en Pastelería del Cielo</h1>
                        </div>
                      </div>
                    </div>

                    <!--Flechas para pasar el carrusel-->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" role="button" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>
    </div>   
    
    <?php require_once('App/Views/componentes/footer.php'); ?>
</body>
<script><?php require_once('Public/static/js/recargar_home.js'); ?> <!-- script que maneja la cookie de inicio de sesion --></script>
</html>
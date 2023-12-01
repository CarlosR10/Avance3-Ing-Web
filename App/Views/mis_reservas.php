<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurantes </title>

        <!-- cdn de bootstrap 5-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <!-- api para utilizar ajax y cargar ciertos elementos mediante jquery 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        llamar al nav-bar y footer mediante el id 
        <script src="MVC/Views/js/componentes.js"></script> Esto ya no es necesario porque lo realiza php-->
        <!-- en vista de que el router ha causado problemas para cargar el css externo mediante utilizando import o
        link hemos decidido cargarlo con php (en el turtorial que segui no ocurrio ese error, es raro la verdad)
        <link rel="stylesheet" href="Public/static/css/style.css">
        <script src="js/componentes.js"></script>-->

        <style> <?php include_once 'Public/static/css/style.css'; ?> </style>
    </head>
<body>

    <?php require_once('App/Views/componentes/header.php'); ?>

    <div id="info" class="alert alert-danger" role="alert" style="display: none;"></div>

    <div class="mt-0 d-inline-block">
        <button onclick="goHome();" class="nav-link">
            <i class="bi bi-arrow-left-short backicon d-flex ms-0 ms-sm-auto "></i>
        </button>
    </div>

    <!-- Barra de busqueda -->
    <section id="searchbar">
            <div class="card mx-auto bsearch">
                <div class="card-body ">
                    <h2 class="card-title text-center mb-4">Mis Reservas</h2>

                    <form id="busquedaForm" action="#" method="post">
                        <div class="input-group">
                            <input id="busqueda" type="text" class="form-control" placeholder="Buscar una reserva..." required>
                            <div class="input-group-append">
                                <button class="btn btn-primary " type="submit">Buscar <i class="bi bi-search"></i></button>
                                <a id="filtro" href="<?php echo LOCAL_HOST; ?>/preorder/search" class="btn btn-secondary"><i class="bi bi-list-ol"></i> Todo</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
    </section>

    <!-- Scroll de restaurantes -->
    <section id="scrollpane">
        <div id="preorder-list" class="vertical-menu card-columns mt-3 ms-4 me-5 ms-md-5 ps-md-3 rounded-1">
              
        </div>
    </section>

    <div class="container d-flex justify-content-center" >
        <button class="btn btn-dark mx-auto mt-3" style="height: fit-content" data-bs-toggle="modal" data-bs-target="#FilterModal"><i class="bi bi-filter"></i> Filtrar</button>
    </div>

    <div class="container d-flex justify-content-center" >
        <a href="<?php echo LOCAL_HOST; ?>/preorder/new" class="btn btn-primary mx-auto mt-3" style="height: fit-content">Nueva Reserva</a>
    </div>
    
    <!-- Pop Up de filtro de búsquedas -->
    <section id="modal">
        <div class="modal fade" id="FilterModal" data-bs-backdrop="false" >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <section id="filtros2">
                        <div class="card">
                            <div class="card-body">
                                <form id="filterForm" action="#" method="post">
                                    <div class="card-columns">
                                        <div class="card">
                                            <div class="card-body">
                    
                                                <h3>Tipo de comida:</h3>
                    
                                                <div class="input-group">
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="comida" value="Francesa" aria-label="Radio button for following text input" required>
                                                            <p class="mt-2 ms-2">Francesa</p>
                                                        </div>
                                                    </div>    
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="comida" value="Latina" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Latina</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="comida" value="Mexicana" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Mexicana</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="comida" value="A la parrilla" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">A la parrilla</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="comida" value="Pasta" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Pasta</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="comida" value="Sushi" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Sushi</p>
                                                        </div>
                                                    </div>
                    
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                    
                                                <h3>Tipo de restaurante:</h3>
                    
                                                <div class="input-group">
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" value="Italiano" aria-label="Radio button for following text input" name="tiporest" required>
                                                            <p class="mt-2 ms-2">Italiano</p>
                                                        </div>
                                                    </div>    
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" value="Sushi" aria-label="Radio button for following text input" name="tiporest">
                                                            <p class="mt-2 ms-2">Sushi</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" value="Parrilla" aria-label="Radio button for following text input" name="tiporest">
                                                            <p class="mt-2 ms-2">Parrilla</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" value="Francés" aria-label="Radio button for following text input" name="tiporest">
                                                            <p class="mt-2 ms-2">Francés</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" value="Mexicano" aria-label="Radio button for following text input" name="tiporest">
                                                            <p class="mt-2 ms-2">Mexicano</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" value="Latino" aria-label="Radio button for following text input" name="tiporest">
                                                            <p class="mt-2 ms-2">Latino</p>
                                                        </div>
                                                    </div>
                    
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                    
                                                <h3>Precio:</h3>
                    
                                                <div class="input-group">
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="precio" value="5.00 - 10.00" aria-label="Radio button for following text input" required>
                                                            <p class="mt-2 ms-2">5.00 - 10.00</p>
                                                        </div>
                                                    </div>    
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="precio" value="10.01 - 15.00" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">10.01 - 15.00</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="precio" value="15.01 - 20.00" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">15.01 - 20.00</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="precio" value="20.01 o más" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">20.01 o más</p>
                                                        </div>
                                                    </div>
                    
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                    
                                                <h3>Provincia:</h3>
                    
                                                <div class="input-group">
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="provincia" value="Cordoba" aria-label="Radio button for following text input" required>
                                                            <p class="mt-2 ms-2">Cordoba</p>
                                                        </div>
                                                    </div>    
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="provincia" value="Buenos Aires" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Buenos Aires</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="provincia" value="Mendoza" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Mendoza</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="provincia" value="Santa Fe" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Santa Fe</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="provincia" value="Tucumán<" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Tucumán</p>
                                                        </div>
                                                    </div>
                    
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                    
                                                <h3>Facilidades:</h3>
                    
                                                <div class="input-group">
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="facilidad" value="Wi-Fi" aria-label="Radio button for following text input" required>
                                                            <p class="mt-2 ms-2">Wi-Fi</p>
                                                        </div>
                                                    </div>    
                    
                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="facilidad" value="Parking" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Parking</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="facilidad" value="Terraza" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Terraza</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="facilidad" value="Música en vivo" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Música en vivo</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="facilidad" value="Comida vegana" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Comida vegana</p>
                                                        </div>
                                                    </div>

                                                    <div class="container d-flex justify-content-start mx-auto input-group-prepend">
                                                        <div class="input-group-text d-flex justify-content-center my-1" style="height: 40px;">
                                                            <input type="radio" name="facilidad" value="Acceso para silla de ruedas" aria-label="Radio button for following text input">
                                                            <p class="mt-2 ms-2">Acceso para silla de ruedas</p>
                                                        </div>
                                                    </div>
                    
                                                    <div class="container d-flex justify-content-end">
                                                        <button id="closeBtn" type="button" data-bs-dismiss="modal" class="d-flex justify-content-center align-items-center mx-md-3 mx-2  btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px">Salir</button>
                                                        <button type="submit" class="d-flex justify-content-center align-items-center btn btn-lg btn-outline-dark rounded-3 mt-3" style="width: fit-content; height: 40px">Ver Resultados</button>
                                                    </div>
                    
                                                </div>
                    
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('App/Views/componentes/footer.php'); ?>

</body>
<script> <?php require_once("Public/static/js/reservas.js"); ?> <!-- script que lee las reservas del usuario  </script>
<script> <?php require_once("Public/static/js/filtrar_reserva.js"); ?> <!-- script que realiza la busqueda por filtros -->  </script>
<script> <?php require_once("Public/static/js/buscar_reserva.js"); ?> <!-- script que lee los datos del formulario y redirecciona  </script>
</html>
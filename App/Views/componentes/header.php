<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <!-- jquery que se utiliza para enviar la respuesta del navegador al servidor php para detectar si sl usuario cerro la sesion -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <?php require_once("Render/image_render.php"); ?> <!-- funcion de renderizado de imagenes -->
</head>

<body class="bg-white">
    <!-- ///// -->
    <header class="container-fluid px-2 py-2" style="background-color: var(--dark-green)">

        <nav class="navbar navbar-expand-md d-flex justify-content-between align-items-center">
            <div class="d-flex mt-2 rounded-circle d-flex align-items-center px-3" id="profile">
                <img class="rounded-circle" src="<?php echo $perfil ?>" alt="Imagen de perfil" width="50">
                <!-- Aumenta el tamaño de la imagen -->
                <span class="ms-5 text-white d-md-inline d-none" style="font-size: 1.2em;"><?php echo $parameters['TRUE'] ? $parameters['user'] : "Nombre de usuario" ?></span>
                <!-- Cambia el tamaño del texto -->
            </div>
            <a class="navbar-brand text-white">
                <img src="<?php echo $logo ?>" alt="Logo de la página" width="200">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-controls="navbarNav" aria-label="toggle navigation">
                <i class="bi bi-list navicon" style="outline: none;"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapse" style="flex-grow: initial !important;">
                <ul class="navbar-nav d-flex align-items-center ms-auto">
                    <li class="nav-item mx-2"><a href="https://www.instagram.com/" class="nav-link"><i class="bi bi-instagram navicon"></i></a></li>
                    <li class="nav-item mx-2"><a href="https://www.facebook.com/" class="nav-link"><i class="bi bi-facebook navicon"></i></a></li>
                    <li class="nav-item mx-2"><a href="https://www.twitter.com/" class="nav-link"><i class="bi bi-twitter navicon"></i></a></li>
                    <li class="nav-item mx-2"><a href="https://www.youtube.com/" class="nav-link"><i class="bi bi-youtube navicon"></i></a></li>
                    <li class="nav-item mx-5">
                        <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-toggle="tooltip" data-placement="bottom" 
                        title="Cerrar Sesión">
                            <i class="bi bi-door-open-fill navicon" style="font-size: 1.7em"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cerrar Sesión</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres cerrar sesión?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, regresar</button>
                        <button id="logout-btn"type="button" class="btn btn-secondary" onclick="logout()">Sí, cerrar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
                    
        </nav>
    </header>

    <!-- ///// -->
</body>
<script> <?php require_once("Public/static/js/componentes.js"); ?> <!-- script con mensajes de confirmacion o errores --> </script>
</html>
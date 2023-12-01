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
    <style> <?php include_once 'Public/static/css/style.css'; ?> </style>
</head>
<body>
    <?php require_once('App/Views/componentes/header.php'); ?>

    <!-- mensaje de error si la cuenta no existe -->
    <div id="info" class="alert alert-danger" role="alert" style="display: none;"></div>
    <div id="good_bye" class="alert alert-danger" role="alert" style="display: none;"></div>

    <section class="get_in_touch">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 mx-auto my-5 ml-1 mr-1">
                    <h1 class="text-center">Iniciar sesión</h1>
                    <form class="row g-3" id="sesionForm" method="post">
                        <div class="col-md-12">
                            <label for="personas" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" oninput="changeClass()" required>
                            <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                        </div>
                        <div class="col-md-12">
                            <label for="hora" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña0" placeholder="Ingrese la contraseña" pattern=".{8,}" title="Debe tener al menos 8 caracteres" oninput="changeClass()" required>
                            <div class="invalid-feedback">La entrada debe contener al menos 8 letras o símbolos.</div>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <p>¿No tienes una cuenta? <a class="registro" href="<?php echo LOCAL_HOST; ?>/user/sign_up">Regístrate</a></p>
                        </div>
                        
                        <div class="col-5"></div>
                        <div class="col-2 ms-2 ms-sm-auto"><button class="btn btn-primary btn-con-padding" id="submitForm" type="submit">Iniciar Sesión</button></div>
                        <div class="col-5"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-2 container-fluid px-5 py-2" style="background-color: var(--dark-green); color: white;">
        <div class="container-fluid p-3">
            <p style="text-align: justify;">
                © 2023. Todos los derechos reservados. El contenido y los materiales de este sitio web están protegidos por las leyes de 
                derechos de autor y otras leyes de propiedad intelectual.
            </p>
            <p style="text-align: justify;">
                Queda prohibida la reproducción, distribución, modificación o 
                divulgación de cualquier parte de este sitio web, ya sea en forma impresa, electrónica u otro medio, sin el consentimiento 
                previo por escrito.
            </p>
        </div>
    </footer>
</body>
<script><?php require_once('Public/static/js/recargar_home.js'); ?> <!-- script que maneja la cookie de inicio de sesion --></script>
<script> <?php require_once("Public/static/js/iniciar_sesion.js"); ?> <!-- script que lee los datos del formulario y redirecciona  </script>
</html>
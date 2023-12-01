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

    <!-- mensaje de error si el correo ya existe -->
    <div id="info" class="alert alert-danger" role="alert" style="display: none;"></div>

    <section class="get_in_touch">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 mx-auto my-5 ml-1 mr-1">
                    <h1 class="text-center">Regístrate</h1>
                    <form id="registroForm" action="#" class="row g-3" method="post">
                        <div class="col-md-12">
                            <label for="nombre0" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre0" placeholder="Ingrese su nombre" pattern="^[a-zA-Z]+$" oninput="changeClass()" required>
                            <div class="invalid-feedback">Este campo no puede contener números.</div>
                        </div>
                        <div class="col-md-12">
                            <label for="apellido0" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido0" placeholder="Ingrese su apellido" pattern="^[a-zA-Z]+$" oninput="changeClass()" required>
                            <div class="invalid-feedback">Este campo no puede contener números.</div>
                        </div>
                        <div class="col-md-12">
                            <label for="telefono0" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono0" placeholder="Ingrese su teléfono (ejemplos: 478-2323 o 6789-0987)" pattern="^(?:\d{4}-\d{4}|\d{3}-\d{4}|)$" oninput="changeClass()">
                            <div class="invalid-feedback">Por favor, ingrese un número de teléfono válido (ejemplos: 578-2323 o 6789-0987).</div>
                            <small class="form-text text-muted">Opcional</small>
                        </div>
                        <div class="col-md-12">
                            <label for="direccion0" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion0" placeholder="Ingrese su direccion" required>
                        </div>
                        <div class="col-md-12">
                            <label for="correo0" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo0" placeholder="Ingrese su correo electrónico" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" oninput="changeClass()" required>
                            <div class="invalid-feedback">Ingrese un correo electrónico válido (ejemplo: algo@example.com).</div>
                        </div>
                        <div class="col-md-12">
                            <label for="hora" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña0" placeholder="Ingrese la contraseña" pattern=".{8,}" title="Debe tener al menos 8 caracteres" oninput="changeClass()" required>
                            <div class="invalid-feedback">La entrada debe contener al menos 8 letras o símbolos.</div>
                        </div>
                        <div class="col-md-12">
                            <p>Al registrarse acepta nuestras Condiciones de uso y Políticas de privacidad. <a class="registro" href="https://drive.google.com/file/d/15CGIa7BsFB5Hv7aDNKBusGxWoPLih7ao/view">Ver</a></p>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <p>¿Ya tienes una cuenta? <a class="registro" href="<?php echo LOCAL_HOST; ?>/user/login">Iniciar sesión</a></p>
                        </div>

                        <div class="col-4"></div>
                        <div class="col-2 ms-2 ms-sm-auto">
                        <button class="btn btn-primary btn-con-padding" id="submitForm" type="submit">Registrarse</button>
                        <!--<a type="submit" class="btn btn-primary btn-con-padding" href="login">Registrarse</a>--></div>
                        <div class="col-5"></div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <?php require_once('App/Views/componentes/footer.php'); ?>
</body>
<script> <?php require_once("Public/static/js/registro.js"); ?> <!-- script que lee los datos del formulario y redirecciona  </script>
</html>
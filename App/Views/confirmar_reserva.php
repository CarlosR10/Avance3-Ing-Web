<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirma Tu Reserva</title>

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

    <div class="mt-0 d-inline-block">
        <a href="<?php echo LOCAL_HOST; ?>/preorder/new" class="nav-link">
            <i class="bi bi-arrow-left-short backicon d-flex ms-0 ms-sm-auto "></i>
        </a>
    </div>

    <section class="get_in_touch">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 mx-auto my-5 ml-1 mr-1">
                    <h1 class="text-center">Confirma tu Reserva</h1>
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="fecha" class="form-label">Fecha de Reserva</label>
                            <input type="date" class="form-control" id="fecha" value="2023-10-22" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="hora" class="form-label">Hora de Reserva</label>
                            <input type="time" format="12" class="form-control" id="hora" value="12:00" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="personas" class="form-label">Cantidad de personas</label>
                            <input type="number" max="25" min="0" class="form-control" id="personas" placeholder="0" value="1" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="sillasninos" class="form-label">Cantidad de sillas para niños</label>
                            <input type="number" max="5" min="0" class="form-control" id="sillasninos" placeholder="0" value="2" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="comentarios" class="form-label">Comentarios (Opcional)</label>
                            <input type="text" class="form-control" id="comentarios" placeholder="Escribe tu texto aquí" value="Estaré solo, pero espero que haya algo de comida para niños." disabled>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-5">
                            <div class="btn-group">
                                <a type="submit" class="btn btn-primary mx-2 ms-sm-3 me-sm-1 ms-md-1 ms-lg-3 rounded-2" href="<?php echo LOCAL_HOST; ?>/preorder/new">Cambiar</a>
                                <a type="submit" class="btn btn-primary ms-1 rounded-2" href="<?php echo LOCAL_HOST; ?>/preorder/search">Confirmar</a>
                            </div>
                        </div>
                        <div class="col-4"></div>                    
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('App/Views/componentes/footer.php'); ?>

</body>

</html>
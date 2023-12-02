<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel de Imágenes</title>
    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!-- api para utilizar ajax y cargar ciertos elementos mediante jquery 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    llamar al nav-bar y footer mediante el id 
    <script src="MVC/Views/js/componentes.js"></script> Esto ya no es necesario porque lo realiza php-->
    <!-- en vista de que el router ha causado problemas para cargar el css externo mediante utilizando import o
    link hemos decidido cargarlo con php (en el turtorial que segui no ocurrio ese error, es raro la verdad)
    <link rel="stylesheet" href="Public/static/css/style.css">
    <script src="js/componentes.js"></script>-->

    <style> <?php include_once 'Public/static/css/style.css'; include_once 'Public/static/css/home_restaurante.css'; ?> </style>
</head>

<body class="background-image">
    <!-- Div principal con una clase personalizada "get_in_touch", lo que hace que los divs se presenten en un contenedor blanco en la pagina-->
    <?php require_once('App/Views/componentes/header.php'); ?>

    <div class="mt-0 d-inline-block">
        <a href="<?php echo LOCAL_HOST; ?>/restaurant/search" class="nav-link">
            <i class="bi bi-arrow-left-short backicon d-flex ms-0 ms-sm-auto "></i>
        </a>
    </div>
    
    <div class="get_in_touch">
        <!-- Contenedor Bootstrap -->
        <div class="container mt-4">
            <!-- Fila Bootstrap -->
            <div class="row">
                <div class="col-md-4 mb-3 detalles">
                    <h3><?php echo $parameters['restaurant']['nombre']; ?></h3>
                    <p><?php echo $parameters['restaurant']['descripcion']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <h3>Ubicación</h3>
                    <p><?php echo $parameters['restaurant']['direccion']; ?></p>
                    <!-- IFrame de Google Maps para mostrar la ubicación -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe
                            class="embed-responsive-item"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d58228.197203244155!2d-79.38801765552304!3d9.055354248817283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2spa!4v1698011870334!5m2!1ses!2spa"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Ubicación">
                        </iframe>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h4>Provincia</h4>
                    <p><?php echo $parameters['restaurant']['provincia']; ?></p>
                    <h4>Categoría</h4>
                    <p><?php echo $parameters['categorie']['categoria']; ?></p>
                    <h4>Facilidades</h4>
                    <p><?php echo $parameters['facilitie']['facilidad']; ?></p>
                    <h4>Teléfono</h4>
                    <p><?php echo $parameters['restaurant']['telefono']; ?></p>
                    <h4>Email</h4>
                    <p><?php echo $parameters['restaurant']['email']; ?></p>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Segundo div principal con una clase personalizada "get_in_touch2" -->
    <div class="get_in_touch2">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <h3>Menu</h3>
                    <p>Platillos destacados</p>
                </div>
            </div>
            <div class="row platillos">
                <!-- Imágenes en columnas con descripciones -->
                <div class="col-md-2">
                    <img src="<?php echo $parameters['dish'][0]['image_url']; ?>" alt="Ensalada de pollo y aguacate" class="img-fluid">
                    <p><?php echo $parameters['dish'][0]['nombre']; ?><br><br><strong><?php echo $parameters['dish'][0]['precio']; ?></strong></p>
                </div>
                <div class="col-md-2">
                    <img src="<?php echo $parameters['dish'][1]['image_url']; ?>" alt="Chupe de camarones" class="img-fluid">
                    <p><?php echo $parameters['dish'][1]['nombre']; ?><br><br><strong><?php echo $parameters['dish'][1]['precio']; ?></strong></p>
                </div>
                <div class="col-md-2">
                    <img src="<?php echo $parameters['dish'][2]['image_url']; ?>" alt="Arroz, huevo y aguacate" class="img-fluid">
                    <p><?php echo $parameters['dish'][2]['nombre']; ?><br><br><strong><?php echo $parameters['dish'][2]['precio']; ?></strong></p>
                </div>
                <div class="col-md-2">
                    <img src="<?php echo $parameters['dish'][3]['image_url']; ?>" alt="Carne preparada con salsa de soya" class="img-fluid">
                    <p><?php echo $parameters['dish'][3]['nombre']; ?><br><br><strong><?php echo $parameters['dish'][3]['precio']; ?></strong></p>
                </div>
                <div class="col-md-2">
                    <img src="<?php echo $parameters['dish'][4]['image_url']; ?>" alt="Desyuno de waffles con moras" class="img-fluid">
                    <p><?php echo $parameters['dish'][4]['nombre']; ?><br><br><strong><?php echo $parameters['dish'][4]['precio']; ?></strong></p>
                </div>
             </div>
             <!--Opcion para descargar el menu del restaurante-->
             <div class="row menu">                
                    <p>Sirviendo desde 1995, para descargar el menú, haga click <a href="https://drive.google.com/file/d/124KlRFMbIFPbWWOFiYhKvoOhwhEwdrBO/view?usp=drive_link" download>Aquí</a> </p>
             </div>
        </div>
    </div>

    <?php require_once('App/Views/componentes/footer.php'); ?>
    <!-- Scripts de Bootstrap para funcionalidad adicional -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>

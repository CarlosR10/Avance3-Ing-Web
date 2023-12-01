<?php
    //require_once("MVC/Controllers/page_controller.php");
    
    // Cargar Helpers (funciones o clases pequeñas y especializadas que proporcionan funcionalidades comunes)
    require_once("Helpers/results.php");

    // Conexion a la base de datos
    require_once("App/Models/db_core/orm.php"); // Object relational mapping para manejar la creacion de modelos
    require_once("App/Models/db_core/db.php"); // Conexion a la base de datos

    // Urls
    require_once("Render/controller.php"); // controlador padre del que heredan los otros (se utiliza para renderizar las vistas)
    require_once("App/Routing/router.php"); // router
    require_once("App/Routing/config.php"); // configuracion inicial de url

    $router = new Router(); // instanciar el router
    $router->run();
?>



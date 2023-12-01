<?php

$folder_path = dirname($_SERVER['SCRIPT_NAME']);  // ruta del archivo
$url_path = $_SERVER['REQUEST_URI'];  // ruta completa de la url
$url = substr($url_path, (strlen($folder_path) - 1)); // argumentos que necesitamos de la url

define('URL', $url); // url almancenada en una constante
define('LOCAL_HOST', 'http://localhost');
define('DEPLOY', 'https://addled-radiuses.000webhostapp.com');

?>
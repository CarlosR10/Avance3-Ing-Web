<?php
class controller {

    protected function render($path, $parameters = []) { // (protected) para que no se pueda acceder fuera de la clase, pero si sus subclases o clases hijas
        //cargar la vista
        require_once("App/Views/$path.php");
    }

    /*protected function model($path){
        // cargar el modelo
        require_once("App/Models/" . $path . "_model.php");
    }*/

    protected function set_alert($text){
        // Cadena de texto a guardar
        $string = $text;

        // Ruta del archivo a guardar la cadena
        $file_path = "redirect_cookie.txt";

        // Guardar la cadena en el archivo
        file_put_contents($file_path, $string);
    }

    protected function get_alert(){
        
        // Ruta del archivo del cual vamos a el contenido
        $file_path = "redirect_cookie.txt";

        // Obtener el contenido del archivo y almacenarlo en una variable
        $content = file_get_contents($file_path);

        return $content;
    }

    protected function get_cookie($cookie_name, $alt_value) {
        // obtener el valor de la cookie con el nombre de usuario
        if(isset($_COOKIE[$cookie_name])) {
            // Obtener el valor de la cookie
            $value = $_COOKIE[$cookie_name];
        } else {
            $value =  $alt_value;
        }

        return $value;
    }
    
}
?>
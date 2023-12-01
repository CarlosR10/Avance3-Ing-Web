<?php
    class Router{

        private $controller; // define que controlador (funcion) se va a utilizar
        private $method; // detecta de que lanzar
        private $counter; // variable donde se guarda la cantidad de ejecuciones de la web (guardada en la cookie visit_counter)

        public function __construct(){
            $this->matchRoute();
        }

        public function matchRoute() {
            $url = explode('/', URL); // Separar los argumentos de la URL cuando encuentre '/' (esta variable es un array)
            $url_string = implode("/", $url);
            $this->controller = $url[1];
            $this->method = $url[2];

            $this->controller = $this->controller . "_controller";

            require_once('App/Controllers/'.$this->controller.'.php');

        }

        public function run() {

            $res = new Result(); // Clase helper para impresion de jsons

            $database = new Database(); // instanciar la base de datos
            $connection_db = $database->get_connection(); // abrir la conexion

            $controller = new $this->controller($connection_db); // Usar la variable $controller para instanciar la clase de forma dinamica
            $method = $this->method;

            $session_counter = $this->counter(); // para obtener si es la primera vez que acceden a la web

            if ($session_counter == 1){
                try {
                    $controller->login(); // redireccionar por defecto a login la primera vez
                } catch (Exception $e) {
                    $res->debug = $e->getMessage();
                    echo json_encode($res);
                }
            }

            else{
                try {
                    $controller->$method(); // no puedo creer que el problema era que no habia puesto el signo de dolar y no pasaba el nombre del metodo... casi un dia, pero asi es programar jajaja
                    $database->close_connection(); // cerrar la conexion
                } catch (Exception $e) {
                    // En caso de error modificar el result
                    $res->debug = $e->getMessage();
                    $res->message = 'Mensaje de error.';
                    // obtener la informacion en formato json
                    echo json_encode($res);
                    $database->close_connection(); // cerrar la conexion
                }
            }
        }

        public function counter() {
            // Verificar si la cookie está presente
            if (!isset($_COOKIE['visit_counter'])) {
                // Si la cookie no existe, inicializar el contador a 0
                $this->counter = 0;
            } else {
                // Si la cookie existe, obtener el valor actual del contador desde la cookie
                $this->counter = (int)$_COOKIE['visit_counter'];
            }
        
            // Incrementar el contador
            $this->counter++;
        
            // Guardar el nuevo valor en la cookie con una duración de 10 minutos
            // es decir al pasar 10 minutos volveras a ser redirigido a login por defecto
            setcookie('visit_counter', $this->counter, time() + 3600, '/'); 
        
            // Mostrar el valor del contador
            //echo "Número de ejecuciones: " . $this->counter;
        
            return $this->counter;
        }

    }
?>
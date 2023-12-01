<?php
// Cargar el modelo
require_once('App/Models/mis_reservas_model.php');
require_once('App/Models/restaurantes_model.php');
require_once('App/Models/categorias_model.php');
require_once('App/Models/facilidades_model.php');
require_once('App/Models/platos_model.php');

// Clase que define las rutas a cada controlador (en otras palabras a cada pagina)
class preorder_controller extends controller{

    public function __construct($connection){
        // Iniciar la conexion
        $this->restaurantes_model = new Restaurants_model($connection);
        $this->reservas_model = new Mis_reservas_model($connection);
        $this->categorias_model = new Categorias_model($connection);
        $this->facilidades_model = new Facilidades_model($connection);
        $this->platos_model = new Platos_model($connection);
    }

    // ---------------------- ADAPTAR RESTAURANTES, A LA BUSQUEDA QUE SE AJUSTA, HACER EL CRUD DE RESERVAS, EL VER MAS DE RESTAURANTES
    //Y POR ULTIMO BUSQUEDA POR FILTROS-----------------------
    public function new(){
        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");

        $get_restaurants = $this->restaurantes_model->get_restaurant();
        
        //Llamar a la vista
        $this->render('formulario_reserva', ['user' => $user, 'TRUE' => true]);
    }

    /*public function confirm(){
        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");
        
        //Llamar a la vista
        $this->render('confirmar_reserva', ['user' => $user, 'TRUE' => true]);
    }*/

    public function search(){
        // Si vienes redireccionando de una crear o editar reserva
        if($this->get_alert() == 'TRUE'){
            // Registration successful
            $alert = <<<EOT
            <div id="info_msg" class="alert alert-success" role="alert">
                <p><strong>¡Has reservado tu cena de forma exitosa!</strong></p>
            </div>
            EOT;
            echo $alert; // mensaje de confirmacion (de registro)

            // eliminar la cookie de registro exitoso
            $this->set_alert("FALSE");
            //setcookie("register_cookie", "exitoso", time() - 3600, "/");
        }

        // Si vienes redireccionando de una ELIMINAR reserva
        if($this->get_alert() == 'DEL'){
            // Registration successful
            $alert = <<<EOT
            <div id="info_msg" class="alert alert-success" role="alert">
                <p><strong>¡Has eliminado tu reserva de forma exitosa!</strong> no olvides pasarte por nuestro portal para buscar otro restaurante ;)</p>
            </div>
            EOT;
            echo $alert; // mensaje de confirmacion (de registro)

            // eliminar la cookie de registro exitoso
            $this->set_alert("FALSE");
            //setcookie("register_cookie", "exitoso", time() - 3600, "/");
        }

        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");

        //Llamar a la vista
        $this->render('mis_reservas', ['user' => $user, 'TRUE' => true]);
    }

    public function edit(){
        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");

        // Obtener el id la reserva en el parametro enviado por metodo get
        $preorder_id = $_GET['id'];

        $preorder = $this->reservas_model->get_preorder_by_id($preorder_id);

        $date = $preorder['fecha']; // formato '2023-11-20 19:00:00'

        // Convertir la cadena que contiene la fecha a un timestamp
        $timestamp = strtotime($date);

        // Obtener la fecha en formato 'Y-m-d'
        $fecha = date('Y-m-d', $timestamp);

        // Obtener la hora en formato 'H:i'
        $hora = date('H:i', $timestamp );

        //Llamar a la vista
        $this->render('editar_reserva', ['user' => $user, 'TRUE' => true, 'preorder' => $preorder_id, 'fecha' => $fecha, 'hora' => $hora, 'reserva' => $preorder]);
    }

    public function cancel(){
        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");

        // Obtener el id la reserva en el parametro enviado por metodo get
        $preorder_id = $_GET['id'];

        $preorder = $this->reservas_model->get_preorder_by_id($preorder_id);

        $date = $preorder['fecha']; // formato '2023-11-20 19:00:00'

        // Convertir la cadena que contiene la fecha a un timestamp
        $timestamp = strtotime($date);

        // Obtener la fecha en formato 'Y-m-d'
        $fecha = date('Y-m-d', $timestamp);

        // Obtener la hora en formato 'H:i'
        $hora = date('H:i', $timestamp );
        
        //Llamar a la vista
        $this->render('eliminar_reserva', ['user' => $user, 'TRUE' => true, 'preorder' => $preorder_id, 'fecha' => $fecha, 'hora' => $hora, 'reserva' => $preorder]);
    }

    public function read_all() {
        // obtener el valor de la cookie con el id del usuario para obtener sus reservas
        $user_id = $this->get_cookie("user_id", null);

        // Buscar todas las reservas disponibles para el id de ese usuario
        if(isset($user_id)){
            $get_preorder = $this->reservas_model->get_preorders($user_id);
        }

        // Cargar el helper result
        $res = new Result();

        // si el array asociativo tiene datos, es decir hay reservas
        if (!empty($get_preorder)){
            // Modificar el result
            $res->success = true;
            $res->message = 'Has hecho una reserva con estos restaurantes de forma exitosa.';
            $res->result = $get_preorder;

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
        } 
        // si el array asociativo no tiene datos, es decir no hay reservas
        else {
            // Modificar el result
            $res->message = 'No aas hecho ninguna reserva.';
            $res->result = $get_preorder;

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
        }

    }

    public function preorder_filter(){
        // obtener el valor de la cookie con el id del usuario para obtener sus reservas
        $user_id = $this->get_cookie("user_id", null);

        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $food = $body['comida'];
        $type = $body['tiporest'];
        $price = $body['precio'];
        $province = $body['provincia'];
        $facilitie = $body['facilidad'];

        // $food = 'Francés';
        // $type = 'Francés';
        // $price = '5.00 - 10.00';
        // $province = 'Cordoba';
        // $facilitie = 'Wi-Fi';

        // Obtenemos el id y el nombre del restaurante y el codigo de reserva mediante el filtro para buscar todas las reservas disponibles
        if(isset($user_id)){
            $preorder_filter = $this->reservas_model->preorder_filter($user_id, $type, $province);
        }

        $preorder_id = $preorder_filter[0]['cod_reserva'];
        // echo $price;
        // echo $preorder_id;
        // echo $user_id;
        $restaurant_id = $preorder_filter[0]['id_restaurante'];
        // echo $restaurant_id;

        // Mandamos el precio y el id del usuario para filtrar platos correspondientes a las reservas
        $dish_filter_preorder = $this->platos_model->dish_filter_preorder($price, $user_id, $preorder_id);
        // echo json_encode($dish_filter_preorder);

        $categorie_id = $dish_filter_preorder['id_categoria'];
        // echo json_encode($categorie_id);

        // Mandamos el id de la categoria para filtrar categorias
        $categories_filter = $this->categorias_model->get_categorie_by_id($categorie_id);
        // echo json_encode($categories_filter);

        // Mandamos el id del restaurante para filtrar facilidades
        $facilitie_filter = $this->facilidades_model->get_facilitie_by_restid($restaurant_id);
        // echo json_encode($facilitie_filter);

        // Si ninguna de las subconsultas devuelve un array vacio (significado que existe un restaurante con las condiciones buscadas)
        if (!empty($dish_filter_preorder) && !empty($categories_filter) && !empty($facilitie_filter)){
            // Modificar el result
            $res->success = true;
            $res->message = 'Has obtenido todas las reservas filtradas de forma exitosa.';
            $res->result = $preorder_filter;

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);

        } else{
            // Modificar el result
            $res->message = 'Ninguna reserva coincide con tu busqueda.';
            $res->result = $preorder_filter;

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
        }
        
    }

    public function create(){
        // obtener el valor de la cookie con el id del usuario para guardar su reserva
        $user_id = strval($this->get_cookie("user_id", null)); // lo convertimos a string para evitar errores;

        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $time = $body['hora'];  // 12:30 PM
        // Convertir de '12:30 PM' a '12:30:00'
        $new_time = date("H:i:s", strtotime($time));

        $comments = $body['comentarios'];
        // convertir el comentario a minuscula si no esta vacio
        if (!empty($comments)){
            $comments = strtolower($body['comentarios']);

            // Verificar si el comentario contiene la palabra "pendiente"
            if (stripos($comments, 'pendiente') !== false) {
                $state = "Pending";
            }
            // si el comentario no contiene la palabra pendiente 
            // tambien se deja en confirmado
            else {
                $state = "Confirmed";
            }
        }
        // si esta vacio se coloca por defecto en confirmado
        else {
            $state = "Confirmed";
        }
        
        $restaurant_id = strval($body['restaurantes']); // lo convertimos a string para evitar errores;
        $date = $body['fecha'] . " " . $new_time;
        $guests = strval($body['personas']);
        $chairs = strval($body['sillas']);

        // $user_id = strval(1);
        // $restaurant_id = strval(4);
        // $date = '2023-11-20 19:00:00';
        // $guests = strval(2);
        // $chairs = strval(3);
        // $comments = 'comentario';
        // $state = 'confirmaooooooooooooooo';

        // Insertar datos de reserva
        $new_preorder = $this->reservas_model->insert_preorder($user_id, $restaurant_id, $date, $guests, $chairs, $comments, $state);

        try{
            // Modificar el result
            $res->success = true;
            $res->message = 'La reserva se ha registrado correctamente.';

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
            $this->set_alert("TRUE");
        } catch (Exception $e) {
            // Modificar el result
            $res->message = 'Ha ocurrido un problema, la reserva no ha sido registrada.';
            $res->debug = $e;

            // obtener la informacion en formato json
            echo json_encode($res);
        }
        
    }

    public function read() {
        // obtener el valor de la cookie con el id del usuario para obtener sus reservas
        $user_id = $this->get_cookie("user_id", null);

        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $search = $body['busqueda'];
        //$search = 'Risto';

        // Buscar todas las reservas disponibles para el id de ese usuario en base al restaurante buscado
        if(isset($user_id) && isset($search)){
            $get_preorder_search = $this->reservas_model->get_preorders_by_name($user_id, $search);

            // Modificar el result
            $res->success = true;
            $res->message = 'Has hecho una reserva con este restaurante de forma exitosa.';
            //$res->debug = $user_id;
            $res->result = $get_preorder_search; 

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
        } else {
            // Modificar el result
            $res->message = 'No tienes ninguna reserva registrada con este restaurante.';
            $res->result = $get_preorder_search; 

            // obtener la informacion en formato json
            echo json_encode($res);
        }
    }

    public function update() {
        // obtener el valor de la cookie con el id del usuario para guardar su reserva
        $user_id = strval($this->get_cookie("user_id", null)); // lo convertimos a string para evitar errores;

        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $time = $body['hora'];  // 12:30 PM
        // Convertir de '12:30 PM' a '12:30:00'
        $new_time = date("H:i:s", strtotime($time));

        $comments = $body['comentarios'];
        // convertir el comentario a minuscula si no esta vacio
        if (!empty($comments)){
            $comments = strtolower($body['comentarios']);

            // Verificar si el comentario contiene la palabra "pendiente"
            if (stripos($comments, 'pendiente') !== false) {
                $state = "Pending";
            }
            // si el comentario no contiene la palabra pendiente 
            // tambien se deja en confirmado
            else {
                $state = "Confirmed";
            }
        }
        // si esta vacio se coloca por defecto en confirmado
        else {
            $state = "Confirmed";
        }

        $preorder_id = strval($body['preorder_id']);
        $restaurant_id = strval($body['restaurantes']); // lo convertimos a string para evitar errores;
        $date = $body['fecha'] . " " . $new_time;
        $guests = strval($body['personas']);
        $chairs = strval($body['sillas']);

        // $preorder_id = strval(6);
        // $user_id = strval(1);
        // $restaurant_id = strval(6);
        // $date = '2023-11-20 19:00:00';
        // $guests = strval(2);
        // $chairs = strval(3);
        // $comments = 'comentario';
        // $state = 'confirmaoooooooooooo';

        // Actualizar datos de reserva
        $update_preorder = $this->reservas_model->update_preorder($date, $guests, $chairs, $comments, $state, $preorder_id, $user_id, $restaurant_id);

        try{
            // Modificar el result
            $res->success = true;
            $res->message = 'La reserva se ha actualizado correctamente.';

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
            $this->set_alert("TRUE");
        } catch (Exception $e) {
            // Modificar el result
            $res->message = 'Ha ocurrido un problema, la reserva no ha sido actualizada.';
            $res->debug = $e;

            // obtener la informacion en formato json
            echo json_encode($res);
        }
    }

    public function delete(){
        // obtener el valor de la cookie con el id del usuario para guardar su reserva
        $user_id = strval($this->get_cookie("user_id", null)); // lo convertimos a string para evitar errores;

        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $preorder_id = strval($body['preorder_id']);
        $restaurant_id = strval($body['restaurantes']); // lo convertimos a string para evitar errores;

        // $preorder_id = strval(6);
        // $user_id = strval(1);
        // $restaurant_id = strval(6);
        // $date = '2023-11-20 19:00:00';
        // $guests = strval(2);
        // $chairs = strval(3);
        // $comments = 'comentario';
        // $state = 'confirmaoooooooooooo';

        // Actualizar datos de reserva
        $delete_preorder = $this->reservas_model->delete_preorder($preorder_id, $user_id, $restaurant_id);

        try{
            // Modificar el result
            $res->success = true;
            $res->message = 'La reserva se ha eliminado correctamente.';

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
            $this->set_alert("DEL");
        } catch (Exception $e) {
            // Modificar el result
            $res->message = 'Ha ocurrido un problema, la reserva no ha sido eliminado.';
            $res->debug = $e;

            // obtener la informacion en formato json
            echo json_encode($res);
        }
    }

}



<?php
// Cargar el modelo
require_once('App/Models/restaurantes_model.php');
require_once('App/Models/platos_model.php');
require_once('App/Models/categorias_model.php');
require_once('App/Models/facilidades_model.php');
require_once('App/Models/facilidades_rest_model.php');

// Clase que define las rutas a cada controlador (en otras palabras a cada pagina)
class restaurant_controller extends controller{

    public function __construct($connection){
        // Iniciar la conexion
        $this->restaurantes_model = new Restaurants_model($connection);
        $this->platos_model = new Platos_model($connection);
        $this->categorias_model = new Categorias_model($connection);
        $this->facilidades_model = new Facilidades_model($connection);
        $this->facilidades_rest_model = new Facilidades_Rest_model($connection);
    }

    // ---------------------- EL VER MAS DE RESTAURANTE Y POR ULTIMO BUSQUEDA POR FILTROS-----------------------

    public function search(){
        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");

        //Llamar a la vista
        $this->render('restaurantes', ['user' => $user, 'TRUE' => true]);
    }

    public function info(){
        // obtener el valor de la cookie con el nombre de usuario
        $user = $this->get_cookie("user_name", "Nombre de Usuario");

        // Obtener el id del restaurante en el parametro enviado por metodo get
        $restaurant_id = $_GET['id'];

        // Obtener el nombre del restaurante
        $get_restaurants_by_id = $this->restaurantes_model->get_restaurant_by_id($restaurant_id);

        // Obtener el nombre del plato
        $get_dish = $this->platos_model->get_dish_by_id($restaurant_id);

        // Obtener la categoria del plato
        $get_dish_categorie = $this->platos_model->get_dish_categorie($restaurant_id);

        // Obtener la facilidad del restarante
        $get_facilitie = $this->facilidades_rest_model->get_facilitie($restaurant_id);

        //Llamar a la vista
        $this->render('home_restaurante', [
            'user' => $user, 
            'TRUE' => true,
            'restaurant' => $get_restaurants_by_id,
            'dish' => $get_dish,
            'categorie' => $get_dish_categorie,
            'facilitie' => $get_facilitie,
        ]);
    }

    public function read_all() {
        // Cargar el helper result
        $res = new Result();

        $get_restaurants = $this->restaurantes_model->get_restaurant();

        // Modificar el result
        $res->success = true;
        $res->message = 'Has obtenido todos los restaurantes de forma exitosa.';
        $res->result = $get_restaurants;

        // obtener la informacion en formato json y activar la cookie de redireccion
        echo json_encode($res);
    }

    public function read() {
        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $search = $body['busqueda'];
        //$search = 'asdadsdas';

        $get_restaurants_search = $this->restaurantes_model->get_restaurant_by_name($search);

        // Buscar todas las reservas disponibles para el id de ese usuario en base al restaurante buscado
        if(!empty($get_restaurants_search)){
            // Modificar el result
            $res->success = true;
            $res->message = 'Estos restaurantes existen en nuestros registros.';
            //$res->debug = $user_id;
            $res->result = $get_restaurants_search; 

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
        } else {
            // Modificar el result
            $res->message = 'Estos restaurantes no trabajan con nosotros.';
            $res->result = $get_restaurants_search; 

            // obtener la informacion en formato json
            echo json_encode($res);
        }
    }

    public function read_filter(){
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
        // $price = '20.01 o más';
        // $province = 'Santa Fe';
        // $facilitie = 'Wi-Fi';

        // Obtenemos el id y el nombre del restaurante mediante el filtro 
        $restaurant_filter = $this->restaurantes_model->restaurant_filter($type, $province);

        $restaurant_id = $restaurant_filter[0]['id'];

        // Mandamos el precio y el id del restaurante para filtrar platos
        $dish_filter = $this->platos_model->dish_filter_rest($price, $restaurant_id);

        $categorie_id = $dish_filter['id_categoria'];

        // Mandamos el id de la categoria para filtrar categorias
        $categories_filter = $this->categorias_model->get_categorie_by_id($categorie_id);

        // Mandamos el id del restaurante para filtrar facilidades
        $facilitie_filter = $this->facilidades_model->get_facilitie_by_restid($restaurant_id);

        // Si ninguna de las subconsultas devuelve un array vacio (significado que existe un restaurante con las condiciones buscadas)
        if (!empty($dish_filter) && !empty($categories_filter) && !empty($facilitie_filter)){
            // Modificar el result
            $res->success = true;
            $res->message = 'Has obtenido todos los restaurantes filtrados de forma exitosa.';
            $res->result = $restaurant_filter;

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);

        } else{
            // Modificar el result
            $res->message = 'Ningun restaurante coincide con tu busqueda.';
            $res->result = $restaurant_filter;

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
        }
        
    }

}

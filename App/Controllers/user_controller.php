<?php
// Cargar el modelo
require_once('App/Models/usuarios_model.php');
require_once('App/Models/info_contacto_model.php');

// Clase que define las rutas a cada controlador (en otras palabras a cada pagina)
class user_controller extends controller{

    public function __construct($connection){
        // Iniciar la conexion
        $this->usuario_model = new Usuarios_model($connection);
        $this->info_contacto_model = new Info_contacto_model($connection);
    }

    public function login(){

        if($this->get_alert() == 'TRUE'){
            // Registration successful
            $alert = <<<EOT
            <div id="info_msg" class="alert alert-success" role="alert">
                <p><strong>¡Te has registrado!</strong> Un gusto que hayas decidido formar parte de Mamma Mia.</p>
            </div>
            EOT;
            echo $alert; // mensaje de confirmacion (de registro)

            // eliminar la cookie (personalizada en la clase) de registro exitoso
            $this->set_alert("FALSE");
            //setcookie("register_cookie", "exitoso", time() - 3600, "/");
        }

        if($this->get_alert() == 'TRUEPASS'){
            // Registration successful
            $alert = <<<EOT
            <div id="info_msg" class="alert alert-success" role="alert">
                <p><strong>¡Has cambiado tu contraseña con éxito!</strong> Ya puedes iniciar sesión.</p>
            </div>
            EOT;
            echo $alert; // mensaje de confirmacion (de registro)

            // eliminar la cookie (personalizada en la clase) de registro exitoso
            $this->set_alert("FALSE");
            //setcookie("register_cookie", "exitoso", time() - 3600, "/");
        }

        //Llamar a la vista
        $this->render('index0');
    }

    public function recovery(){
        // Llamar a la vista para recuperar contrase
        $this->render('recuperar_contra');
    }

    public function sign_up(){
        // Llamar a la vista
        $this->render('registro');
    }

    public function home(){

        if($this->get_alert() == 'TRUE'){
            // Registration successful
            $alert = <<<EOT
            <div id="info_msg" class="alert alert-success" role="alert">
                <p><strong>¡Bienvenido a Mamma Mia!</strong></p>
            </div>
            EOT;
            echo $alert; // mensaje de confirmacion (de registro)

            // eliminar la cookie de registro exitoso
            $this->set_alert("FALSE");
            //setcookie("register_cookie", "exitoso", time() - 3600, "/");
        }

        // Obtener el id del usuario del parametro enviado por metodo get
        $user_id = $_GET['id'];

        // Establecer la cookie para guardar el id del usuario
        setcookie("user_id", $user_id, time() + (86400), "/");

        // Obtener el nombre del usuario correspondiente al registro
        $user = $this->usuario_model->get_by_id($user_id);

        // Establecer la cookie para guardar el nombre del usuario
        setcookie("user_name", $user['nombre'], time() + (86400), "/");

        //Llamar a la vista
        $this->render('home', [ 'user' => $user['nombre'], 'TRUE' => true]);
    }

    public function create(){
        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $name = $body['nombre'];
        $last_name = $body['apellido'];
        $phone_number = $body['telefono'];
        $address = $body['direccion'];
        $last_name = $body['apellido'];
        $email = $body['correo'];
        $passwd = $body['contraseña'];

        // Insertar datos del usuario 
        $new_user = $this->usuario_model->insert(['nombre' => $name, 'apellido' => $last_name, 'email' => $email, 'pass' => $passwd]);

        $new_user_info = $this->info_contacto_model->insert_info(['telefono' => $phone_number, 'direccion' => $address]);

        try{
            // Modificar el result
            $res->success = true;
            $res->message = 'El usuario se ha registrado correctamente.';

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
            $this->set_alert("TRUE");
        } catch (Exception $e) {
            // Modificar el result
            $res->message = 'Ha ocurrido un problema, el usuario no ha sido registrado.';

            // obtener la informacion en formato json
            echo json_encode($res);
        }
        
    }

    public function read(){
        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $email = $body['correo'];
        $passwd = $body['contraseña'];

        //$email = 'jony1047@hotmail.com';
        //$passwd = '12345678';

        $get_user = $this->usuario_model->validate_user($email, $passwd); // validar correo y contra

        try{
            // Modificar el result
            $res->success = true;
            $res->message = 'El usuario existe en nuestros registros.';
            $res->result = $get_user; 

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
            $this->set_alert("TRUE");
        } catch (Exception $e) {
            // Modificar el result
            $res->message = 'El usuario no existe en nuestros registros.';
            $res->result = $get_user; 

            // obtener la informacion en formato json
            echo json_encode($res);
        }

    }

    public function update(){
        // Cargar el helper result
        $res = new Result();

        // Receive and process POST data
        $post_data = file_get_contents('php://input');
        $body = json_decode($post_data, true); // Get JSON data from POST request

        $email = $body['correo'];
        $passwd = $body['contraseña'];

        // $email = 'john.doe@example.com';
        // $passwd = '87654321';

        try{
            // validar correo y contra
            $get_user = $this->usuario_model->update_user($email, $passwd);

            // Modificar el result
            $res->success = true;
            $res->message = 'La contraseña ha sido cambiado con éxito.';

            // obtener la informacion en formato json y activar la cookie de redireccion
            echo json_encode($res);
            // configurar alerta de redireccionamiento
            $this->set_alert("TRUEPASS");
        } catch (Exception $e) {
            // Modificar el result
            $res->message = 'Ha ocurrido un error al intentar cambiar de contraseña.';

            // obtener la informacion en formato json
            echo json_encode($res);
        }

    }

}

?>


<?php
/* SELECT nombre, fecha, invitados, sillas_num, comentarios FROM restaurantes AS rest 
JOIN reservas AS re ON rest.id = re.id_restaurante 
WHERE re.id_usuario = 1 AND rest.nombre LIKE '%risto%'; */
class Mis_reservas_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'reservas', $connection);
    }

    public function insert_preorder($user_id, $restaurant_id, $date, $guests, $chairs, $comments, $state){
        $sql = "INSERT INTO {$this->table} (id_usuario, id_restaurante, fecha, personas_num, sillas_num, comentarios, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $types = '';

        // Prepare the statement
        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("sssssss", $user_id, $restaurant_id, $date, $guests, $chairs, $comments, $state); 

        // Execute the statement
        $stmt->execute();
        
    }

    public function get_preorder_by_id($id){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE cod_reserva = ?");
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        //Fetching all the rows
        return $result->fetch_assoc();
    }

    public function get_preorders($id){
        $sql = "SELECT cod_reserva, nombre FROM restaurantes AS rest 
        JOIN {$this->table} AS re ON rest.id = re.id_restaurante 
        WHERE re.id_usuario = ?";

        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        $preorders = [];
        while ($row = $result->fetch_assoc()) {
            $preorders[] = $row;
        }

        return $preorders;
    }

    public function get_preorders_by_name($id, $name){
        $sql = "SELECT cod_reserva, nombre FROM restaurantes AS rest 
        JOIN {$this->table} AS re ON rest.id = re.id_restaurante 
        WHERE re.id_usuario = ? AND rest.nombre LIKE '%" . $name . "%'";

        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        $preorders = [];
        while ($row = $result->fetch_assoc()) {
            $preorders[] = $row;
        }

        return $preorders;
    }

//     UPDATE reservas
// SET
//   fecha = '2023-11-26 14:30:00', -- nueva fecha
//   personas_num = 3, -- nuevo número de personas
//   sillas_num = 2, -- nuevo número de sillas
//   comentarios = 'Nuevos comentarios', -- nuevos comentarios
//   estado = 'Confirmado' -- nuevo estado
// WHERE
//   cod_reserva = 1 AND
//   id_usuario = 123 AND
//   id_restaurante = 456;

    public function update_preorder($date, $guests, $chairs, $comments, $state, $preorder_id, $user_id,  $restaurant_id){

        $sql = "UPDATE {$this->table} SET fecha = ?, personas_num = ?, sillas_num = ?, comentarios = ?, estado = ? ";
        $sql .= "WHERE cod_reserva = ? AND id_usuario = ? AND id_restaurante = ?";
        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("ssssssss", $date, $guests, $chairs, $comments, $state, $preorder_id, $user_id, $restaurant_id); 
        //Executing the statement
        $stmt->execute();

    }

//     DELETE FROM reservas
// WHERE cod_reserva = 1 AND id_usuario = 123 AND id_restaurante = 456;

    public function delete_preorder($preorder_id, $user_id,  $restaurant_id){

        $sql = "DELETE FROM {$this->table} ";
        $sql .= "WHERE cod_reserva = ? AND id_usuario = ? AND id_restaurante = ?";
        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("sss", $preorder_id, $user_id, $restaurant_id); 
        //Executing the statement
        $stmt->execute();

    }

    public function preorder_filter($user_id, $type, $province) {
        $sql = "SELECT cod_reserva, id_restaurante, nombre FROM restaurantes AS rest ";
        $sql .= "JOIN {$this->table} AS re ON rest.id = re.id_restaurante WHERE re.id_usuario = ? ";
        $sql .= "AND (tipo LIKE '%" . $type . "%' OR provincia LIKE '%" . $province . "%')";
        $stmt = $this->db->prepare($sql);

        // Bind Param
        $stmt->bind_param("i", $user_id);

        //Executing the statement
        $stmt->execute();

        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        $preorders = [];
        while ($row = $result->fetch_assoc()) {
            $preorders[] = $row;
        }

        return $preorders;

    }


    
}
?>
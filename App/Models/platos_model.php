<?php
class Platos_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'platos', $connection);
    }

    public function get_dish_by_id($id){
        $sql = "SELECT nombre, precio, image_url FROM {$this->table} WHERE id_restaurante = ?";
        $stmt = $this->db->prepare($sql);

        // Bind Param
        $stmt->bind_param("i", $id); // string
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        $dishes = [];
        while ($row = $result->fetch_assoc()) {
            $dishes[] = $row;
        }

        return $dishes;
    }

    public function get_dish_categorie($id) {
        $sql = "SELECT c.categoria, p.nombre AS nombre_plato FROM {$this->table} p ";
        $sql .= "JOIN categorias c ON p.id_categoria = c.id WHERE p.id_restaurante = ?";
        $stmt = $this->db->prepare($sql);

        // Bind Param
        $stmt->bind_param("i", $id); // string
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        //Fetching all the rows
        return $result->fetch_assoc();
    }

    public function dish_filter_rest($price, $restaurant_id){

        if ($price == '5.00 - 10.00'){
            $sql = "SELECT id_categoria, precio from {$this->table} WHERE precio BETWEEN 5.00 AND 10.00 AND id_restaurante = ?";
        }
        else if ($price == '10.01 - 15.00'){
            $sql = "SELECT id_categoria, precio from {$this->table} WHERE precio BETWEEN 10.01 AND 15.00 AND id_restaurante = ?";
        }
        else if ($price == '15.01 - 20.00'){
            $sql = "SELECT id_categoria, precio from {$this->table} WHERE precio BETWEEN 15.01 AND 20.00 AND id_restaurante = ?";
        }
        else if ($price == '20.01 o más'){
            $sql = "SELECT id_categoria, precio from {$this->table} WHERE precio >= 20.01 AND id_restaurante = ?";
        }

        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("i", $restaurant_id); // string
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        return $result->fetch_assoc();
    }

    public function dish_filter_preorder($price, $user_id, $preorder_id){

        $sql = "SELECT precio, id_categoria FROM {$this->table} p JOIN reservas r ON p.id = r.id_plato WHERE r.id_usuario = ? AND r.cod_reserva = ? ";
        
        if ($price == '5.00 - 10.00'){
            $sql .= "AND precio BETWEEN 5.00 AND 10.00";
        }
        else if ($price == '10.01 - 15.00'){
            $sql .= "AND precio BETWEEN 10.01 AND 15.00";
        }
        else if ($price == '15.01 - 20.00'){
            $sql .= "AND precio BETWEEN 15.01 AND 20.00";
        }
        else if ($price == '20.01 o más'){
            $sql .= "AND precio >= 20.01";
        }

        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("ii", $user_id, $preorder_id); // string
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        return $result->fetch_assoc();
    }

    
}
?>
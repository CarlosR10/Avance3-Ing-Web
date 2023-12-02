<?php
//SELECT * FROM `restaurantes` WHERE nombre LIKE '%Ristoran%';
class Restaurants_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'restaurantes', $connection);
    }

    public function get_restaurant(){
        $sql = "SELECT id, nombre FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        // Bind Param
        //$stmt->bind_param("s", $name); // string
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

    public function get_restaurant_by_name($name){
        $sql = "SELECT id, nombre FROM {$this->table} WHERE nombre LIKE '%" . $name . "%'";
        $stmt = $this->db->prepare($sql);

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

    public function get_restaurant_by_id($id){
        $sql = "SELECT id, nombre, descripcion, direccion, telefono, provincia, email FROM {$this->table} WHERE id = ?";
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

    public function restaurant_filter($type, $province) {
        $sql = "SELECT id, nombre FROM restaurantes WHERE tipo LIKE '%" . $type . "%' OR provincia LIKE '%" . $province . "%'";
        $stmt = $this->db->prepare($sql);

        //Executing the statement
        $stmt->execute();

        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        $restaurants = [];
        while ($row = $result->fetch_assoc()) {
            $restaurants[] = $row;
        }

        return $restaurants;

    }
    
    
}
?>

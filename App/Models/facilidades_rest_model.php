<?php
//SELECT * FROM `restaurantes` WHERE nombre LIKE '%Ristoran%';
class Facilidades_Rest_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'facilidades_rest', $connection);
    }

    public function get_facilitie($id) {
        $sql = "SELECT f.facilidad FROM {$this->table} fr ";
        $sql .= "JOIN facilidades f ON fr.id_facilidad = f.id ";
        $sql .= "WHERE fr.id_restaurante = ?";
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

    // SELECT f.facilidad
    // FROM facilidades_rest fr
    // JOIN facilidades f ON fr.id_facilidad = f.id
    // WHERE fr.id_restaurante = 1; -- Reemplaza '1' con el ID del restaurante que deseas consultar


    
}
?>
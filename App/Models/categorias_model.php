<?php

class Categorias_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'categorias', $connection);
    }

    public function get_categorie_by_id($id){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        //Fetching all the rows
        return $result->fetch_assoc();
    }
    
}
?>


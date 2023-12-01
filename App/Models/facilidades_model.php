<?php

class Facilidades_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'facilidades', $connection);
    }

    public function get_facilitie_by_restid($id){
        // SELECT facilidades.facilidad FROM facilidades 
        // JOIN facilidades_rest ON facilidades.id = facilidades_rest.id_facilidad WHERE facilidades_rest.id_restaurante = 4;
        $sql = "SELECT facilidades.facilidad FROM {$this->table} ";
        $sql .= "JOIN facilidades_rest ON facilidades.id = facilidades_rest.id_facilidad WHERE facilidades_rest.id_restaurante = ?";
        $stmt = $this->db->prepare($sql);
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        // Fetching all the rows
        $facilities = [];
        while ($row = $result->fetch_assoc()) {
            $facilities[] = $row;
        }

        return $facilities;
    }
    
}
?>
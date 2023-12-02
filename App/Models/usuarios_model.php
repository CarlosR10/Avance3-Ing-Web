<?php
class Usuarios_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'usuarios', $connection);
    }

    public function validate_user($email, $pass){
        $stmt = $this->db->prepare("SELECT id, nombre, email FROM {$this->table} WHERE email = ? and pass = ?");
        // Bind Param
        $stmt->bind_param("ss", $email, $pass); // strings
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        //Fetching all the rows
        return $result->fetch_assoc();
    }

    public function update_user($email, $pass){
        // UPDATE mi_tabla
        // SET columna2 = 'nuevo_valor'
        // WHERE columna1 = 'valor_especifico';
        $stmt = $this->db->prepare("UPDATE {$this->table} SET pass = ? WHERE email = ?");
        // Bind Param
        $stmt->bind_param("ss", $pass, $email); // strings
        //Executing the statement
        $stmt->execute();
    }
    
}
?>

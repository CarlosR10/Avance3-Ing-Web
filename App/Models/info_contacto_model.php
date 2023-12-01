<?php
class Info_contacto_model extends Orm {
 
    public function __construct($connection){
        parent::__construct('id', 'info_contacto', $connection);
    }

    public function insert_info($data){
        //SET @id_usuario = LAST_INSERT_ID();
        //-- Insertar información de contacto para el usuario utilizando el ID obtenido
        //INSERT INTO info_contacto (id_usuario, telefono, direccion) VALUES (@id_usuario, '555-1234', '123 Main Street');

        // Obtener el id del usuario creado para la tabla usuarios
        $sql_user_id = "SET @id_usuario = LAST_INSERT_ID()";

        // Prepare the first statement
        $stmt_user_id = $this->db->prepare($sql_user_id);

        // Execute the first statement
        $stmt_user_id->execute();

        // query
        $sql = "INSERT INTO {$this->table} (id_usuario,";
        $types = '';

        foreach($data as $key => $value){
            $sql .= "{$key},"; // agrega por cada elemento en el array key, a la sentencia sql
            $types .= 's'; // asumimos que todos los valores son strings por el momento
            $values[] = $value; // guardamos todos los values en un array
        }

        $sql = trim($sql, ','); // elimina la coma en el ultimo elemento
        $sql .= ") VALUES (@id_usuario,"; // Al final agrega los signos

        foreach($data as $key => $value){
            $sql .= "?,"; // agregar los signos interrogacion necesarios
        }

        $sql = trim($sql, ','); // elimina la coma en el ultimo elemento
        $sql .= ")"; // cerramos el ultimo parentesis*/

        // Prepare the second statement
        $stmt = $this->db->prepare($sql);

        // Combina el tipo de datos ($types) con los valores ($values) en un array
        $params = array_merge([$types], $values); // el [] se usa para convertir las variables types en array, ya que previamente no lo es

        // Usar call_user_func_array para pasar los parámetros a params de manera dinámica
        call_user_func_array(array($stmt, 'bind_param'), $params);

        // Execute the second statement
        $stmt->execute();
        
    }
    
}
?>
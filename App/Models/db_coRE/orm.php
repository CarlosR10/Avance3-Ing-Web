<?php

class Orm {
    protected $id;
    protected $table;
    protected $db;

    public function __construct($id, $table, $connection) {
        
        $this->id = $id;
        $this->table = $table;
        $this->db = $connection;
    }

    public function get_all(){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        //Fetching all the rows
        return $result->fetch_all();
    }

    public function get_by_id($id){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE ID = ?");
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();
        //Retrieving the result
        $result = $stmt->get_result();

        //Fetching all the rows
        return $result->fetch_assoc();
    }

    public function delete_by_id($id){
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE ID = ?");
        // Bind Param
        $stmt->bind_param("i", $id); // integer
        //Executing the statement
        $stmt->execute();     
    }
    
    public function update_by_id($id, $data){
        $sql = "UPDATE {$this->table} SET ";
        $types = '';

        foreach($data as $key => $value){
            $sql .= "{$key} = ?,"; // agrega por cada elemento en el array key = ?, a la sentencia sql
            $types .= 's'; // asumimos que todos los valores son strings por el momento
            $values[] = $value; // guardamos todos los values en un array
        }
        $types .= 'i'; // el ultimo valor (id) es integer
        $sql = trim($sql, ','); // elimina la coma en el ultimo elemento
        $sql .= " WHERE id = ?"; // al final agrega la condicion where id, el espacio es para evitar error de sintaxis

        // Prepare the statement
        $stmt = $this->db->prepare($sql);

        // Combina el tipo de datos ($types) con los valores ($values) en un array
        $params = array_merge([$types], $values, [$id]); // el [] se usa para convertir las variables types y id en arrays, ya que previamente no lo son

        // Usar call_user_func_array para pasar los parámetros a params de manera dinámica
        // de esta forma se llama al metodo bind_param de stmt y se agregan los parametros uno por uno
        call_user_func_array(array($stmt, 'bind_param'), $params); 
        
        //Bind_params syntax //$stmt->bind_param("sssi", $nombre, $email, $pass, $id); 
        // "sss" stands for string, "i" for integer because the columns are varchar and integer, representing the data types of the parameters

        // Execute the statement
        $stmt->execute();
    }

    public function insert($data){
        $sql = "INSERT INTO {$this->table} (";
        $types = '';

        foreach($data as $key => $value){
            $sql .= "{$key},"; // agrega por cada elemento en el array key, a la sentencia sql
            $types .= 's'; // asumimos que todos los valores son strings por el momento
            $values[] = $value; // guardamos todos los values en un array
        }

        $sql = trim($sql, ','); // elimina la coma en el ultimo elemento
        $sql .= ") VALUES ("; // Al final agrega los signos

        foreach($data as $key => $value){
            $sql .= "?,"; // agregar los signos interrogacion necesarios
        }

        $sql = trim($sql, ','); // elimina la coma en el ultimo elemento
        $sql .= ")"; // cerramos el ultimo parentesis*/

        // Prepare the statement
        $stmt = $this->db->prepare($sql);

        // Combina el tipo de datos ($types) con los valores ($values) en un array
        $params = array_merge([$types], $values); // el [] se usa para convertir las variables types en array, ya que previamente no lo es

        // Usar call_user_func_array para pasar los parámetros a params de manera dinámica
        call_user_func_array(array($stmt, 'bind_param'), $params);

        // Execute the statement
        $stmt->execute();
        
    }
}
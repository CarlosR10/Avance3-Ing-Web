<?php
class Database{
    
    private $connection;
    public function __construct(){

        try {
            $this->connection = mysqli_connect('localhost', 'root', '', 'hub_restaurante');
            $this->connection->query("SET NAMES 'utf8'");
            
        } catch (Exception $e) {
            $res->debug = $e->getMessage();
            $res->message = $e->getLine();
            // obtener la informacion en formato json
            echo json_encode($res);
        }
    
    }

    public function get_connection() {
        return $this->connection;
    }

    public function close_connection() {
        if ($this->connection != null){
            $this->connection = null;
        }
        
    }

}
?>

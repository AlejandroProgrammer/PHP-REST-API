<?php
    class Clientes{

        private $conn;

        private $db_table = "Clientes";

        public $Rut;
        public $Nombre;
        public $Edad;
        public $Direccion;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getClientes(){
            $sqlQuery = "SELECT Rut, Nombre, Edad, Direccion FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createCliente(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Rut = :Rut, 
                        Nombre = :Nombre, 
                        Edad = :Edad,  
                        Direccion = :Direccion";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Rut=htmlspecialchars(strip_tags($this->Rut));
            $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
            $this->Edad=htmlspecialchars(strip_tags($this->Edad));
            $this->Direccion=htmlspecialchars(strip_tags($this->Direccion));
        
            $stmt->bindParam(":Rut", $this->Rut);
            $stmt->bindParam(":Nombre", $this->Nombre);
            $stmt->bindParam(":Edad", $this->Edad);
            $stmt->bindParam(":Direccion", $this->Direccion);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleCliente(){
            $sqlQuery = "SELECT
                        Rut, 
                        Nombre, 
                        Edad, 
                        Direccion
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       Rut = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->Rut);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Rut = $dataRow['Rut'];
            $this->Nombre = $dataRow['Nombre'];
            $this->Edad = $dataRow['Edad'];
            $this->Direccion = $dataRow['Direccion'];
        }        

        public function updateCliente(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        Rut = :Rut,
                        Nombre = :Nombre, 
                        Edad = :Edad,
                        Direccion = :Direccion
                    WHERE 
                        Rut = :Rut";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Rut=htmlspecialchars(strip_tags($this->Rut));
            $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
            $this->Edad=htmlspecialchars(strip_tags($this->Edad));
            $this->Direccion=htmlspecialchars(strip_tags($this->Direccion));
        
            $stmt->bindParam(":Rut", $this->Rut);
            $stmt->bindParam(":Nombre", $this->Nombre);
            $stmt->bindParam(":Edad", $this->Edad);
            $stmt->bindParam(":Direccion", $this->Direccion);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteCliente(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Rut = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Rut=htmlspecialchars(strip_tags($this->Rut));
        
            $stmt->bindParam(1, $this->Rut);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>


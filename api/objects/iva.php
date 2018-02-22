<?php
class IVA {

    // conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "iva";

    // Propiedades del objeto
    public $id;
    public $empresa_id;
    public $fecha;
    public $nombre;
    public $cantidad;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener el log del iva
    function read(){
    
        // select all query
        $query = "SELECT `id`, `empresa_id`, `fecha`, `nombre`, `cantidad`
                    FROM iva 
                    WHERE `empresa_id` = 1
                    ORDER BY `fecha` DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function getById($idiva) {
        // select all query
        $query = "SELECT `id`, `empresa_id`, `fecha`, `nombre`, `cantidad`
                    FROM iva 
                    WHERE `empresa_id` = 1 
                    AND `id` = ".$idiva;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // insertar una cuenta
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO ".$this->table_name." (`empresa_id`, `fecha`, `nombre`, `cantidad`) 
                    VALUES (
                        :empresa_id,
                        now(),
                        :nombre,
                        :cantidad
                    )";
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // limpieza de los datos
        $this->empresa_id=htmlspecialchars(strip_tags($this->empresa_id));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
    
        // bind values
        $stmt->bindParam(":empresa_id", $this->empresa_id);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":cantidad", $this->cantidad);
    
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
        
        
    }

    // actualizar datos de la cuenta
    function update(){
    
        // query 
        $query = "UPDATE ".$this->table_name." SET 
                    `fecha`= now(),
                    `nombre`=:nombre,
                    `cantidad`=:cantidad 
                    WHERE `id` =:id";
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values        
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":id", $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
        
        
    }

}
?>
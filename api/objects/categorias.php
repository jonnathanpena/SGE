<?php
class Categorias {

    // conexión a la base de datos 
    private $conn;

    // Propiedades del objeto
    public $id;
    public $empresa_id;
    public $nombre;
    public $abreviatura;
    public $descripcion;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener todos los roles
    function read(){
    
        // select all query
        $query = "SELECT * FROM `categorias_productos` WHERE `empresa_id` = 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // insertar una cuenta
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `categorias_productos`(`empresa_id`, `nombre`, `abreviatura`, `descripcion`) 
                    VALUES (
                    :empresa_id,
                    :nombre,
                    :abreviatura,
                    :descripcion
                )";
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // limpieza de los datos
        $this->empresa_id=htmlspecialchars(strip_tags($this->empresa_id));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));        
        $this->abreviatura=htmlspecialchars(strip_tags($this->abreviatura));        
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));        
    
        // bind values
        $stmt->bindParam(":empresa_id", $this->empresa_id);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":abreviatura", $this->abreviatura);
        $stmt->bindParam(":descripcion", $this->descripcion);
    
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
        
        
    }

    // actualizar datos del rol
    function update(){
    
        // query 
        $query = "UPDATE `categorias_productos` SET 
                    `nombre`= :nombre,
                    `abreviatura`= :abreviatura,
                    `descripcion`= :descripcion WHERE `id` = :id";
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->abreviatura=htmlspecialchars(strip_tags($this->abreviatura));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values        
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":abreviatura", $this->abreviatura);
        $stmt->bindParam(":descripcion", $this->descripcion);
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
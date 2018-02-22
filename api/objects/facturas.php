<?php
class Facturas {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    public $id;
    public $persona_id;
    public $empresa_id;
    public $local_id;
    public $tipo_factura;
    public $fecha;
    public $usuario_id;
    public $iva_id;
    public $total_iva;
    public $subtotal;
    public $total;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener todas las facturas
    function read(){
    
        // select all query
        $query = "SELECT * FROM `facturas` WHERE `empresa_id` = 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function getById($idfactura){

        $query = "SELECT * FROM `facturas` WHERE `id` = ".$idfactura;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function insert(){
       
    
         // query to insert record
         $query = "INSERT INTO `facturas`(`persona_id`, `empresa_id`, `local_id`, `tipo_factura`, 
         `fecha`, `usuario_id`, `iva_id`, `subtotal`, `total_iva`, `total`) VALUES (
             ".$this->persona_id.",
             1,
             ".$this->local_id.",
             1,
             now(),
             ".$this->usuario_id.",
             ".$this->iva_id.",
             ".$this->subtotal.",
             ".$this->total_iva.",
             ".$this->total."
         )";

        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return false;
        }   
    }

}
?>
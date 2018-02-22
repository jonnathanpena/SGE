<?php
class PagosFactura {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    public $id;
    public $factura_id;
    public $cxc_id;
    public $metodo_id;
    public $cantidad_cancelada;
    public $cuenta_id;
    public $banco;
    public $tipo_tarjeta_id;
    public $referencia;
    public $email;
    public $celular;

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
         $query = "INSERT INTO `pagos_facturas`(`factura_id`, `cxc_id`, `metodo_id`, 
                    `cantidad_cancelada`, `cuenta_id`, `banco`, `tipo_tarjeta_id`, `referencia`, 
                    `email`, `celular`) VALUES (
                        ".$this->factura_id.",
                        ".$this->cxc_id.",
                        ".$this->metodo_id.",
                        ".$this->cantidad_cancelada.",
                        ".$this->cuenta_id.",
                        '".$this->banco."',
                        ".$this->tipo_tarjeta_id.",
                        '".$this->referencia."',
                        '".$this->email."',
                        '".$this->celular."'
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
<?php
class Cuentas {

    // conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "cuentas";

    // Propiedades del objeto
    public $id;
    public $empresa_id;
    public $nombre;
    public $tipo_fuente;
    public $bnco_numero;
    public $bnco_nombre;
    public $bnco_tipo_cuenta;
    public $bnco_saldo_inicial;
    public $email;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener todas las cuentas de la empresa
    function read(){
    
        // select all query
        $query = "SELECT * FROM ".$this->table_name." WHERE `empresa_id` = 1 ";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // insertar una cuenta
    function insert(){

        // query to insert record
        $query = "INSERT INTO ".$this->table_name." 
                    ( `empresa_id`, `nombre`, `tipo_fuente`, `bnco_numero`, 
                    `bnco_nombre`, `bnco_tipo_cuenta`, `bnco_saldo_inicial`, `email`) 
                    VALUES (
                        1,
                        '".$this->nombre."',
                        ".$this->tipo_fuente.",
                        '".$this->bnco_numero."',
                        '".$this->bnco_nombre."',
                        ".$this->bnco_tipo_cuenta.",
                        ".$this->bnco_saldo_inicial.",
                        '".$this->email."'
                    )";
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
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
                    `nombre`= '".$this->nombre."',
                    `bnco_numero`= '".$this->bnco_numero."',
                    `bnco_nombre`= '".$this->bnco_nombre."',
                    `bnco_tipo_cuenta`= ".$this->bnco_tipo_cuenta.",
                    `bnco_saldo_inicial`= ".$this->bnco_saldo_inicial.",
                    `email`= '".$this->email."' WHERE `id` = ".$this->id;
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            echo json_encode($stmt);
        }   
        
        
    }

}
?>
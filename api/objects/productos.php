<?php
class Productos {

    // conexión a la base de datos 
    private $conn;

    // Propiedades del objeto
    public $id;
    public $categoria_id;
    public $nom_categoria;
    public $nombre;
    public $unidad;
    public $codigo;
    public $descripcion;
    public $servicio;
    public $activo;
    public $iva_id;
    public $cantidad;
    public $SUM;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener todos los productos
    function read(){
    
        // select all query
        $query = "SELECT prod.`id`, prod.`categoria_id`, cat.`nombre` as nom_categoria, 
                    prod.`nombre`, prod.`unidad`, prod.`codigo`, prod.`descripcion`, 
                    prod.`servicio`, prod.`activo`, iva.`id` as iva_id, iva.`cantidad`
                    FROM `productos` as prod
                    JOIN `categorias_productos` as cat ON (cat.`id` = prod.`categoria_id`)
                    JOIN `iva` as iva ON (iva.`id` = prod.`iva_id`)
                    WHERE cat.`empresa_id` = 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function getById($idprod){
        // select all query
        $query = "SELECT prod.`id`, prod.`categoria_id`, cat.`nombre` as nom_categoria, 
                    prod.`nombre`, prod.`unidad`, prod.`codigo`, prod.`descripcion`, 
                    prod.`servicio`, prod.`activo`, iva.`id` as iva_id, iva.`cantidad`
                    FROM `productos` as prod
                    JOIN `categorias_productos` as cat ON (cat.`id` = prod.`categoria_id`)
                    JOIN `iva` as iva ON (iva.`id` = prod.`iva_id`)
                    WHERE cat.`empresa_id` = 1 AND prod.`id` = ".$idprod;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function sumaProductosCategoria($id){
        $query = "SELECT COUNT(`id`) as SUM FROM `productos` WHERE `categoria_id` = ".$id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();    
        return $stmt;
    }

    function getAbreviaturaCategoria($id) {
        $query = "SELECT `abreviatura` FROM `categorias_productos` WHERE `id` = ".$id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();    
        return $stmt;
    }

    function getIdByCodCategoria($cod, $cat) {
        $query = "SELECT `id` FROM `productos` 
                    WHERE `codigo` = '".$cod."' AND `categoria_id` = ".$cat;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();    
        return $stmt;
    }

    // insertar un producto
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `productos`(`categoria_id`, `nombre`, `unidad`, `codigo`, `descripcion`, 
                    `servicio`, `activo`, `iva_id`) 
                    VALUES (
                        :categoria_id,
                        :nombre,
                        :unidad,
                        :codigo,
                        :descripcion,
                        :servicio,
                        :activo,
                        :iva_id
                )";
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // limpieza de los datos
        $this->categoria_id=htmlspecialchars(strip_tags($this->categoria_id));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));        
        $this->unidad=htmlspecialchars(strip_tags($this->unidad));        
        $this->codigo=htmlspecialchars(strip_tags($this->codigo));        
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));        
        $this->servicio=htmlspecialchars(strip_tags($this->servicio));        
        $this->activo=htmlspecialchars(strip_tags($this->activo));        
        $this->iva_id=htmlspecialchars(strip_tags($this->iva_id));        
    
        // bind values
        $stmt->bindParam(":categoria_id", $this->categoria_id);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":unidad", $this->unidad);
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":servicio", $this->servicio);
        $stmt->bindParam(":activo", $this->activo);
        $stmt->bindParam(":iva_id", $this->iva_id);
    
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
        $query = "UPDATE `productos` SET 
                    `categoria_id`= ".$this->categoria_id.",
                    `nombre`= '".$this->nombre."',
                    `unidad`= '".$this->unidad."',
                    `codigo`= '".$this->codigo."',
                    `descripcion`= '".$this->descripcion."',
                    `servicio` = ".$this->servicio.",
                    `activo` = ".$this->activo.",
                    `iva_id` = ".$this->iva_id."
                    WHERE `id` = ".$this->id;
    
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
        
        
    }

}
?>
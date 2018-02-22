<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/productos.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$productos = new Productos($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);
 
// configura los valores recibidos en post de la app
$productos->categoria_id = $info[0]["categoria_id"];
$productos->nombre = $info[0]["nombre"];
$productos->unidad = $info[0]["unidad"];
$productos->codigo = $info[0]["codigo"];
$productos->descripcion = $info[0]["descripcion"];
$productos->servicio = $info[0]["servicio"];
$productos->activo = $info[0]["activo"];
$productos->iva_id = $info[0]["iva_id"];

// insertar producto
$response = $productos->insert();
if($response == true){
    echo json_encode(true); 
}else{
    // Error en caso de que no se pueda agregar
    echo json_encode(false); 
}
?>
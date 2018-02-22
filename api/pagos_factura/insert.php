<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/pagos_factura.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$pagos_facturas = new PagosFactura($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

for($i = 0; $i < count($info[0]["pagos"]); $i++){    
    $pagos_facturas->factura_id = $info[0]["factura_id"];
    $pagos_facturas->cxc_id = $info[0]["pagos"][$i]["cxc_id"];
    $pagos_facturas->metodo_id = $info[0]["pagos"][$i]["forma_pago"];
    $pagos_facturas->cantidad_cancelada = $info[0]["pagos"][$i]["aporte"];
    $pagos_facturas->cuenta_id = $info[0]["pagos"][$i]["cuenta_id"];
    $pagos_facturas->tipo_tarjeta_id = $info[0]["pagos"][$i]["tipo_tarjeta"];
    $pagos_facturas->referencia = $info[0]["pagos"][$i]["referencia"];
    $pagos_facturas->email = $info[0]["pagos"][$i]["email"];
    $pagos_facturas->celular = $info[0]["pagos"][$i]["celular"];
    $pagos_facturas->celular = $info[0]["pagos"][$i]["banco"];
    $pagos_facturas->insert();
}

echo json_encode(true); 
?>
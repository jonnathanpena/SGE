<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/cuentas.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$cuentas = new Cuentas($db);
 
// query de lectura
$stmt = $cuentas->read();
$num = $stmt->rowCount();

// cuentas array
$cuentas_arr=array();
$cuentas_arr["data"]=array();
 
// check if more than 0 record found
if($num>0){
    
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $cuenta_item=array(
            'id' => $id,
            'empresa_id' => $empresa_id,
            'nombre' => $nombre,
            'tipo_fuente' => $tipo_fuente,
            'bnco_numero' => $bnco_numero,
            'bnco_nombre' => $bnco_nombre,
            'bnco_tipo_cuenta' => $bnco_tipo_cuenta,
            'bnco_saldo_inicial' => $bnco_saldo_inicial,
            'email' => $email);
 
        array_push($cuentas_arr["data"], $cuenta_item);
    }
 
    echo json_encode($cuentas_arr);
}
 
else{    
    echo json_encode($cuentas_arr);
}
?>
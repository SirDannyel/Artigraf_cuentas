<?php

$conf = include('config.php'); 
$serverName  = $conf['server']; 
$username = "";
$password = "";
$dataBase = "DWH_Artigraf";

try {
    $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase");
    //echo "Conexion con $serverName";
} catch (Exception $e) {
    echo "Ocurrio un error en la conexion. " . $e->getMessage();
}

$query = "SELECT * FROM Fact_Saldos";
$stmt = $conn->query($query);
$registros = $stmt->fetchAll(PDO::FETCH_OBJ);

//Imprimir json:
header_remove('Set-Cookie');
$httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
if (is_array($httpHeaders) && count($httpHeaders)) {
    foreach ($httpHeaders as $httpHeader) {
        header($httpHeader);
    }
}
echo json_encode($registros);
exit();


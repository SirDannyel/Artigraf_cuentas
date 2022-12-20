<?php

$conf = include('config.php');
$server  = $conf['server'];

//Conectar a DB mediante PDO
$serverName = $server;
$dataBase = "DWH_Artigraf";
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];

$Respuesta = [];

$connectionInfo = array("Database"=>$dataBase, "UID"=>$UID, "PWD"=>$PWD);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    echo "Could not connect.\n";
    die(print_r(sqlsrv_errors(), true));
}

$query = "SELECT * FROM Dim_EF8 Order By EF8";
$stmt3 = sqlsrv_query($conn, $query);
$cont = 0;
while ($Response = sqlsrv_fetch_object($stmt3)) {
    $Respuesta[$cont] = $Response;
    $cont = $cont + 1;
}

header_remove('Set-Cookie');
$httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
if (is_array($httpHeaders) && count($httpHeaders)) {
    foreach ($httpHeaders as $httpHeader) {
        header($httpHeader);
    }
}

echo json_encode($Respuesta);
sqlsrv_close($conn);
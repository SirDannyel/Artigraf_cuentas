<?php

$conf = include('config.php');
$server  = $conf['server'];
$dataBase = "DWH_Artigraf";

try {
    $conn = new PDO ("sqlsrv:server=$server;database=$dataBase");
    //echo "Conexion con $serverName";
} catch (Exception $e) {
    echo "Ocurrio un error en la conexion. " . $e->getMessage();
}

$parametro = $_GET['nivel'];
$dato = $_GET["dato"];

switch ($parametro){
    case "EF1":
        $query = "SELECT * FROM Dim_RangoCuentas where EF1 = '$dato'  order by Orden";
        break;
    case "EF2":
        $query = "SELECT * FROM Dim_RangoCuentas where EF2 = '$dato' order by Orden";
        break;
    case "EF3":
        $query = "SELECT * FROM Dim_RangoCuentas where EF3 = '$dato' order by Orden";
        break;
    case "EF4":
        $query = "SELECT * FROM Dim_RangoCuentas where EF4 = '$dato' order by Orden";
        break;
    case "EF5":
        $query = "SELECT * FROM Dim_RangoCuentas where EF5 = '$dato' order by Orden";
        break;
    case "EF6":
        $query = "SELECT * FROM Dim_RangoCuentas where EF6 = '$dato' order by Orden";
        break;

    case "EF7":
        $query = "SELECT * FROM Dim_RangoCuentas where EF7 = '$dato' order by Orden";
        break;
    case "EF8":
        $query = "SELECT * FROM Dim_RangoCuentas where EF8 = '$dato' order by Orden";
        break;

}

//Ejecutar Query

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


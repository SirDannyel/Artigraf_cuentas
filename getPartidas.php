<?php

$conf = include('config.php');

$server  = $conf['server'];

if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    //Conectar a DB mediante PDO
    //$serverName = "DESKTOP-907DBP9\SQLEXPRESS";
    $username = "";
    $password = "";
    $dataBase = "DWH_Artigraf";

    try {
        $conn = new PDO ("sqlsrv:server=$server;database=$dataBase");
        //echo "Conexion con $serverName";
    } catch (Exception $e) {
        echo "Ocurrio un error en la conexion. " . $e->getMessage();
    }


    //Establecer Zona horaria
    date_default_timezone_set("America/Monterrey");
    $fecha = date("Y-m-d");
    //$fecha_nueva = preg_replace('[-]', '', $fecha);
    //$fecha_post = $_GET["fecha"];

    //Ejecutar Select
    $query = "Select Fecha as fecha, CuentaContable as cuenta, Descripcion as descripcion, Cargo as cargo, Abono as abono, Movimiento as movimiento from PartidasEspeciales where fecha = '$fecha' order by fecha";
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

    //salir
    exit();

}

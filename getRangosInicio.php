<?php
$conf = include('config.php');
$server  = $conf['server'];

//Conectar a DB mediante PDO
$serverName = $server;
$username = "";
$password = "";
$dataBase = "DWH_Artigraf";

$registros = [];

try {
    $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase");
    //echo "Conexion con $serverName";
} catch (Exception $e) {
    echo "Ocurrio un error en la conexion. " . $e->getMessage();
}

if( $conn === false ) {
    echo "Conexión no se pudo establecer.";
    die( print_r( sqlsrv_errors(), true));
} else {

            //Ejecutar Query
            $query = "SELECT * FROM Dim_RangoCuentas order by Orden";
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

            //Salir


}




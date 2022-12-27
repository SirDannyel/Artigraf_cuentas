<?php

function writeServerLog($msg)
{
    @error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

$conf = include('config.php');
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];
$dataBase = $conf['database'];
$server  = $conf['server'];

try {
    $conn = new PDO ("sqlsrv:server=$server;database=$dataBase", $UID, $PWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e ) {
    echo "Ocurrio un error en la conexion. " . $e->getMessage();
}

switch ($_POST['tipo']) {
    case "get":
        $registros;

        $Proceso="Select Estados";
        $sql="Select Estado from Dim_Estado order by 1";

            $stmt4 = $conn->query($sql);
            $registros = $stmt4->fetchAll(PDO::FETCH_COLUMN);

                echo json_encode($registros);

        unset($stmts);
        unset($conn);

        break;
    case "post":

        $Proceso="Insert Estado";
        $sql="Insert into Dim_Estado (Estado) values( '{$_POST['estado']}')";
       // writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );

        $stmt = $conn->query($sql);
        echo 'ESTADO AGREGADO';

        unset($stmt);
        unset($conn);

        break;
    case "update":
        echo "update";
        break;
}




?>
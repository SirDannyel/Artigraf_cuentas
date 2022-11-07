<?php

$conf = include('config.php');
$server  = $conf['server'];

$Respuesta = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    //Conectar a DB mediante PDO
    $serverName = $server;
    $username = "";
    $password = "";
    $dataBase = "DWH_Artigraf";

    //Establecer Zona horaria
    date_default_timezone_set("America/Monterrey");
    $fecha = date("Y-m-d");

    //
    $connectionInfo = array("Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn === false ) {
        echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
    } else {

        $query = "Select Fecha as fecha, CuentaContable as cuenta, Descripcion as descripcion, Cargo as cargo, Abono as abono, Movimiento as movimiento, Linea as linea from PartidasEspeciales where Fecha >= '2022-11-01' and Fecha <= '2022-11-30' order by Fecha,Linea Desc";
        $stmt = sqlsrv_query($conn, $query);

        if($stmt === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{

            $cont = 0;
            while($Response = sqlsrv_fetch_object($stmt)) {

                $Respuesta [$cont] = $Response;
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
        }
    }

    //Desconectar servicio
    sqlsrv_close($conn);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['tipo'] === 'insert') {

    $serverName = $server;
    $username = "";
    $password = "";
    $dataBase = "DWH_Artigraf";


    //Conexion mediante driver sqlsrv
    $connectionInfo = array( "Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn === false ) {
        echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
    }

    $Linea = $_POST['linea'];
    $query="Delete from PartidasEspeciales where Linea = $Linea ";

        $stmt1 = sqlsrv_query($conn, $query);
        if($query === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo 'Partida borrada' ;
        }


    $query2="Delete from Fact_Saldos where PartidaLinea = $Linea";

    $stmt2 = sqlsrv_query($conn, $query2);
    if($query2 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registro borrado Fact Saldos' ;
    }

    //Desconectar servicio
    sqlsrv_close($conn);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['tipo'] === 'filtro'){

    $serverName = $server;
    $username = "";
    $password = "";
    $dataBase = "DWH_Artigraf";


    //Conexion mediante driver sqlsrv
    $connectionInfo = array( "Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn === false ) {
        echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
    } else {

             $query = "Select Fecha as fecha, CuentaContable as cuenta, Descripcion as descripcion, Cargo as cargo, Abono as abono, Movimiento as movimiento, Linea as linea from PartidasEspeciales where Fecha >= '{$_POST['fechainit']}' and Fecha <= '{$_POST['fechafin']}' order by Fecha,Linea Desc";
             $stmt = sqlsrv_query($conn, $query);

             if($stmt === false) {
                 die( print_r( sqlsrv_errors(), true));
             }else{

                 $cont = 0;
                 while($Response = sqlsrv_fetch_object($stmt)) {

                     $Respuesta [$cont] = $Response;
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
             }

    }
}

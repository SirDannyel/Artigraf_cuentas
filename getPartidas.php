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
    $date1 = $_GET["fechaini"];
    $date2 = $_GET["fechafin"];
  //  echo $date;

    //
    $connectionInfo = array("Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn === false ) {
        echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
    } else {


        $query = "Select Fecha as fecha, CuentaContable as cuenta, Descripcion as descripcion, Cargo as cargo, Abono as abono, Movimiento as movimiento, Linea as linea from PartidasEspeciales where Fecha >= '{$date1}' and Fecha <= '{$date2}' order by Fecha,Linea Desc";
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

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
        if($stmt1 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo 'Partida borrada' ;
        }


    $query3="Select * from Fact_Saldos where PartidasEsp = '1' and PartidaLinea = $Linea";

        $stmt3 = sqlsrv_query($conn, $query);
        if($stmt3 === false) {
            echo 'Registro no existe';
        }else{

            $query2="Delete from Fact_Saldos where PartidasEsp = '1' and PartidaLinea = $Linea";

            $stmt2 = sqlsrv_query($conn, $query2);
            if($stmt2 === false) {
                die( print_r( sqlsrv_errors(), true));
            }else{
                echo 'Registro borrado Fact Saldos' ;
            }

        }


    //Desconectar servicio
    sqlsrv_close($conn);

}
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

    //
    $connectionInfo = array("Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

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

        $Params = $_GET['tipo'];
    switch ($Params) {
        case "EF1":

            //Ejecutar Query
            $query = "SELECT * FROM EF1_Select";
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
            break;

        case "EF2":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF2";
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
            break;

        case "EF3":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF3";
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
            break;

        case "EF4":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF4";
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

            break;

        case "EF5":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF5";
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

            break;

        case "EF6":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF6";
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

            break;

        case "EF7":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF7";
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

            break;

        case "EF8":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_EF8";
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

            break;

        case "RangoCuentas":

            //Ejecutar Query
            $query = "SELECT * FROM Dim_RangoCuentas";
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

            break;

    }
    }


} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"));

    $serverName = $conf['server'];
    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $param = $data->tipo;

    switch ($param){
        case "InsertRango":

                $ef1 = $data->EF1;
                $ef1Desc = $data->EF1Desc;
                $cuentaInicio = $data->CuentaInicio;
                $cuentaFin = $data->CuentaFin;
                $mayor = 'prueba';
                $almacen = 'Prueba';
                $nivel1 = '0001';
                $nivel2 = '0000';
                $nivel3 = '0000';
                $nivel4 = '0000';
                $nivel5 = '0000';
                $mayorFin = '0000';
                $almacenFin = '0000';
                $nivel1Fin = '0000';
                $nivel2Fin = '0000';
                $nivel3Fin = '0000';
                $nivel4Fin = '0000';
                $nivel5Fin = '0000';
                $ef2 = $data->EF2;
                $ef2Desc = $data->EF2Desc;
                $ef3 = $data->EF3;
                $ef3Desc = $data->EF3Desc;
                $ef4 = $data->EF4;
                $ef4Desc = $data->EF4Desc;
                $ef5 = $data->EF5;
                $ef5Desc = $data->EF5Desc;
                $ef6 = $data->EF6;
                $ef6Desc = $data->EF6Desc;
                $ef7 = $data->EF7;
                $ef7Desc = $data->EF7Desc;
                $ef8 = $data->EF8;
                $ef8Desc = $data->EF8Desc;
                $orden = $data->Orden;

            $query4="Insert into Dim_RangoCuentas (EF1,EF1Desc,CuentaInicio,CuentaFin,Mayor,Almacen,Nivel1,Nivel2,Nivel3,Nivel4,Nivel5,MayorFin,AlmacenFin,Nivel1Fin,Nivel2Fin,Nivel3Fin,Nivel4Fin,Nivel5Fin,EF2,EF2Desc,EF3,EF3Desc,EF4,EF4Desc,EF5,EF5Desc,EF6,EF6Desc,EF7,EF7Desc,EF8,EF8Desc,Orden) values ((?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?))";
            $parametros = array($ef1, $ef1Desc,$cuentaInicio,$cuentaFin,$mayor,$almacen,$nivel1,$nivel2,$nivel3,$nivel4,$nivel5,$mayorFin,$almacenFin,$nivel1Fin,$nivel2Fin,$nivel3Fin,$nivel4Fin,$nivel5Fin,$ef2, $ef2Desc, $ef3, $ef3Desc, $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $ef8, $ef8Desc,$orden);
            $stmt4 = sqlsrv_query($conn,$query4,$parametros);

            if($stmt4 === false) {
                die( print_r( sqlsrv_errors(), true));
            }else{
                echo 'Registrado en Rango Cuentas';
            }

            break;
    }

}
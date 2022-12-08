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

}
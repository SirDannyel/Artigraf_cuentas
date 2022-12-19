<?php

$conf = include('config.php');
$server  = $conf['server'];

$Respuesta = [];

$serverName = $server;;
$connectionInfo = array("Database" => "DWH_Artigraf");
$username = "";
$password = "";
$dataBase = "DWH_Artigraf";

if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    //Conectar a DB mediante PDO

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

    }
    }


} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"));


    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $param = $data->tipo;


    switch ($param){
        case "InsertRango":

            $mayor = "";
            $almacen = "";
            $nivel1 = "";
            $nivel2 = "";
            $nivel3 = "";
            $nivel4 = "";
            $nivel5 = "";

            $mayorFin = "";
            $almacenFin = "";
            $nivel1Fin = "";
            $nivel2Fin = "";
            $nivel3Fin = "";
            $nivel4Fin = "";
            $nivel5Fin ="";
            $cuentainicio_nueva = str_replace('?', '0', $data->CuentaInicio);
            $cuentafin_nueva = str_replace('?', '9', $data->CuentaFin);

            //print_r($resStr);

            $nivelesinicio_array = explode(',', $cuentainicio_nueva);
            $nivelesfin_array = explode(',', $cuentafin_nueva);
            $contador_inicio = count($nivelesinicio_array);

            if( $contador_inicio == 6){

                $mayor = $nivelesinicio_array[0];
                $almacen = $nivelesinicio_array[1];
                $nivel1 = $nivelesinicio_array[2];
                $nivel2 = $nivelesinicio_array[3];
                $nivel3 = $nivelesinicio_array[4];
                $nivel4 = $nivelesinicio_array[5];
                $nivel5 = '0000';

                $mayorFin = $nivelesfin_array[0];
                $almacenFin = $nivelesfin_array[1];
                $nivel1Fin = $nivelesfin_array[2];
                $nivel2Fin = $nivelesfin_array[3];
                $nivel3Fin = $nivelesfin_array[4];
                $nivel4Fin = $nivelesfin_array[5];
                $nivel5Fin ='9999';

            } elseif ($contador_inicio == 7){

                $mayor = $nivelesinicio_array[0];
                $almacen = $nivelesinicio_array[1];
                $nivel1 = $nivelesinicio_array[2];
                $nivel2 = $nivelesinicio_array[3];
                $nivel3 = $nivelesinicio_array[4];
                $nivel4 = $nivelesinicio_array[5];
                $nivel5 = $nivelesinicio_array[6];

                $mayorFin = $nivelesfin_array[0];
                $almacenFin = $nivelesfin_array[1];
                $nivel1Fin = $nivelesfin_array[2];
                $nivel2Fin = $nivelesfin_array[3];
                $nivel3Fin = $nivelesfin_array[4];
                $nivel4Fin = $nivelesfin_array[5];
                $nivel5Fin =$nivelesinicio_array[6];

            }

                $ef1 = $data->EF1;
                $ef1Desc = $data->EF1Desc;
                $cuentaInicio = $cuentainicio_nueva;
                $cuentaFin = $cuentafin_nueva;
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

            $query_EF1Select="Insert into EF1_Select (EF1,EF1_Desc) values ('{$ef1}','{$ef1Desc}')";
            //$parametros = array($ef1, $ef1Desc);
            $stmtEF1 = sqlsrv_query($conn,$query_EF1Select);

            if($stmtEF1 === false) {
                die( print_r( sqlsrv_errors(), true));
            }else{
                echo 'Registrado en EF1_Select';
            }

            break;
    }

}elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"));
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    for ($i = 0; $i < count($data); $i++) {

        $mayor = $data[$i]->Mayor;
        $almacen = $data[$i]->Almacen;
        $nivel1 = $data[$i]->Nivel1;
        $nivel2 = $data[$i]->Nivel2;
        $nivel3 = $data[$i]->Nivel3;
        $nivel4 = $data[$i]->Nivel4;
        $nivel5 = $data[$i]->Nivel5;

        $mayorFin = $data[$i]->MayorFin;
        $almacenFin = $data[$i]->AlmacenFin;
        $nivel1Fin = $data[$i]->Nivel1Fin;
        $nivel2Fin = $data[$i]->Nivel2Fin;
        $nivel3Fin = $data[$i]->Nivel3Fin;
        $nivel4Fin = $data[$i]->Nivel4Fin;
        $nivel5Fin = $data[$i]->Nivel5Fin;

    $ef1 = $data[$i]->EF1;
    $ef1Desc = $data[$i]->EF1Desc;
    $cuentaInicio = $data[$i]->CuentaInicio;
    $cuentaFin = $data[$i]->CuentaFin;
    $ef2 = $data[$i]->EF2;
    $ef2Desc = $data[$i]->EF2Desc;
    $ef3 = $data[$i]->EF3;
    $ef3Desc = $data[$i]->EF3Desc;
    $ef4 = $data[$i]->EF4;
    $ef4Desc = $data[$i]->EF4Desc;
    $ef5 = $data[$i]->EF5;
    $ef5Desc = $data[$i]->EF5Desc;
    $ef6 = $data[$i]->EF6;
    $ef6Desc = $data[$i]->EF6Desc;
    $ef7 = $data[$i]->EF7;
    $ef7Desc = $data[$i]->EF7Desc;
    $ef8 = $data[$i]->EF8;
    $ef8Desc = $data[$i]->EF8Desc;
    $orden = $data[$i]->Orden;
    $idRangos = $data[$i]->RangoCuentas_id;


        /*-------------------ACTUALIZAR TABLA DE DIM_CUENTACONTABLES-------------------*/
        /* Set up the parameterized query. */

        $tsql = "UPDATE Dim_RangoCuentas   
            SET EF1 = (?), EF1Desc = (?), CuentaInicio = (?),CuentaFin = (?),
            Mayor = (?) ,Almacen = (?) ,Nivel1 = (?) ,Nivel2 = (?) , Nivel3 = (?), Nivel4 = (?), Nivel5 = (?),
            MayorFin = (?), AlmacenFin = (?) , Nivel1Fin = (?), Nivel2Fin = (?), Nivel3Fin = (?), Nivel4Fin = (?), Nivel5Fin = (?), 
            EF2 = (?), EF2Desc = (?), EF3 = (?), EF3Desc = (?),
            EF4 = (?), EF4Desc = (?), EF5 = (?), EF5Desc = (?), EF6 = (?), EF6Desc = (?),
            EF7 = (?), EF7Desc = (?), EF8 = (?), EF8Desc = (?), Orden = (?)
            WHERE RangoCuentas_id = (?)";

        /* Assign literal parameter values. */

        $parametros = array($ef1, $ef1Desc,$cuentaInicio,$cuentaFin,$mayor,$almacen,$nivel1,$nivel2,$nivel3,$nivel4,$nivel5,$mayorFin,$almacenFin,$nivel1Fin,$nivel2Fin,$nivel3Fin,$nivel4Fin,$nivel5Fin,$ef2, $ef2Desc, $ef3, $ef3Desc, $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $ef8, $ef8Desc,$orden,$idRangos);

        /* Execute the query. */

        if (sqlsrv_query($conn, $tsql, $parametros)) {
            echo "Statement executed.\n";
        } else {
            echo "Error in statement execution.\n";
            die(print_r(sqlsrv_errors(), true));
        }
    }
    sqlsrv_close($conn);
}
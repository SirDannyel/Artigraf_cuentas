<?php

$conf = include('config.php');
$server  = $conf['server'];

//Conectar a DB mediante PDO
$serverName = $server;
$username = "";
$password = "";
$dataBase = "DWH_Artigraf";

try {
    $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase");
    //echo "Conexion con $serverName";
} catch (Exception $e) {
    echo "Ocurrio un error en la conexion. " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $Respuesta = [];

    $query = "SELECT * FROM EF1_Select Order By EF1";
    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

  /*  $query = "SELECT * FROM EF1_Select where EF1 = 80 Order By EF1";
    $stmt = $conn->query($query);
    $Respuesta = $stmt->fetchAll(PDO::FETCH_OBJ);

//Imprimir json:
    header_remove('Set-Cookie');
    $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
    if (is_array($httpHeaders) && count($httpHeaders)) {
        foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
        }
    }

    echo json_encode($Respuesta); */



    //echo $row["id"];
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


} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $query4="Insert into EF1_Select (EF1,EF1_Desc) values ('{$_POST['ef1_orden']}','{$_POST['ef1_desc']}')";
    $stmt4 = sqlsrv_query($conn,$query4);

    if($stmt4 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registrado en Rango Cuentas';
    }

    sqlsrv_close($conn);

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT'){

    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"));
    $id_number = intval($data->id);
    $EF1_Orden = intval($data->ef1_orden_nvo);
    $ef1Desc = $data->ef1_desc_nvo;
    $Params = array($id_number);
    $Params2 = array($data->ef1_orden_nvo,$data->ef1_desc_nvo,$data->ef1_orden_ant,$data->ef1_desc_ant);

    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $tsql = "UPDATE Dim_RangoCuentas SET EF1 = (?), EF1Desc = (?) WHERE EF1 = (?) AND EF1Desc = (?)";
    $stmt1 = sqlsrv_query($conn,$tsql,$Params2);

    if($stmt1 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registrado en Rango Cuentas';
    }


    $tsqli = "UPDATE EF1_Select SET EF1 = '{$EF1_Orden}', EF1_Desc = '{$ef1Desc}' WHERE id_ef1 = (?)";
    $stmt4 = sqlsrv_query($conn,$tsqli,$Params);

    if($stmt4 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registrado en Rango Cuentas';
    }

    sqlsrv_close($conn);

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE'){

    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"));
    $Params = array($data->id);

    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $tsql_Rango = "Delete From Dim_RangoCuentas WHERE EF1 = '{$data->ef1}' AND EF1Desc = '{$data->ef1_desc}'";
    $stmt_Rango = sqlsrv_query($conn,$tsql_Rango);

    if($stmt_Rango === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Eliminado en Rango Cuentas';
    }

    $query4="Delete From EF1_Select where id_ef1 = (?)";
    $stmt4 = sqlsrv_query($conn,$query4,$Params);

    if($stmt4 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registrado en Rango Cuentas';
    }

    sqlsrv_close($conn);

}
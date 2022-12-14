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
//Ejecutar Query
    $query = "SELECT * FROM EF4_Select Order By EF4";
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

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $query4="Insert into EF4_Select (EF4,EF4_Desc) values ('{$_POST['ef4_orden']}','{$_POST['ef4_desc']}')";
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
    $EF4_Orden = intval($data->ef4_orden_nvo);
    $ef4Desc = $data->ef4_desc_nvo;
    $Params = array($id_number);
    $Params2 = array($data->ef4_orden_nvo,$data->ef4_desc_nvo,$data->ef4_orden_ant,$data->ef4_desc_ant);

    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        echo "Could not connect.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    $tsql = "UPDATE Dim_RangoCuentas SET EF4 = (?), EF4Desc = (?) WHERE EF4 = (?) AND EF4Desc = (?)";
    $stmt1 = sqlsrv_query($conn,$tsql,$Params2);

    if($stmt1 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registrado en Rango Cuentas';
    }


    $tsqli = "UPDATE EF4_Select SET EF4 = '{$EF4_Orden}', EF4_Desc = '{$ef4Desc}' WHERE id_ef4 = (?)";
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

    $query4="Delete From EF4_Select where id_ef4 = (?)";
    $stmt4 = sqlsrv_query($conn,$query4,$Params);

    if($stmt4 === false) {
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo 'Registrado en Rango Cuentas';
    }

    sqlsrv_close($conn);

}
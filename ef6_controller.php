<?php

$conf = include('config.php');
$server  = $conf['server'];

//Conectar a DB mediante PDO
$serverName = $server;
$dataBase = "DWH_Artigraf";
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));
$Tipo = $data->tipo;

$connectionInfo = array("Database"=>$dataBase, "UID"=>$UID, "PWD"=>$PWD);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    echo "Could not connect.\n";
    die(print_r(sqlsrv_errors(), true));
}

switch ($Tipo){

    CASE "insert":

        $Orden = $data->ef1_orden;
        $Desc = $data->ef1_desc;

        $query2="Insert into Dim_EF6 (EF6,EF6_Desc) values ('{$Orden}','{$Desc}')";
        $stmt4 = sqlsrv_query($conn,$query2);

        if($stmt4 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo 'Registrado en Dim_EF2';
        }

        sqlsrv_close($conn);
        break;
    CASE "update":

        $id_number = intval($data->id);
        $EF1_Orden = intval($data->ef1_orden_nvo);
        $ef1Desc = $data->ef1_desc_nvo;

        $tsql = "UPDATE Dim_RangoCuentas SET EF6 = (?), EF6Desc = (?) WHERE EF6 = (?) AND EF6Desc = (?)";
        $Params2 = array($data->ef1_orden_nvo,$data->ef1_desc_nvo,$data->ef1_orden_ant,$data->ef1_desc_ant);
        $stmt1 = sqlsrv_query($conn,$tsql,$Params2);

        if($stmt1 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo 'Actualizado en Rango Cuentas';
        }

        $tsqli = "UPDATE Dim_EF6 SET EF6 = '{$EF1_Orden}', EF6_Desc = '{$ef1Desc}' WHERE id_ef6 = (?)";
        $Params1 = array($id_number);
        $stmt2 = sqlsrv_query($conn,$tsqli,$Params1);

        if($stmt2 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo 'Actualizado en EF2';
        }

        sqlsrv_close($conn);
        break;
    CASE "delete" :

        $Params = array($data->id);

        $query3="Delete From Dim_EF6 where id_ef6 = (?)";
        $stmt1 = sqlsrv_query($conn,$query3,$Params);

        if($stmt1 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo 'Eliminado en Rango Cuentas';
        }

        sqlsrv_close($conn);
        break;

}


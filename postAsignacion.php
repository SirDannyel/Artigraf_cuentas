<?php

include_once 'conexion.php';
include_once 'config.php';

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));

$filtro = $data->filtro;
$ef1 = $data->ef1;
$ef1Desc = $data->ef1desc;
$ef2 = $data->ef2;
$ef2Desc = $data->ef2desc;
$ef3 = $data->ef3;
$ef3Desc = $data->ef3desc;
$ef4 = $data->ef4;
$ef4Desc = $data->ef4desc;
$ef5 = $data->ef5;
$ef5Desc = $data->ef5desc;
$ef6 = $data->ef6;
$ef6Desc = $data->ef6desc;
$ef7 = $data->ef7;
$ef7Desc = $data->ef7desc;
$ef8 = $data->ef8;
$ef8Desc = $data->ef8desc;


$serverName = $conf['server'];
$connectionInfo = array("Database" => "DWH_Artigraf");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    echo "Could not connect.\n";
    die(print_r(sqlsrv_errors(), true));
}

/*------------------------------------------------------------------------------*/
/*-------INSERTAR O ACTUALIZAR SEGUN CORRESPONDA REGISTROS A TABLA ESPEJO-------*/

$tsqle = "SELECT CuentaB FROM DWH_Artigraf.dbo.CuentasAuto WHERE CuentaB = (?)";
$pa = array($filtro);

$stmt = sqlsrv_query($conn, $tsqle, $pa);

if ($stmt === false) {
    echo "Error in statement execution.\n";
} else {

    $actualizar = 0;
    while ($Response = sqlsrv_fetch_object($stmt)) {
        $actualizar = 1;
    }

    if ($actualizar === 1) {
        $tsqli = "UPDATE DWH_Artigraf.dbo.CuentasAuto   
                        SET EF1B = (?), EF1DescB = (?), EF2B = (?), EF2DescB = (?), EF3B = (?), EF3DescB = (?),
                        EF4B = (?), EF4DescB = (?), EF5B = (?), EF5DescB = (?), EF6B = (?), EF6DescB = (?),
                        EF7B = (?), EF7DescB = (?), EF8B = (?), EF8DescB = (?)    
                        WHERE CuentaB = (?)";

        $parametros = array($ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc,
            $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $ef8, $ef8Desc, $filtro);
    } else {
        $tsqli = "INSERT INTO DWH_Artigraf.dbo.CuentasAuto  
                        (CuentaB, EF1B, EF1DescB, EF2B, EF2DescB, EF3B, EF3DescB, EF4B, EF4DescB, 
                        EF5B, EF5DescB, EF6B, EF6DescB, EF7B, EF7DescB, EF8B, EF8DescB) VALUES 
                        ((?), (?), (?), (?), (?), (?), (?), (?), (?), 
                        (?), (?), (?), (?), (?), (?), (?), (?))";

        $parametros = array($filtro, $ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc,
            $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $ef8, $ef8Desc);
    }

    if (sqlsrv_query($conn, $tsqli, $parametros)) {
        echo "Statement executed new table.\n";
    } else {
        echo "Error in statement execution Insert.\n";
        die(print_r(sqlsrv_errors(), true));
    }
}

/* Free connection resources. */
sqlsrv_close($conn);



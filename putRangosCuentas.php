<?php

$conf = include('config.php');
$server  = $conf['server'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];
$dataBase = $conf['database'];


header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));

$conn = new PDO ("sqlsrv:server=$server;database=$dataBase",$UID,$PWD);
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

try {
    for ($i = 0; $i < COUNT($data); $i++) {

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

        $tsql = "UPDATE Dim_RangoCuentas   
            SET EF1 = (?), EF1Desc = (?), CuentaInicio = (?),CuentaFin = (?),
            Mayor = (?) ,Almacen = (?) ,Nivel1 = (?) ,Nivel2 = (?) , Nivel3 = (?), Nivel4 = (?), Nivel5 = (?),
            MayorFin = (?), AlmacenFin = (?) , Nivel1Fin = (?), Nivel2Fin = (?), Nivel3Fin = (?), Nivel4Fin = (?), Nivel5Fin = (?), 
            EF2 = (?), EF2Desc = (?), EF3 = (?), EF3Desc = (?),
            EF4 = (?), EF4Desc = (?), EF5 = (?), EF5Desc = (?), EF6 = (?), EF6Desc = (?),
            EF7 = (?), EF7Desc = (?), EF8 = (?), EF8Desc = (?), Orden = (?)
            WHERE RangoCuentas_id = (?)";

        $parametros = array($ef1, $ef1Desc, $cuentaInicio, $cuentaFin, $mayor, $almacen, $nivel1, $nivel2, $nivel3, $nivel4, $nivel5, $mayorFin, $almacenFin, $nivel1Fin, $nivel2Fin, $nivel3Fin, $nivel4Fin, $nivel5Fin, $ef2, $ef2Desc, $ef3, $ef3Desc, $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $ef8, $ef8Desc, $orden, $idRangos);
        $stmt2 = $conn->prepare($tsql);
        $stmt2->execute($parametros);

    }
    echo "Statement executed.\n";
} catch (Exception $e){
    die( print_r( $e->getMessage() ) );
}

unset($stmt2);
unset($conn);

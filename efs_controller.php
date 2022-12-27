<?php

$conf = include('config.php');
$server  = $conf['server'];

$serverName = $server;
$dataBase = "DWH_Artigraf";
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"));
$Tipo = $data->tipo;

    try {
        $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase",$UID,$PWD);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        die( print_r( $e->getMessage() ) );
    }


switch ($Tipo){

    CASE "insert":
        try {
            $Orden = $data->orden;
            $Desc = $data->desc;
            $tableName = $data->ef_table;
            $EF_Column = $data->ef_orden;
            $EF_Desc = $data->ef_desc;

            $query = "INSERT INTO $tableName ($EF_Column, $EF_Desc) VALUES ('{$Orden}','{$Desc}')";
            $stmt = $conn->query($query);
            //$lastRow = $conn->lastInsertId();

            //echo json_encode(["last_id" => $lastRow]);
            echo 'Agregado en EF';

            unset($stmt);
            unset($conn);
        }catch (Exception $e){
            die( print_r( $e->getMessage() ) );
        }

        break;
    CASE "update":
        try {

            $id_number = intval($data->id);
            $EF1_Orden = intval($data->ef1_orden_nvo);
            $ef1Desc = $data->ef1_desc_nvo;
            $EF_Column = $data->ef_orden;
            $EF_Desc = $data->ef_desc;
            $tableName = $data->ef_table;
            $EF_ID = $data->ef_id;

            if ($tableName === "EF1_Select") {
                $EF_DescRango = $data->efdesc;
                $tsql = "UPDATE Dim_RangoCuentas SET $EF_Column = (?), $EF_DescRango = (?) WHERE $EF_Column = (?) AND $EF_DescRango = (?)";
                $Params2 = array($data->ef1_orden_nvo, $data->ef1_desc_nvo, $data->ef1_orden_ant, $data->ef1_desc_ant);

                $stmt2 = $conn->prepare($tsql);
                $stmt2->execute($Params2);
                echo 'Actualizado en Rango Cuentas';

                unset($stmt2);
            } else {
                echo 'No es necesario actualizatr en Rangos';
            }

            $tsqli = "UPDATE $tableName SET $EF_Column = '{$EF1_Orden}', $EF_Desc = '{$ef1Desc}' WHERE $EF_ID = (?)";
            $Params1 = array($id_number);

            $stmt1 = $conn->prepare($tsqli);
            $stmt1->execute($Params1);
            unset($stmt1);

            echo 'Actualizado en EF';

            unset($conn);
        }catch (Exception $e){
            die( print_r( $e->getMessage() ) );
        }

        break;

    CASE "delete" :

        $tableName = $data->ef_table;
        $EF_ID = $data->ef_id;

        $Params = array($data->id);

        $query3="Delete From $tableName where $EF_ID = (?)";
        $stmt2 = $conn->prepare($query3);
        $stmt2->execute($Params);
        unset($stmt2);
        echo 'Eliminado en EF';

        if ($tableName === "EF1_Select") {
            $EF_Column = $data->ef_orden;
            $EF_DescRango = $data->efdesc;

            $tsql_Rango = "Delete From Dim_RangoCuentas WHERE $EF_Column = '{$data->ef1}' AND $EF_DescRango = '{$data->ef1_desc}'";
            $stmt_Rango = $conn->query($tsql_Rango);
            unset($stmt_Rango);
            echo 'Eliminado Rango Cuentas';

        } else{
            echo "No es necesario eliminar en rango cuentas" ;
        }

        unset($conn);

        break;


}

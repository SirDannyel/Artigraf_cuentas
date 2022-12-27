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

            $stmt4 = $conn->prepare($query4);
            $stmt4->execute($parametros);
            echo 'Registrado en RangosCuentas ';
            unset($stmt4);

            $query_EF1Select="Insert into EF1_Select (EF1,EF1_Desc) values ('{$ef1}','{$ef1Desc}')";
            $stmt = $conn->query($query_EF1Select);
            unset($stmt);

            echo 'Registrado en EF1_Select';
            unset($conn);

            break;

        case "getEFs":

            $table = $data->tabla;
            $column = $data->columna;


            $query = "SELECT * FROM $table order by $column";
            $stmts = $conn->query($query);
            $registros = $stmts->fetchAll(PDO::FETCH_OBJ);


            header_remove('Set-Cookie');
            $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
            if (is_array($httpHeaders) && count($httpHeaders)) {
                foreach ($httpHeaders as $httpHeader) {
                    header($httpHeader);
                }
            }

            echo json_encode($registros);

            unset($stmts);
            unset($conn);

            break;

        case "RangoInicio" :

            try {
                $query = "SELECT * FROM Dim_RangoCuentas order by Orden";
                $stmt = $conn->query($query);
                $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

                header_remove('Set-Cookie');
                $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
                if (is_array($httpHeaders) && count($httpHeaders)) {
                    foreach ($httpHeaders as $httpHeader) {
                        header($httpHeader);
                    }
                }

                echo json_encode($registros);

                unset($stmt);
                unset($conn);

            } catch (Exception $e) {
                echo "Ocurrio un error en la conexion. " . $e->getMessage();
            }

            break;
    }

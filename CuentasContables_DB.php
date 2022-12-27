<?php


function writeServerLog($msg)
{
    @error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

$conf = include('config.php');
$server  = $conf['server'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];
$dataBase = $conf['database'];

try {
    $conn = new PDO ("sqlsrv:server=$server;database=$dataBase",$UID,$PWD);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(Exception $e) {
    die( print_r( $e->getMessage() ) );
}

if($_POST['tipo'] === "getRubros"){

    $Respuesta = "";
    //$campo = "";
    switch ($_POST['nivel']) {
        case "MAYOR":
            $campo = 'MayorDesc';
            break;
        case "FIJO":
            $campo = 'FIJO';
            break;
        case "EF1":
            $campo = 'EF1Desc';
            break;
        case "EF2":
            $campo = 'EF2Desc';
            break;
        case "EF3":
            $campo = 'EF3Desc';
            break;
        case "EF4":
            $campo = 'EF4Desc';
            break;
        case "EF5":
            $campo = 'EF5Desc';
            break;
        case "EF6":
            $campo = 'EF6Desc';
            break;
        case "EF7":
            $campo = 'EF7Desc';
            break;
        case "EF8":
            $campo = "EF8Desc";
            break;
    }
    //echo $campo;
    if($campo == 'FIJO'){
        $Respuesta = '["FIJO"]';
        echo $Respuesta;
        return $Respuesta;
    }

    $sql="SELECT $campo from Dim_CuentaContable group by $campo order by 1" ;

    // SQL1
    if($sql <> ''){
        $stmt = $conn->query($sql);
        $Respuesta = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo json_encode($Respuesta);
    }

    return $Respuesta;
    unset($stmt);
    unset($conn);


}

?>
<?php

$conf = include('config.php');
$server  = $conf['server'];
$Database  = $conf['database'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];

try {
    $conn = new PDO ("sqlsrv:server=$server;database=$Database",$UID,$PWD);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(Exception $e) {
    die( print_r( $e->getMessage() ) );
}

$Respuesta = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    try {
        //Establecer Zona horaria
        date_default_timezone_set("America/Monterrey");
        $fecha = date("Y-m-d");
        $date1 = $_GET["fechaini"];
        $date2 = $_GET["fechafin"];
        //  echo $date;

        $query = "Select Fecha as fecha, CuentaContable as cuenta, Descripcion as descripcion, Cargo as cargo, Abono as abono, Movimiento as movimiento, Linea as linea from PartidasEspeciales where Fecha >= '{$date1}' and Fecha <= '{$date2}' order by Fecha,Linea Desc";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        header_remove('Set-Cookie');
        $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
        if (is_array($httpHeaders) && count($httpHeaders)) {

            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }

        }

        echo json_encode($result);

        unset($stmt);
        unset($conn);

    }catch (Exception $e){
        die( print_r( $e->getMessage() ) );
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Linea = $_POST['linea'];
    $query="Delete from PartidasEspeciales where Linea = $Linea ";

            $stmt1 = $conn->query($query);
            echo 'Partida borrada' ;
            unset($stmt1);

    $query3="Select * from Fact_Saldos where PartidasEsp = '1' and PartidaLinea = $Linea";

        $stmt3 = $conn->query($query3);
        $result = $stmt3->fetchAll(PDO::FETCH_OBJ);
        //var_dump($result);
        if(empty($result)) {
            echo 'Registro no existe';
        }else{

            $query2="Delete from Fact_Saldos where PartidasEsp = '1' and PartidaLinea = $Linea";
            $stmt2 = $conn->query($query2);
                echo 'Registro borrado Fact Saldos' ;
                unset($stmt2);
        }

   /* $sql4="update A
           set CuentaId = B.CuentaId
           from Fact_Saldos A
           inner join Dim_CuentaContable B
           on A.cuenta = B.Cuenta
           where A.CuentaId is null";
    $stmt7 = $conn->query($sql4);
    unset($stmt7);*/

    unset($conn);

}
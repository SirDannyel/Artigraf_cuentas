<?php


function writeServerLog($msg)
{
    @error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

$conf = include('config.php');
$serverName  = $conf['server'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];
$dataBase = $conf['database'];
writeServerLog('Tipo: - ' .$_POST['tipo'] );

$conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase",$UID,$PWD);
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

if($_POST['tipo'] === "get"){

    try {

        $Proceso = "Select Conceptos";
        $sql = "Select Descripcion,Orden,Rubro,Nivel,Naturaleza,Identado,Formato,Diferencia from EstadoFinanciero where EstadoFinanciero = '{$_POST['estado']}' order by Orden";

        writeServerLog('EjecutaSQL - ' . $Proceso);
        writeServerLog('Query: - ' . $sql);
        writeServerLog('param: - ' . $_POST['estado']);

        $stmt = $conn->query($sql);
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
    } catch (Exception $e){
        die( print_r( $e->getMessage() ) );
    }
}

if($_POST['tipo'] === "post"){
try {
    $Proceso = "Insert Concepto";
    $sql1 = "Insert into EstadoFinanciero (EstadoFinanciero,Orden,Rubro,Descripcion,Nivel,Naturaleza,Identado,Formato,Diferencia) values('{$_POST['estado']}','{$_POST['orden']}','{$_POST['rubro']}','{$_POST['desc']}','{$_POST['nivel']}','{$_POST['pasivo']}','{$_POST['identado']}','{$_POST['resaltado']}','{$_POST['saldo']}' ) ";

    writeServerLog('EjecutaSQL - ' . $Proceso . ' Query: - ' . $sql1);
    writeServerLog('params: - Estado: ' . $_POST['estado'] . ' orden: ' . $_POST['orden'] . ' rubro: ' . $_POST['rubro'] . ' desc: ' . $_POST['desc'] . ' nivel: ' . $_POST['nivel'] . ' pasivo: ' . $_POST['pasivo'] . ' identado: ' . $_POST['identado'] . ' resaltado: ' . $_POST['resaltado']);
    $stmt1 = $conn->query($sql1);
    echo 'Insertado';
    unset($stmt1);
    unset($conn);
} catch (Exception $e){
    die( print_r( $e->getMessage() ) );
}

}

if($_POST['tipo'] === "delete"){
    try {
        $Proceso = "Delete Concepto";
        $sql2 = "Delete from EstadoFinanciero where EstadoFinanciero = '{$_POST['estado']}' and Orden = '{$_POST['orden']}' and Descripcion = '{$_POST['desc']}' ";

        writeServerLog('EjecutaSQL - ' . $Proceso . ' Query: - ' . $sql2);
        writeServerLog('params: - Estado: ' . $_POST['estado'] . ' orden: ' . $_POST['orden'] . ' desc: ' . $_POST['desc']);
        $stmt2 = $conn->query($sql2);
        echo 'Eliminado';

        unset($stmt2);
        unset($conn);
    } catch (Exception $e){
        die( print_r( $e->getMessage() ) );
    }

}

if($_POST['tipo'] === "change"){

    $Proceso="Cambio Concepto";
    $sql3="Update EstadoFinanciero set Orden = 999 where EstadoFinanciero = '{$_POST['estado']}' and Orden = {$_POST['orden']}  ";
    $sql4="Update EstadoFinanciero set Orden = {$_POST['orden']} where EstadoFinanciero = '{$_POST['estado']}' and Orden = {$_POST['cambio']} ";
    $sql5="Update EstadoFinanciero set Orden = {$_POST['cambio']} where EstadoFinanciero = '{$_POST['estado']}' and Orden = 999 ";

    writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql3 );
    writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql4 );
    writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql5 );
    writeServerLog('params: - Estado: '.$_POST['estado'].' orden: '.$_POST['orden'].' cambio: '.$_POST['cambio']);

    $stmt3 = $conn->query($sql3);
    echo  'cambio 1' ;
    unset($stmt3);

    $stmt4 = $conn->query($sql4);
    echo  'cambio 2' ;
    unset($stmt4);

    $stmt5 = $conn->query($sql5);
    echo  'cambio 3' ;
    unset($stmt5);
    unset($conn);


}
?>
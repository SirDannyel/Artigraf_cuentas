<?php
/*
require_once('db.php');

//Conectar a la base:
$connec = OpenConnection();

//Validar coneccion
if ($connec === false){
    die( print_r( sqlsrv_errors(), true));
}

//Seleccionar Categorias de Partidas:
$tsql = "Select * FROM EstadoResultados";
$getPartidas = sqlsrv_query($connec, $tsql);

//Validar respuesta SQL
if( $getPartidas === false ) {
    die( print_r( sqlsrv_errors(), true));

}else{

    //Obtener un array con los registros.
     while( $row = sqlsrv_fetch_array( $getPartidas, SQLSRV_FETCH_ASSOC)) {
          echo $row['Descripcion'].", ".$row['Rubro']."<br />";
       }

    //Obtener un objeto con los registros.
    while( $obj = sqlsrv_fetch_object( $getPartidas)) {
        echo $obj->Descripcion."<br />";
    }
}
//Finalizar select
sqlsrv_free_stmt($getPartidas);

//Finalizar coneccion
sqlsrv_close($connec);*/

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $serverName = "DESKTOP-092HCCI";
        $username = "";
        $password = "";
        $dataBase = "DWH_Artigraf";

        try {
            $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase");
            //echo "Conexion con $serverName";
        } catch (Exception $e) {
            echo "Ocurrio un error en la conexion. " . $e->getMessage();
        }

        $query = "SELECT Cuenta,CuentaDesc,Mayor FROM Dim_CuentaContable";
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

    $serverName = "DESKTOP-092HCCI";
    $username = "";
    $password = "";
    $dataBase = "DWH_Artigraf";

    //Establecer Zona horaria
    date_default_timezone_set("America/Monterrey");
    $fecha = date("Y-m-d");
    $fecha_nueva = preg_replace('[-]', '', $fecha);
    //echo $fecha_nueva;
    $cargo = $_POST['cargo'];
    $abono = $_POST['abono'];
    $movimiento = $cargo - $abono;

    $sql="Insert into Fact_Saldos (Fecha,Cuenta,Descripcion,SaldoAnterior,Cargos,Abonos,Movimientos,SaldoFinal,Agrupador) values('{$fecha_nueva}','{$_POST['cuenta']}','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$movimiento}','0','0') ";
    $sql2="Insert into PartidasEspeciales (Id,Fecha,Mayor,CuentaContable,Monto) values('0','{$fecha}','{$_POST['mayor']}','{$_POST['cuenta']}','{$_POST['abono']}') ";

    $connectionInfo = array( "Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn === false ) {
        echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
    }

    if( $sql <> ''){
        $stmt = sqlsrv_query($conn, $sql);
        if($stmt === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo  'Insertado' ;
        }

    }

    if( $sql2 <> '' ){
        $stmt2 = sqlsrv_query($conn, $sql2);
        if($stmt2 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{
            echo  'Insertado' ;
        }

    }

    sqlsrv_close($conn);

    }
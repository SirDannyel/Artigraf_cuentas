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

$conf = include('config.php');

$server  = $conf['server'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];
$serverName = $server;
$dataBase = $conf['database'];

//Conexion a BD con PDO
try {
    $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase",$UID,$PWD);
    //echo "Conexion con $serverName";
} catch (Exception $e) {
    echo "Ocurrio un error en la conexion. " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        //Ejecutar Query
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
        unset($stmt);
        unset($conn);


    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header("Access-Control-Allow-Origin: *");

    //Establecer Zona horaria
    date_default_timezone_set("America/Monterrey");
    $fecha = date("Y-m-d");
    $fechayhora = date("Y-m-d H:i:s");
    $Post_Fecha = $_POST['fecha'];
    $fecha_nueva = preg_replace('[-]', '', $Post_Fecha);
   // echo $fecha_nueva;

    //Captar parametros recibidos
  //  $cargo = $_POST['cargo'];
  //  $abono = $_POST['abono'];
    //$movimiento = $cargo - $abono;

    //Ejecucion de insert a Partidas especiales

    //$sql2="Set nocount on; Insert into PartidasEspeciales (Id,Fecha,Mayor,CuentaContable,Monto,Descripcion,SaldoAnterior,Cargo,Abono,Movimiento,SaldoFinal) values('0','{$_POST['fecha']}','{$_POST['mayor']}','{$_POST['cuenta']}','0','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0'); SELECT @@IDENTITY as id; ";
    $sql2="Insert into PartidasEspeciales (Id,Fecha,Mayor,CuentaContable,Monto,Descripcion,SaldoAnterior,Cargo,Abono,Movimiento,SaldoFinal) values('0','{$_POST['fecha']}','{$_POST['mayor']}','{$_POST['cuenta']}','0','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0')";

        $stmt2 = $conn->query($sql2);
        $lastid = $conn->lastInsertId();
        $response = ["id"=>$lastid];

                         header_remove('Set-Cookie');
                         $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
                         if (is_array($httpHeaders) && count($httpHeaders)) {

                             foreach ($httpHeaders as $httpHeader) {
                                 header($httpHeader);
                             }

                         }

            echo json_encode($response);
            unset($stmt);

    //Ejecuccion de Insert a Fact Saldos

        //Validar si existe en BD la cuenta a insertar
        $cuenta_espacio = $_POST['cuenta'].' ';
       // echo $cuenta_espacio;
        $query3="Select * from Dim_CuentaContable where Cuenta = '$cuenta_espacio'";
        $stmt3 = $conn->query($query3);
        $existe = $stmt3->fetchAll(PDO::FETCH_OBJ);

            if(empty($existe)) {
                //echo 'Registro no existe';
                //Si no existe Insertar la Cuenta
                $query4="Insert into Dim_CuentaContable (Cuenta,CuentaDesc,Mayor) values ('{$_POST['cuenta']}','{$_POST['descripcion']}','{$_POST['mayor']}')";
                $stmt4 = $conn->query($query4);
                unset($stmt4);

                //Seguido insertar en fact saldos
                $sql2="Insert into Fact_Saldos (Fecha,Cuenta,Descripcion,SaldoAnterior,Cargos,Abonos,Movimientos,SaldoFinal,Agrupador,PartidasEsp,PartidaLinea) values('{$fecha_nueva}','{$_POST['cuenta']}','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0','0','1','{$lastid}') ";
                $stmt5 = $conn->query($sql2);
                unset($stmt5);

            } else {
            //Si no insertar directo:
                    $sql3="Insert into Fact_Saldos (Fecha,Cuenta,Descripcion,SaldoAnterior,Cargos,Abonos,Movimientos,SaldoFinal,Agrupador,PartidasEsp,PartidaLinea) values('{$fecha_nueva}','{$_POST['cuenta']}','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0','0','1','{$lastid}') ";
                    $stmt6 = $conn->query($sql3);
                    unset($stmt6);
            }

                    unset($conn);


    }
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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        //Conexion a BD con PDO
        $serverName = $server;
        $username = "";
        $password = "";
        $dataBase = "DWH_Artigraf";

        try {
            $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase");
            //echo "Conexion con $serverName";
        } catch (Exception $e) {
            echo "Ocurrio un error en la conexion. " . $e->getMessage();
        }

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

        //Salir
        exit();

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header("Access-Control-Allow-Origin: *");

    //Datos de BD
    $serverName = $server;
    $username = "";
    $password = "";
    $dataBase = "DWH_Artigraf";

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

    //Conexion mediante driver sqlsrv
    $connectionInfo = array( "Database"=>$dataBase);
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn === false ) {
        echo "Conexión no se pudo establecer.";
        die( print_r( sqlsrv_errors(), true));
    }

    //Ejecucion de insert a Partidas especiales

    $sql2="Set nocount on; Insert into PartidasEspeciales (Id,Fecha,Mayor,CuentaContable,Monto,Descripcion,SaldoAnterior,Cargo,Abono,Movimiento,SaldoFinal) values('0','{$_POST['fecha']}','{$_POST['mayor']}','{$_POST['cuenta']}','0','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0'); SELECT @@IDENTITY as id; ";
    $row = [];
        $stmt2 = sqlsrv_query($conn, $sql2);

        if($stmt2 === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{

             $Response = sqlsrv_fetch_object($stmt2);
             $Respuesta[0] = $Response;
             //echo $row["id"];

                         header_remove('Set-Cookie');
                         $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
                         if (is_array($httpHeaders) && count($httpHeaders)) {

                             foreach ($httpHeaders as $httpHeader) {
                                 header($httpHeader);
                             }

                         }

             echo json_encode($Respuesta);
        }

    //Ejecuccion de Insert a Fact Saldos

        //Validar si existe en BD la cuenta a insertar
        $cuenta_espacio = $_POST['cuenta'].' ';
       // echo $cuenta_espacio;
        $query3="Select * from Dim_CuentaContable where Cuenta = '$cuenta_espacio'";
        $stmt3 = sqlsrv_query($conn, $query3);

            $actualizar = 0;
            while ($Response1 = sqlsrv_fetch_object($stmt3)) {
                $actualizar = 1;
            }

            if($actualizar === 0) {
                //echo 'Registro no existe';
                //Si no existe Insertar la Cuenta
                $query4="Insert into Dim_CuentaContable (Cuenta,CuentaDesc,Mayor) values ('{$_POST['cuenta']}','{$_POST['descripcion']}','{$_POST['mayor']}')";
                $stmt4 = sqlsrv_query($conn, $query4);

                if($stmt4 === false) {
                    die( print_r( sqlsrv_errors(), true));
                }else{
                    //echo 'Registrado en Cuentas Contables';
                }
                    //Seguido insertar en fact saldos
                    $sql="Insert into Fact_Saldos (Fecha,Cuenta,Descripcion,SaldoAnterior,Cargos,Abonos,Movimientos,SaldoFinal,Agrupador,PartidasEsp,PartidaLinea) values('{$fecha_nueva}','{$_POST['cuenta']}','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0','0','1','{$Response->id}') ";

                        $stmt = sqlsrv_query($conn, $sql);
                        if($stmt === false) {
                            die( print_r( sqlsrv_errors(), true));
                        }else{
                            //echo  'Insertado' ;
                        }

            }else{
            //Si no insertar directo:
                    $sql="Insert into Fact_Saldos (Fecha,Cuenta,Descripcion,SaldoAnterior,Cargos,Abonos,Movimientos,SaldoFinal,Agrupador,PartidasEsp,PartidaLinea) values('{$fecha_nueva}','{$_POST['cuenta']}','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$_POST['mov']}','0','0','1','{$Response->id}') ";

                    $stmt = sqlsrv_query($conn, $sql);
                    if($stmt === false) {
                        die( print_r( sqlsrv_errors(), true));
                    }else{
                        //echo  'Insertado' ;
                    }

            }




    //Desconectar servicio
    sqlsrv_close($conn);

    }
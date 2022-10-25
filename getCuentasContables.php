<?php


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  include_once 'conexion.php';

  $Parametro = $_GET['filtro'];
  $cantidad = 0;
  $query = "SELECT Cuenta, CuentaDesc, EF1, EF1Desc, EF2, EF2Desc, EF3, EF3Desc, EF4, EF4Desc, EF5, EF5Desc, EF6, EF6Desc, EF7, EF7Desc 
  FROM DWH_Artigraf.dbo.Dim_CuentaContable WHERE Cuenta LIKE '$Parametro'";
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


        //Captar parametros recibidos
        $cuenta =  $_POST['Cuenta'];
        $ef1 = $_POST['ef1'];
        $ef1Desc = $_POST['ef1desc'];
        $ef2 = $_POST['ef2'];
        $ef2Desc = $_POST['ef2desc'];
        $ef3 = $_POST['ef3'];
        $ef3Desc = $_POST['ef3desc'];
        $ef4 = $_POST['ef4'];
        $ef4Desc = $_POST['ef4desc'];
        $ef5 = $_POST['ef5'];
        $ef5Desc = $_POST['ef5desc'];
        $ef6 = $_POST['ef6'];
        $ef6Desc = $_POST['ef6desc'];
        $ef7 = $_POST['ef7'];
        $ef7Desc = $_POST['ef7desc'];
        

        //Realizar conexión a BD
        include_once 'conexion.php';

        //$sql="Insert into Fact_Saldos (Fecha,Cuenta,Descripcion,SaldoAnterior,Cargos,Abonos,Movimientos,SaldoFinal,Agrupador) values('{$fecha_nueva}','{$_POST['cuenta']}','{$_POST['descripcion']}','0','{$_POST['cargo']}','{$_POST['abono']}','{$movimiento}','0','0') "; 
        //Solicitud de actualización
        $sql = " UPDATE DWH_Artigraf.dbo.Dim_CuentaContable SET EF1 = $ef1, EF1Desc = '$ef1Desc', 
        EF2 = '$ef2', EF2Desc = '$ef2Desc', EF3 = '$ef3', EF3Desc = '$ef3Desc', EF4 = '$ef4', EF4Desc = '$ef4Desc', 
        EF5 = '$ef5', EF5Desc = '$ef5Desc', EF6 = '$ef6', EF6Desc = '$ef6Desc', EF7 = '$ef7', EF7Desc = '$ef7Desc'
        WHERE Cuenta = $cuenta";


        if( $sql <> ''){
            echo 'sql';
            $stmt = sqlsrv_query($conn, $sql);
            if($stmt === false) {
                die( print_r( sqlsrv_errors(), true));
            }else{
                echo  'Actualizado' ;
            }
    
        }
    
    }
?>
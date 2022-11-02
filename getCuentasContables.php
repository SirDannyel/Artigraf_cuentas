<?php

include_once 'conexion.php';
include_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $serverName = $conf['server'];
    $connectionInfo = array("Database"=>"DWH_Artigraf");  
    $conn = sqlsrv_connect($serverName, $connectionInfo);  
    if ($conn === false) {
        echo "Could not connect.\n";  
        die(print_r(sqlsrv_errors(), true));  
    } else {

        $Parametro = $_GET['filtro'];
        $query = "SELECT Cuenta, CuentaDesc, EF1, EF1Desc, EF2, EF2Desc, EF3, EF3Desc, EF4, EF4Desc, EF5, EF5Desc, EF6, EF6Desc, EF7, EF7Desc, EF8, EF8Desc
        FROM DWH_Artigraf.dbo.Dim_CuentaContable WHERE Cuenta LIKE '$Parametro'";
        $stmt = sqlsrv_query($conn, $query);

        if($stmt === false) {
            die( print_r( sqlsrv_errors(), true));
        }else{

            $cantidad = 0;
            while($Response = sqlsrv_fetch_object($stmt)) {

                $registros [$cantidad] = $Response;
                $cantidad = $cantidad + 1;

            }

        header_remove('Set-Cookie');
        $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
        if (is_array($httpHeaders) && count($httpHeaders)) {
          foreach ($httpHeaders as $httpHeader) {
              header($httpHeader);
          }
        }

      echo json_encode($registros);
        
        }
    //Desconectar servicio
    sqlsrv_close($conn);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $serverName = $conf['server'];
            $connectionInfo = array("Database" => "DWH_Artigraf");
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            if ($conn === false) {
                echo "Could not connect.\n";
                die(print_r(sqlsrv_errors(), true));
            }

            header("Content-Type: application/json");
            $data = json_decode(file_get_contents("php://input"));

            for ($i = 0; $i < count($data); $i++) {
                $cuenta = $data[$i]->Cuenta;
                $cuentadesc = $data[$i]->CuentaDesc;
                $ef1 = $data[$i]->EF1;
                $ef1Desc = $data[$i]->EF1Desc;
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

                /*-------------------ACTUALIZAR TABLA DE DIM_CUENTACONTABLES-------------------*/
                /* Set up the parameterized query. */

                $tsql = "UPDATE DWH_Artigraf.dbo.Dim_CuentaContable   
            SET EF1 = (?), EF1Desc = (?), EF2 = (?), EF2Desc = (?), EF3 = (?), EF3Desc = (?),
            EF4 = (?), EF4Desc = (?), EF5 = (?), EF5Desc = (?), EF6 = (?), EF6Desc = (?),
            EF7 = (?), EF7Desc = (?), EF8 = (?), EF8Desc = (?)
            WHERE Cuenta = (?)";


                /* Assign literal parameter values. */

                $params = array($ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc, $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $ef8, $ef8Desc, $cuenta);

                /* Execute the query. */

                if (sqlsrv_query($conn, $tsql, $params)) {
                    echo "Statement executed.\n";
                } else {
                    echo "Error in statement execution.\n";
                    die(print_r(sqlsrv_errors(), true));
                }
                /*------------------------------------------------------------------------------*/
            }

            $cierre = sqlsrv_close($conn);

}
?>
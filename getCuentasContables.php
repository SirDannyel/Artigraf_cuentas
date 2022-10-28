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
        $query = "SELECT Cuenta, CuentaDesc, EF1, EF1Desc, EF2, EF2Desc, EF3, EF3Desc, EF4, EF4Desc, EF5, EF5Desc, EF6, EF6Desc, EF7, EF7Desc 
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
        $connectionInfo = array("Database"=>"DWH_Artigraf");  
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

            /*-------------------ACTUALIZAR TABLA DE DIM_CUENTACONTABLES-------------------*/
            /* Set up the parameterized query. */  
            
            $tsql = "UPDATE DWH_Artigraf.dbo.Dim_CuentaContable   
            SET EF1 = (?), EF1Desc = (?), EF2 = (?), EF2Desc = (?), EF3 = (?), EF3Desc = (?),
            EF4 = (?), EF4Desc = (?), EF5 = (?), EF5Desc = (?), EF6 = (?), EF6Desc = (?),
            EF7 = (?), EF7Desc = (?)    
            WHERE Cuenta = (?)";
            

            /* Assign literal parameter values. */ 
           
            $params = array($ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc, $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $cuenta); 
            
             /* Execute the query. */  
             
            if (sqlsrv_query($conn, $tsql, $params)) {  
                echo "Statement executed.\n";  
            } else {  
                echo "Error in statement execution.\n";  
                die(print_r(sqlsrv_errors(), true));  
            }

            /*------------------------------------------------------------------------------*/
            /*-------INSERTAR O ACTUALIZAR SEGUN CORRESPONDA REGISTROS A TABLA ESPEJO-------*/
            
            $tsqle = "SELECT CuentaB FROM DWH_Artigraf.dbo.CuentasAuto WHERE CuentaB = (?)";
            $pa = array($cuenta);

            $stmt = sqlsrv_query($conn, $tsqle, $pa);

            if ($stmt === false) {
                echo "Error in statement execution.\n"; 
            } else {
                $actualizar = 0;
                while( $Response = sqlsrv_fetch_object( $stmt)) {
                    $actualizar = 1; 
                    } 
                    
                    if ( $actualizar === 1) {
                        $tsqli = "UPDATE DWH_Artigraf.dbo.CuentasAuto   
                        SET EF1B = (?), EF1DescB = (?), EF2B = (?), EF2DescB = (?), EF3B = (?), EF3DescB = (?),
                        EF4B = (?), EF4DescB = (?), EF5B = (?), EF5DescB = (?), EF6B = (?), EF6DescB = (?),
                        EF7B = (?), EF7DescB = (?)    
                        WHERE CuentaB = (?)";
    
                        $parametros = array($ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc, 
                        $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $cuenta);
                    } else {
                        $tsqli = "INSERT INTO DWH_Artigraf.dbo.CuentasAuto  
                        (CuentaB, CuentaDescB, EF1B, EF1DescB, EF2B, EF2DescB, EF3B, EF3DescB, EF4B, EF4DescB, 
                        EF5B, EF5DescB, EF6B, EF6DescB, EF7B, EF7DescB) VALUES 
                        ((?), (?), (?), (?), (?), (?), (?), (?), (?), (?), 
                        (?), (?), (?), (?), (?), (?))";
    
                        $parametros = array($cuenta,$cuentadesc ,$ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc, 
                        $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc);
                    }
    
                    if (sqlsrv_query($conn, $tsqli, $parametros)) {  
                        echo "Statement executed new table.\n";  
                    } else {  
                        echo "Error in statement execution Insert.\n";  
                        die(print_r(sqlsrv_errors(), true));  
                    }  

                }

            }
            
         /* Free connection resources. */  
         sqlsrv_close($conn); 

        }

    
?>
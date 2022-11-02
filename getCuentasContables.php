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
        $connectionInfo = array("Database"=>"DWH_Artigraf");  
        $conn = sqlsrv_connect($serverName, $connectionInfo);  
        if ($conn === false) {  
            echo "Could not connect.\n";  
            die(print_r(sqlsrv_errors(), true));  
        }  
        
        $cta = $_GET['cta'];
        $ef1s = $_GET['ef1s'];
        $ef1descs = $_GET['ef1descs'];
        $ef2s = $_GET['ef2s'];
        $ef2descs = $_GET['ef2descs'];
        $ef3s = $_GET['ef3s'];
        $ef3descs = $_GET['ef3descs'];
        $ef4s = $_GET['ef4s'];
        $ef4descs = $_GET['ef4descs'];
        $ef5s = $_GET['ef5s']; 
        $ef5descs = $_GET['ef5descs'];
        $ef6s = $_GET['ef6s'];
        $ef6descs = $_GET['ef6descs'];
        $ef7s = $_GET['ef7s'];
        $ef7descs = $_GET['ef7descs'];
        $ef8s = $_GET['ef8s'];
        $ef8descs = $_GET['ef8descs'];
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
            
         /* Free connection resources. */  
         sqlsrv_close($conn); 

        }

         /*-------INSERTAR O ACTUALIZAR SEGUN CORRESPONDA REGISTROS A TABLA ESPEJO-------*/
            
         $tsqle = "SELECT CuentaB FROM DWH_Artigraf.dbo.CuentasAuto WHERE CuentaB = (?)";
         $pa = array($cta);
         //echo "Error in statement execution Insert.\n";

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
                     EF7B = (?), EF7DescB = (?), EF8B = (?), EF8DescB = (?)    
                     WHERE CuentaB = (?)";
 
                     $parametros = array($ef1s, $ef1descs, $ef2s, $ef2descs, $ef3s, $ef3descs, 
                     $ef4s, $ef4descs, $ef5s, $ef5descs, $ef6s, $ef6descs, $ef7s, $ef7descs, $ef8s, $ef8descs, $cta);
                 } else {
                     $tsqli = "INSERT INTO DWH_Artigraf.dbo.CuentasAuto  
                     (CuentaB, EF1B, EF1DescB, EF2B, EF2DescB, EF3B, EF3DescB, EF4B, EF4DescB, 
                     EF5B, EF5DescB, EF6B, EF6DescB, EF7B, EF7DescB, EF8B, EF8DescB, ) VALUES 
                     ((?), (?), (?), (?), (?), (?), (?), (?), (?), 
                     (?), (?), (?), (?), (?), (?), (?), (?))";
 
                     $parametros = array($cta, $ef1s, $ef1descs, $ef2s, $ef2descs, $ef3s, $ef3descs, 
                     $ef4s, $ef4descs, $ef5s, $ef5descs, $ef6s, $ef6descs, $ef7s, $ef7descs, $ef8s, $ef8descs);
                 }
 
                 if (sqlsrv_query($conn, $tsqli, $parametros)) {  
                     echo "Statement executed new table.\n";  
                 } else {  
                     echo "Error in statement execution INPUT.\n";  
                     die(print_r(sqlsrv_errors(), true));  
                 }  

             }
    }
    
?>
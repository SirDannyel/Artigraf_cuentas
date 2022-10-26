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

        $serverName = ("LAPTOP-SPVHJIUH\SQLEXPRESS");  
        $connectionInfo = array("Database"=>"DWH_Artigraf");  
        $conn = sqlsrv_connect($serverName, $connectionInfo);  
        if ($conn === false) {  
            echo "Could not connect.\n";  
            die(print_r(sqlsrv_errors(), true));  
        }  
        
        $cuenta =  $_POST['cuenta']; 

         //Captar parametros recibidos
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

        foreach ($cuenta as $valor){
            //var_dump($valor);

            /* Set up the parameterized query. */  
            $tsql = "UPDATE DWH_Artigraf.dbo.Dim_CuentaContable   
            SET EF1 = (?), EF1Desc = (?), EF2 = (?), EF2Desc = (?), EF3 = (?), EF3Desc = (?),
            EF4 = (?), EF4Desc = (?), EF5 = (?), EF5Desc = (?), EF6 = (?), EF6Desc = (?),
            EF7 = (?), EF7Desc = (?)    
            WHERE Cuenta = (?)";

            /* Assign literal parameter values. */  
            $params = array($ef1, $ef1Desc, $ef2, $ef2Desc, $ef3, $ef3Desc, $ef4, $ef4Desc, $ef5, $ef5Desc, $ef6, $ef6Desc, $ef7, $ef7Desc, $valor); 
  
             /* Execute the query. */  
            if (sqlsrv_query($conn, $tsql, $params)) {  
                echo "Statement executed.\n";  
            } else {  
                echo "Error in statement execution.\n";  
                die(print_r(sqlsrv_errors(), true));  
            }  

        }
        
       
        
        /* Free connection resources. */  
        sqlsrv_close($conn);  
    
    }
?>
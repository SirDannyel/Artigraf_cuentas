<?php

function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

writeServerLog('Tipo: - ' .$_POST['tipo'] );

$conf = include('config.php');
 
$server  = $conf['server']; 
switch ($_POST['tipo']) {
    case "get": 
            $Respuesta;

            $Proceso="Select Estados";
            $sql="Select Estado from Dim_Estado order by 1"; 
            writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );   
            
              //  $server = 'DESKTOP-907DBP9\SQLEXPRESS';
                $connectionInfo = array( "Database"=>"DWH_Artigraf");
            $conn = sqlsrv_connect( $server, $connectionInfo);

            if( $conn === false ) { 
                echo "Conexión no se pudo establecer.";
                die( print_r( sqlsrv_errors(), true));
            }

        // SQL1 
        if($sql <> ''){ 
            $stmt = sqlsrv_query($conn, $sql);  
            if( $stmt === false ) {   
                writeServerLog(sqlsrv_errors()); 
                die( print_r( sqlsrv_errors(), true));   
            }else{
                $EstadosCount = 0;  
                    
                while($row = sqlsrv_fetch_array($stmt))
                {
                    $Respuesta[$EstadosCount] = $row['Estado']; 
                    $EstadosCount++;
                }
                
                echo  '["' . implode('", "', $Respuesta) . '"]';
                writeServerLog('["' . implode('", "', $Respuesta) . '"]');
            }
            
        } 

        $cierre = sqlsrv_close($conn); 

        break;
    case "post": 
            $Respuesta; 
            $Proceso="Insert Estado";
            $sql="Insert into Dim_Estado (Estado) values( '{$_POST['estado']}')"; 
            writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );   
            
            //  $server = 'DESKTOP-907DBP9\SQLEXPRESS';
                $connectionInfo = array( "Database"=>"DWH_Artigraf");
            $conn = sqlsrv_connect( $server, $connectionInfo);

            if( $conn === false ) { 
                echo "Conexión no se pudo establecer.";
                die( print_r( sqlsrv_errors(), true));
            }

        // SQL1 
        if($sql <> ''){ 
            $stmt = sqlsrv_query($conn, $sql);  
            if( $stmt === false ) {   
                writeServerLog(sqlsrv_errors()); 
                die( print_r( sqlsrv_errors(), true));   
            }else{
                echo  'True' ; 
            }
            
        } 

        $cierre = sqlsrv_close($conn); 
        break;
    case "update":
        echo "update";
        break;
}
	
 
 

?>
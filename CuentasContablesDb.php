<?php
 
  
function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

$conf = include('config.php');
$server  = $conf['server'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];

 
writeServerLog('Tipo:' .$_POST['tipo'] );   

if($_POST['tipo'] === "getRubros"){  
    writeServerLog('Nivel: - ' .$_POST['nivel'] );
 
    $Respuesta;
		$Proceso="Select Rubros";
     $campo;   
    switch ($_POST['nivel']) {
        case "MAYOR": 
            $campo = 'MayorDesc';    
            break;
        case "FIJO": 
            $campo = 'FIJO';   
            break; 
        case "EF1": 
            $campo = 'EF1Desc';   
            break; 
        case "EF2": 
            $campo = 'EF2Desc';   
            break; 
        case "EF3": 
            $campo = 'EF3Desc';   
            break; 
        case "EF4": 
            $campo = 'EF4Desc';   
            break; 
        case "EF5": 
            $campo = 'EF5Desc';   
            break; 
        case "EF6": 
            $campo = 'EF6Desc';   
            break; 
        case "EF7": 
            $campo = 'EF7Desc';   
            break;
        case "EF8": 
            $campo = 'EF8Desc';   
            break;
        }

        if($campo == 'FIJO'){
            $Respuesta = '["FIJO"]';
            echo $Respuesta;
            return $Respuesta;
        }

		$sql="Select ".$campo." from Dim_CuentaContable group by ".$campo." order by 1" ;  
	
			 writeServerLog('EjecutaSQL - ' .$Proceso ); 
			 writeServerLog('Query: - ' .$sql );   
			  
				//$connectionInfo = array( "Database"=>"DWH_Artigraf");
                $connectionInfo = array("Database"=>$dataBase, "UID"=>$UID, "PWD"=>$PWD);
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
	
                    $RubrosCount = 0;   
                    while($row = sqlsrv_fetch_array($stmt))
                    {
                        $Respuesta[$RubrosCount] = $row[$campo]; 
                        $RubrosCount++;
                    }
                    
                    echo  '["' . implode('", "', $Respuesta) . '"]';
                    writeServerLog('["' . implode('", "', $Respuesta) . '"]');
				 
				}
			 
			}
		 
		return $Respuesta;
	 
	$cierre = sqlsrv_close($conn); 
	 
} 
 
?>
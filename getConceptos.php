<?php

// global $Repuesta;
  
function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}
 
$Conceptos  = EjecutaSQL("Select Conceptos", "Select * from EstadoResultados where EstadoResultados = '{$_POST['estado']}' order by Orden");

function EjecutaSQL($Proceso= '',$sql= '')
{   
	$Respuesta = '[';

	 	writeServerLog('EjecutaSQL - ' .$Proceso ); 
	 	writeServerLog('Query: - ' .$sql ); 
	 	writeServerLog('param: - ' .$_POST['estado'] ); 
 
		 
		  	$serverName = 'DESKTOP-907DBP9\SQLEXPRESS';
		  	$connectionInfo = array( "Database"=>"DWH_Artigraf");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);

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

                while( $Response = sqlsrv_fetch_object( $stmt)) {
                    $Respuesta = $Respuesta.'{"Descripcion": "'.$Response->Descripcion.'","Orden": "'.$Response->Orden.'","Rubro": "'.$Response->Rubro.'","Nivel": "'.$Response->Nivel.'","Naturaleza": "'.$Response->Naturaleza.'"},';
              } 

              $Respuesta = substr($Respuesta,0,strlen($Respuesta)-1).']';

              writeServerLog($Respuesta ); 
              echo   $Respuesta ;
                /*
				$ConceptosCount = 0;  
				  
				while($row = sqlsrv_fetch_array($stmt))
				{
                    $Respuesta[] = $row; 
					$ConceptosCount++;
				}
				
			//	echo  '["' . implode('", "', $Respuesta) . '"]';
				writeServerLog($Respuesta ); 
				echo  json_decode($Respuesta) ;
                 */
			}
		 
		}
	 
	return $Respuesta;
 
$cierre = sqlsrv_close($conn); 

} 
  

?>
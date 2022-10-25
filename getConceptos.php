<?php

// global $Repuesta;
  
function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}
 
$Conceptos  = EjecutaSQL("Select Conceptos", "Select * from EstadoResultados");

function EjecutaSQL($Proceso= '',$sql= '')
{   
	$Respuesta = '[';

	 	writeServerLog('EjecutaSQL - ' .$Proceso ); 
	 	writeServerLog('Query: - ' .$sql ); 
	 	//writeServerLog('param: - ' .$_POST['estado'] );
 
		 
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
                    $Respuesta = $Respuesta.'{"Descripcion": "'.$Response->Descripcion.'","Orden": "'.$Response->Orden.'","Rubro": "'.$Response->Rubro.'","Nivel": "'.$Response->Nivel.'","Naturaleza": "'.$Response->Naturaleza.'","Identado": "'.$Response->Identado.'","Formato": "'.$Response->Formato.'"},';
              } 

              $Respuesta = substr($Respuesta,0,strlen($Respuesta)-1).']';
              if($Respuesta === ']'){
                echo  'Sin resultados' ;
              }else{
                echo  $Respuesta ;
              }

              writeServerLog($Respuesta ); 
             
			}
		 
		}
	 
	return $Respuesta;
 
$cierre = sqlsrv_close($conn); 

} 
  

?>
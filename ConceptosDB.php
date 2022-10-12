<?php
 
  
function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

writeServerLog('Tipo: - ' .$_POST['tipo'] );

if($_POST['tipo'] === "get"){
	writeServerLog('Get  - entra'   ); 
 
		$Proceso="Select Conceptos";
		$sql="Select * from EstadoResultados where EstadoResultados = '{$_POST['estado']}' order by Orden";
		writeServerLog('Get  - entra2'   );
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

if($_POST['tipo'] === "post"){
   
		$Proceso="Insert Concepto";
		$sql="Insert into EstadoResultados (EstadoResultados,Orden,Rubro,Descripcion,Nivel,Naturaleza,Identado,Formato) values('{$_POST['estado']}','{$_POST['orden']}','{$_POST['rubro']}','{$_POST['desc']}','{$_POST['nivel']}','{$_POST['pasivo']}','{$_POST['identado']}','{$_POST['resaltado']}' ) ";
		 
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );  
			 writeServerLog('params: - Estado: '.$_POST['estado'].' orden: '.$_POST['orden'].' rubro: '.$_POST['rubro'].' desc: '.$_POST['desc'].' nivel: '.$_POST['nivel'].' pasivo: '.$_POST['pasivo'].' identado: '.$_POST['identado'].' resaltado: '.$_POST['resaltado'] ); 
			 
				  $serverName = 'DESKTOP-907DBP9\SQLEXPRESS';
				  $connectionInfo = array( "Database"=>"DWH_Artigraf");
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
				if( $conn === false ) { 
					echo "Conexión no se pudo establecer.";
					die( print_r( sqlsrv_errors(), true));
				}
	 
			if($sql <> ''){ 
				$stmt = sqlsrv_query($conn, $sql);  
				if( $stmt === false ) {   
					writeServerLog(sqlsrv_errors()); 
					die( print_r( sqlsrv_errors(), true));   
				}else{  
					echo  'Insertado' ; 
				}
			 
			}
		  
	 
		$cierre = sqlsrv_close($conn); 
	
	}  

	if($_POST['tipo'] === "delete"){
   
		$Proceso="Delete Concepto";
		$sql="Delete from EstadoResultados where EstadoResultados = '{$_POST['estado']}' and Orden = '{$_POST['orden']}' ";
		 
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );  
			 writeServerLog('params: - Estado: '.$_POST['estado'].' orden: '.$_POST['orden']); 
			 
				  $serverName = 'DESKTOP-907DBP9\SQLEXPRESS';
				  $connectionInfo = array( "Database"=>"DWH_Artigraf");
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
				if( $conn === false ) { 
					echo "Conexión no se pudo establecer.";
					die( print_r( sqlsrv_errors(), true));
				}
	 
			if($sql <> ''){ 
				$stmt = sqlsrv_query($conn, $sql);  
				if( $stmt === false ) {   
					writeServerLog(sqlsrv_errors()); 
					die( print_r( sqlsrv_errors(), true));   
				}else{  
					echo  'Eliminado' ; 
				}
			 
			}
		  
	 
		$cierre = sqlsrv_close($conn); 
	
	} 
?>
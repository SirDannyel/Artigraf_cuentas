<?php
 
  
function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}

$conf = include('config.php'); 
$serverName  = $conf['server'];
$Database  = $conf['database'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];
writeServerLog('Tipo: - ' .$_POST['tipo'] );

if($_POST['tipo'] === "get"){ 
 
		$Proceso="Login";


		$sql="Select Username from Usuario Where Username = '{$_POST['user']}' and Password = '{$_POST['pass']}'  "; 
		$Respuesta = '';
	
			 writeServerLog('EjecutaSQL - ' .$Proceso ); 
			 writeServerLog('Query: - ' .$sql ); 
			 writeServerLog('param: - ' .$_POST['user'] ); 
	 
			  
				  //$connectionInfo = array( "Database"=>"DWH_Artigraf");
                $connectionInfo = array( "Database"=>$Database, "UID"=>$UID, "PWD"=>$PWD);
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
						$Respuesta = $Response->Username;
				  } 
	 
				  if($Respuesta === ''){
				//	echo  'El usuario y/o el password no son correctos' ;
					echo  'Error' ;
				  }else{
					echo  $Respuesta ;
				  }
	
				  writeServerLog($Respuesta ); 
				 
				}
			 
			}
		 
		return $Respuesta;
	 
	$cierre = sqlsrv_close($conn); 
	 
}
/*
if($_POST['tipo'] === "post"){
   
		$Proceso="Insert Concepto";
		$sql="Insert into EstadoResultados (EstadoResultados,Orden,Rubro,Descripcion,Nivel,Naturaleza,Identado,Formato) values('{$_POST['estado']}','{$_POST['orden']}','{$_POST['rubro']}','{$_POST['desc']}','{$_POST['nivel']}','{$_POST['pasivo']}','{$_POST['identado']}','{$_POST['resaltado']}' ) ";
		 
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );  
			 writeServerLog('params: - Estado: '.$_POST['estado'].' orden: '.$_POST['orden'].' rubro: '.$_POST['rubro'].' desc: '.$_POST['desc'].' nivel: '.$_POST['nivel'].' pasivo: '.$_POST['pasivo'].' identado: '.$_POST['identado'].' resaltado: '.$_POST['resaltado'] ); 
			  
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
		$sql="Delete from EstadoResultados where EstadoResultados = '{$_POST['estado']}' and Orden = '{$_POST['orden']}' and Descripcion = '{$_POST['desc']}' ";
		 
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );  
			 writeServerLog('params: - Estado: '.$_POST['estado'].' orden: '.$_POST['orden'].' desc: '.$_POST['desc']); 
			  
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
	
	if($_POST['tipo'] === "change"){
   
		$Proceso="Cambio Concepto";
		$sql="Update EstadoResultados set Orden = 999 where EstadoResultados = '{$_POST['estado']}' and Orden = {$_POST['orden']}  "; 
		$sql2="Update EstadoResultados set Orden = {$_POST['orden']} where EstadoResultados = '{$_POST['estado']}' and Orden = {$_POST['cambio']} "; 
		$sql3="Update EstadoResultados set Orden = {$_POST['cambio']} where EstadoResultados = '{$_POST['estado']}' and Orden = 999 "; 
		 
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql );  
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql2 ); 
			 writeServerLog('EjecutaSQL - ' .$Proceso.' Query: - ' .$sql3 ); 
			 writeServerLog('params: - Estado: '.$_POST['estado'].' orden: '.$_POST['orden'].' cambio: '.$_POST['cambio']); 
			  
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
					echo  'cambio 1' ; 
				}
			 
			}
			if($sql2 <> ''){ 
				$stmt2 = sqlsrv_query($conn, $sql2);  
				if( $stmt2 === false ) {   
					writeServerLog(sqlsrv_errors()); 
					die( print_r( sqlsrv_errors(), true));   
				}else{  
					echo  'cambio 2' ; 
				}
			 
			}
			if($sql3 <> ''){ 
				$stmt3 = sqlsrv_query($conn, $sql3);  
				if( $stmt3 === false ) {   
					writeServerLog(sqlsrv_errors()); 
					die( print_r( sqlsrv_errors(), true));   
				}else{  
					echo  'cambio 3' ; 
				}
			 
			}
		  
	 
		$cierre = sqlsrv_close($conn); 
	
	} 
    */
?>
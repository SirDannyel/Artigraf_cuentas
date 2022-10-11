<?php

// global $Repuesta;
  
function writeServerLog($msg)
{
	@error_log(date('Y-m-d H:i:s').' :: '.print_r($msg, true).PHP_EOL, 3, 'wsServer.log');
}
 

function EjecutaSQL($Proceso= '',$sql= '', $sql2= '', $sql3= '', $Alta='')
{  
       $conf = include('config.php');  
 
		$server  = $conf['server'];
		$database = $conf['database'];
	//	$username = $conf['username'];
	//	$password = $conf['password'];

	 	writeServerLog('EjecutaSQL - ' .$Proceso ); 
 
			//$conn = odbc_connect($server, $user, $password,1);
			$conn = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;");
		
			if( $conn ) {
	 		 //    echo "Conexión establecida.<br />";
	 			writeServerLog("Conexión establecida.");
			}else{
				writeServerLog("Conexión no se pudo establecer."); 
				writeServerLog(sqlsrv_errors()); 
			     die( print_r( sqlsrv_errors(), true));
			}
		 
		// SQL1 
		if($sql <> ''){
		 $stmt = odbc_prepare( $conn, $sql );
		 $Result = odbc_execute($stmt);
		 if( $Result === false ) {   
			writeServerLog(sqlsrv_errors()); 
		 	die( print_r( sqlsrv_errors(), true));   
		 }
		 
		}
		 // SQL2
		 if($sql2 <> ''){
		 	 $stmt2 = odbc_prepare( $conn, $sql2 );
			 $Result1 = odbc_execute($stmt2);
			 if( $Result1 === false ) {   
				writeServerLog(sqlsrv_errors()); 
			 	die( print_r( sqlsrv_errors(), true));   
			 }

		 }

		 // SQL3 
		 if($sql3 <> ''){
		 	// $stmt3 = odbc_prepare( $conn, $sql3 );
			// $Result2 = odbc_execute($stmt3); 
			 $Result2 = odbc_exec ($conn, $sql3);
			 if( $Result2 === false ) {   
				writeServerLog(sqlsrv_errors()); 
			 	die( print_r( sqlsrv_errors(), true));   
			 }
			 
				  
	
		 
		 }


$cierre = odbc_close($conn); 

} 
 

function EjecutaSQL2($sql= '', $Tipo='Insert')
{
 $Repuesta;
       $conf = include('config.php');
 
		$server  = $conf['server'];//ODBC
		$database = $conf['database'];
		$username = $conf['username'];
		$password = $conf['password'];

 
writeServerLog($sql);
			$conn = odbc_connect($server, $username, $password,1);
		
			if( $conn ) {
	//		     echo "Conexión establecida.<br />";
	//			writeServerLog("Conexión establecida SQL2.");
			}else{
				writeServerLog("Conexión no se pudo establecer SQL2."); 
				writeServerLog(sqlsrv_errors()); 
			     die( print_r( sqlsrv_errors(), true));
			}
		 
		// SQL1 
		if($sql <> ''){
	//	 $stmt = odbc_prepare( $conn, $sql );
	//	 $Result = odbc_execute($stmt);
			 $Result = odbc_exec ($conn, $sql);
		 if( $Result === false ) {  
			writeServerLog("error de conexión");  
			writeServerLog(sqlsrv_errors()); 
		 	die( print_r( sqlsrv_errors(), true));   
		    }
		 } 
		 if($Tipo=="Select"){
		 while ($info = odbc_fetch_array($Result)) {
    			$Repuesta[] = $info;
 //   			writeServerLog($info);
		 } 
		}

// writeServerLog($Repuesta);  

$cierre = odbc_close($conn); 

return $Repuesta;

} 

function AgregaPartida($Post){

// writeServerLog("Post");
// writeServerLog($Post);
$Id= utf8_decode($Post['Id']);
$Fecha= utf8_decode( $Post['Fecha']);
$Mayor= utf8_decode( $Post['cbx_Mayor']);
$Cuenta= utf8_decode($Post['cbx_Cuenta']);
$Monto= utf8_decode($Post['Monto']);

writeServerLog($Post);

if($Mayor == '' ){
	return "No se capturo la cuenta de Mayor";
}
if($Cuenta == '' ){
	return "No se capturo el numero de Cuenta";
}
if($Monto  == '' ){
	return "No se capturo Monto";
}
if( strtotime($Fecha) ){
	}
	else{
		return "Fecha No Valida";
	} 
 

	$SQL = "Insert into PartidasEspeciales (Id, Fecha, Mayor, CuentaContable, Monto ) "
 ." values (" .$Id .",'" .$Fecha ."', " .$Mayor .",'" .$Cuenta ."',".$Monto.")" ;

// writeServerLog($SQL );

$Repuesta = EjecutaSQL2($SQL,"Insert");

 return "Registro Agregado";
 
}

?>
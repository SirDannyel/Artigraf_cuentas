<?php
/*
require_once('db.php');

//Conectar a la base:
$connec = OpenConnection();

//Validar coneccion
if ($connec === false){
    die( print_r( sqlsrv_errors(), true));
}

//Seleccionar Categorias de Partidas:
$tsql = "Select * FROM EstadoResultados";
$getPartidas = sqlsrv_query($connec, $tsql);

//Validar respuesta SQL
if( $getPartidas === false ) {
    die( print_r( sqlsrv_errors(), true));

}else{

    //Obtener un array con los registros.
     while( $row = sqlsrv_fetch_array( $getPartidas, SQLSRV_FETCH_ASSOC)) {
          echo $row['Descripcion'].", ".$row['Rubro']."<br />";
       }

    //Obtener un objeto con los registros.
    while( $obj = sqlsrv_fetch_object( $getPartidas)) {
        echo $obj->Descripcion."<br />";
    }
}
//Finalizar select
sqlsrv_free_stmt($getPartidas);

//Finalizar coneccion
sqlsrv_close($connec);*/


$serverName = "DESKTOP-092HCCI";
$username = "";
$password = "";
$dataBase = "DWH_Artigraf";

try {
    $conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase");
    //echo "Conexion con $serverName";
}catch (Exception $e){
    echo "Ocurrio un error en la conexion. ". $e->getMessage();
}

$query = "select count(Mayor) as Cuenta, MayorDesc as Cuenta_Contable from Dim_CuentaContable group by MayorDesc";
$stmt = $conn->query($query);
$registros = $stmt->fetchAll(PDO::FETCH_OBJ);
//Imprimir array:
echo json_encode($registros);
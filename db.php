<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nueva";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// Test db user
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
    echo "Conexión establecida.<br />";
<<<<<<< HEAD
}
$sql = "INSERT INTO registro (descripcion ) VALUES ( '{$_POST['descripcion']}');";
=======

}
$sql = "INSERT INTO registro (descripcion ) VALUES ( '{$_POST['descripcion']}');";

>>>>>>> main
if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error; 
}
$conn->close();*/
//Conección a base SQL SERVER: Instalar ultima versiones de php agregar extensiones pdo, odbc para sql
// y reinicar windows despues de agregar conf en el php.init
$serverName = 'LAPTOP-SPVHJIUH\SQLEXPRESS';
$connectionInfo = array( "Database"=>"DWH_Artigraf");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "Conexión establecida.<br />";
}else{
    echo "Conexión no se pudo establecer.<br />";
    die( print_r( sqlsrv_errors(), true));
}

<<<<<<< HEAD
=======
$conn->close();*/
//Conección a base SQL SERVER: Instalar ultima versiones de php agregar extensiones pdo, odbc para sql
// y reinicar windows despues de agregar conf en el php.init
$serverName = 'DESKTOP-907DBP9\SQLEXPRESS';
$connectionInfo = array( "Database"=>"DWH_Artigraf");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "Conexión establecida.<br />";
    echo $conn;
}else{
    echo "Conexión no se pudo establecer.<br />";
    die( print_r( sqlsrv_errors(), true));
}

>>>>>>> main
?>
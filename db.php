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

}
$sql = "INSERT INTO registro (descripcion ) VALUES ( '{$_POST['descripcion']}');";

if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error; 
}

$conn->close();*/
//Conección a base SQL SERVER: Instalar ultima versiones de php agregar extensiones pdo, odbc para sql
// y reinicar windows despues de agregar conf en el php.init

function OpenConnection()
{
    $serverName = 'DESKTOP-092HCCI';
    $connectionInfo = array("Database" => "DWH_Artigraf");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn) {
        // echo "Conexión establecida.<br />";
        return $conn;
    } else {
        // echo "Conexión no se pudo establecer.<br />";
        die(print_r(sqlsrv_errors(), true));
    }

}

?>
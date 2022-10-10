<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test"; 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// Test db user ivette
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$sql = "INSERT INTO registro (descripcion ) VALUES ( '{$_POST['descripcion']}');"; 

if ($conn->multi_query($sql) === TRUE) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error; 
}

$conn->close();
?>
<?php
$conf = include('config.php');  
    $nombreServidor= $conf['server'];
    $nombreBaseDatos = "DWH_Artigraf";

    try {

        $conn = new PDO("sqlsrv:server=$nombreServidor;database=$nombreBaseDatos");

        echo "Conexion exitosa en el servidor $nombreServidor";
    } catch (Exception $e) {
        echo "Ocurrió un error en la conexión . " .$e->getMessage();
    }

?>
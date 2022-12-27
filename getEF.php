<?php
$conf = include('config.php');
$serverName  = $conf['server'];
$dataBase = $conf['database'];
$UID  = $conf['UID'];
$PWD  = $conf['PWD'];

$conn = new PDO ("sqlsrv:server=$serverName;database=$dataBase",$UID,$PWD);
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

try {

    $tableName = $_POST['tabla'];
    $Nivel = $_POST['nivel'];

    $query = "SELECT * FROM $tableName order by $Nivel ";
    $stmt = $conn->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    header_remove('Set-Cookie');
    $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
    if (is_array($httpHeaders) && count($httpHeaders)) {
        foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
        }
    }

    echo json_encode($result);

    unset($stmt);
    unset($conn);
} catch (Exception $e) {
    echo $e->getMessage();
}

<?php


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  include_once 'conexion.php';

  $Parametro = $_GET['filtro'];
  $cantidad = 0;
  $query = "SELECT Cuenta, CuentaDesc, EF1, EF1Desc, EF2, EF2Desc, EF3, EF3Desc, EF4, EF4Desc, EF5, EF5Desc, EF6, EF6Desc, EF7, EF7Desc 
  FROM DWH_Artigraf.dbo.Dim_CuentaContable WHERE Cuenta LIKE '$Parametro'";
  $stmt = $conn->query($query);
  $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

      //Imprimir json:
      header_remove('Set-Cookie');
      $httpHeaders = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
      if (is_array($httpHeaders) && count($httpHeaders)) {
          foreach ($httpHeaders as $httpHeader) {
              header($httpHeader);
          }
      }
      echo json_encode($registros);
      exit();

    }
?>
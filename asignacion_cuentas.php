<?php
  include_once 'conexion.php';
?>
<?php
  $cantidad = 0;
  $query = "SELECT * FROM DWH_Artigraf.dbo.Dim_CuentaContable";
  $stmt = $conn->query($query);
  $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

  //echo json_encode($registros);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AsignacionCuentas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> 
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a> 
        
        <!--<select id="EstadoSelect" class="form-select m-1" role="listbox" placeholder="Estado" onchange="handleSelectChange(this.value)" > 
        </select>-->
        <select class="form-select m-1" placeholder="EF1" id="IdNivel">
            <option class="option" value ="Mayor">1001,0001,0001,0006 </option>
        </select>
        <select class="form-select m-1" placeholder="EF1" id="IdNivel">
            <option class="option" value ="Mayor">PCAJA CHICA DIRECCION</option>
        </select>
        <select class="form-select m-1" placeholder="EF1" id="IdNivel">
            <option class="option" value ="Mayor">PASIVOS x DOCUMENTAR</option>
            <option class="option" value ="Fijo">RANGO NO UTILIZADO</option>
            <option class="option" value ="EF1">RETENCIONES AL PERSONAL</option>
            <option class="option" value ="EF2">ACREEDORES DIVERSOS</option> 
            <option class="option" value ="EF3">SUELDOS `POR PAGAR</option> 
            <option class="option" value ="EF4">IVA POR PAGAR</option> 
            <option class="option" value ="EF5">IMPUESTOS POR PAGAR</option> 
            <option class="option" value ="EF6">FONDO AHORRO</option> 
            <option class="option" value ="EF7">IMPUESTOS A LA UTILIDAD DIFERIDO</option> 
        </select>
        <select class="form-select m-1" placeholder="EF2" id="IdNivel">
            <option class="option" value ="Mayor">ACREEDORES DIVERSOS</option>
            <option class="option" value ="Fijo">BENEFICIOS A LOS EMPLEADOS</option>
            <option class="option" value ="EF1">ISR DIFERIDO</option>
            <option class="option" value ="EF2">PTU DIFERIDA</option> 
            <option class="option" value ="EF3">CAPITAL SOCIAL VARIABLE</option> 
            <option class="option" value ="EF4">INSUFICIENCIA EN ACT</option> 
            <option class="option" value ="EF5">RESERVA LEGAL</option> 
            <option class="option" value ="EF6">RESERVA LEGAL ACTUALIZ</option> 
            <option class="option" value ="EF7">VENTAS TOTALES</option> 
        </select>
        <select class="form-select m-1" placeholder="EF3" id="IdNivel">
            <option class="option" value ="Mayor">Mayor</option>
            <option class="option" value ="Fijo">Fijo</option>
            <option class="option" value ="EF1">EF1</option>
            <option class="option" value ="EF2">EF2</option> 
            <option class="option" value ="EF3">EF3</option> 
            <option class="option" value ="EF4">EF4</option> 
            <option class="option" value ="EF5">EF5</option> 
            <option class="option" value ="EF6">EF6</option> 
            <option class="option" value ="EF7">EF7</option> 
        </select>
        <select class="form-select m-1" placeholder="EF4" id="IdNivel">
            <option class="option" value ="Mayor">Mayor</option>
            <option class="option" value ="Fijo">Fijo</option>
            <option class="option" value ="EF1">EF1</option>
            <option class="option" value ="EF2">EF2</option> 
            <option class="option" value ="EF3">EF3</option> 
            <option class="option" value ="EF4">EF4</option> 
            <option class="option" value ="EF5">EF5</option> 
            <option class="option" value ="EF6">EF6</option> 
            <option class="option" value ="EF7">EF7</option> 
        </select>
        <select class="form-select m-1" placeholder="EF5" id="IdNivel">
            <option class="option" value ="Mayor">Mayor</option>
            <option class="option" value ="Fijo">Fijo</option>
            <option class="option" value ="EF1">EF1</option>
            <option class="option" value ="EF2">EF2</option> 
            <option class="option" value ="EF3">EF3</option> 
            <option class="option" value ="EF4">EF4</option> 
            <option class="option" value ="EF5">EF5</option> 
            <option class="option" value ="EF6">EF6</option> 
            <option class="option" value ="EF7">EF7</option> 
        </select>
        <select class="form-select m-1" placeholder="EF6" id="IdNivel">
            <option class="option" value ="Mayor">Mayor</option>
            <option class="option" value ="Fijo">Fijo</option>
            <option class="option" value ="EF1">EF1</option>
            <option class="option" value ="EF2">EF2</option> 
            <option class="option" value ="EF3">EF3</option> 
            <option class="option" value ="EF4">EF4</option> 
            <option class="option" value ="EF5">EF5</option> 
            <option class="option" value ="EF6">EF6</option> 
            <option class="option" value ="EF7">EF7</option> 
        </select>
        <select class="form-select m-1" placeholder="EF7" id="IdNivel">
            <option class="option" value ="Mayor">Mayor</option>
            <option class="option" value ="Fijo">Fijo</option>
            <option class="option" value ="EF1">EF1</option>
            <option class="option" value ="EF2">EF2</option> 
            <option class="option" value ="EF3">EF3</option> 
            <option class="option" value ="EF4">EF4</option> 
            <option class="option" value ="EF5">EF5</option> 
            <option class="option" value ="EF6">EF6</option> 
            <option class="option" value ="EF7">EF7</option> 
        </select>
        <button class="btn btn-primary" onclick="handleAddConcepto($('#EstadoSelect').val(),$('#IdRubro').val(),$('#IdDesc').val(),$('#IdNivel').val(),$('#pasivoSwitch').is(':checked'),$('#identadoSwitch').is(':checked'),$('#boldSwitch').is(':checked'))"><i class="plus"></i>Agregar</button>
        </nav>
        <div style="padding-top:90px;"> </div>
    <main class="container">  
        <div class="my-3 p-5 bg-body rounded shadow-sm" id="panel">
          <div class="d-flex flex-row">
            <h6 class="border-bottom pb-2 mb-0 w-100">Cuentas Contables</h6>
          </div>
          <table class="table" id="tabla">
            <thead>
              <tr class="d-flex flex-row">
                <th scope="col" style="width:100px;">Cuenta</th>
                <th scope="col" style="width:300px;">Descripción</th> 
                <th scope="col" style="width:400px;">EF1</th> 
                <th scope="col" style="width:100px;">EF2</th> 
                <th scope="col" style="width:100px;">EF3</th> 
                <th scope="col" style="width:100px;">EF4</th> 
                <th scope="col" style="width:100px;">EF5</th> 
                <th scope="col" style="width:100px;">EF6</th>
                <th scope="col" style="width:100px;">EF7</th>
              </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
            </table>
        </div> 

</body>
</html>
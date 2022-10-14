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
          <div class="row">
            <div class="col-6 col-sm-3">
              <input class="form-control m-1" placeholder="1001,0001,????" id="inputSearch"></input>
            </div>
            <div class="col-6 col-sm-3"> <button class="btn btn-primary" onclick="handleAddConcepto($('#EstadoSelect').val(),$('#IdRubro').val(),$('#IdDesc').val(),$('#IdNivel').val(),$('#pasivoSwitch').is(':checked'),$('#identadoSwitch').is(':checked'),$('#boldSwitch').is(':checked'))">
                    Buscar
                  </button></div>
            
            <div class="w-100"></div>
          
        <!-- AQUI FILAS DE INPUTS EF -->
        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf1">EF1</p>
              <input class="form-control m-1" placeholder="EF1" id="IdEf1"></input>
            
        </div>
        
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF2</p>
            <input class="form-control m-1" placeholder="EF2" id="IdEf2"></input>
        </div>

        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF3</p>
              <input class="form-control m-1" placeholder="EF3" id="IdEf3"></input>
        </div>

        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF4</p>
              <input class="form-control m-1" placeholder="EF4" id="IdEf4"></input>
        </div>

        <div class="col"> 
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF5</p>
              <input class="form-control m-1" placeholder="EF5" id="IdEf5"></input>
        </div>

        <div class="col">  
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF6</p>
              <input class="form-control m-1" placeholder="EF6" id="IdEf6"></input>
        </div>

        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF7</p>
              <input class="form-control m-1" placeholder="EF7" id="IdEf7"></input>
        </div>

        <div class="col">
        <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3"></p>
        <div class="col"> <button class="btn btn-primary" onclick="handleAddConcepto($('#EstadoSelect').val(),$('#IdRubro').val(),$('#IdDesc').val(),$('#IdNivel').val(),$('#pasivoSwitch').is(':checked'),$('#identadoSwitch').is(':checked'),$('#boldSwitch').is(':checked'))">
                    Mofificar
                  </button></div>
        </div>

          </div>
      </div> 
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
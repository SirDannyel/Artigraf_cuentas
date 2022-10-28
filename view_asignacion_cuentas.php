
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
  <script src="input-mask.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<script>  

/******* Apis  *******/

/*
const Cuentas_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText); 
                    } else { 
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }
            objXMLHttpRequest.open('GET','http://localhost/Artigraf/model_asignacion_cuentas.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }



 */

const CuentasContables_Api = (filtro = $('#inputSearch').val()) => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getCuentasContables.php";
            var Parametro = "?filtro=";
            var UrltoSend = url + Parametro + filtro;
            objXMLHttpRequest.open('GET', UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const UpdateCuentas_Api = (cuenta,ef1,ef1desc,ef2,ef2desc,ef3,ef3desc,ef4,ef4desc,ef5,ef5desc,ef6,ef6desc,ef7,ef7desc) => {

          return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                  if (objXMLHttpRequest.status == 200) {
                    resolve(objXMLHttpRequest.responseText);
                  } else {
                    reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                  }
              }
            }

            objXMLHttpRequest.open('POST','getCuentasContables.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send("cuenta="+cuenta+"ef1="+ef1+"&ef1desc="+ef1desc+"&ef2="+ef2+"&ef2desc="+ef2desc+"&ef3="+ef3+"&ef3desc="+ef3desc+"&ef4="+ef4+"&ef4desc="+ef4desc+"&ef5="+ef5+"&ef5desc="+ef5desc+"&ef6="+ef6+"&ef6desc="+ef6desc+"&ef7="+ef7+"&ef7desc="+ef7desc);
        });
      }



//Controlador de FrontEnd
const getCuentasContables = async () => {
        try {
            const response = await CuentasContables_Api();
            console.log("getCuentasContables", response);
            const myArr = JSON.parse(response);
            console.log("getCuentasContables", myArr);
            /*const nuevoArr = myArr.filter( ({ Cuenta }) => Cuenta.includes(cuenta));*/
            $("#IdEf1").val(myArr[0].EF1);
            $("#IdEf1Desc").val(myArr[0].EF1Desc);
            $("#IdEf2").val(myArr[0].EF2);
            $("#IdEf2Desc").val(myArr[0].EF2Desc);
            $("#IdEf3").val(myArr[0].EF3);
            $("#IdEf3Desc").val(myArr[0].EF3Desc);
            $("#IdEf4").val(myArr[0].EF4);
            $("#IdEf4Desc").val(myArr[0].EF4Desc);
            $("#IdEf5").val(myArr[0].EF5);
            $("#IdEf5Desc").val(myArr[0].EF5Desc);
            $("#IdEf6").val(myArr[0].EF6);
            $("#IdEf6Desc").val(myArr[0].EF6Desc);
            $("#IdEf7").val(myArr[0].EF7);
            $("#IdEf7Desc").val(myArr[0].EF7Desc);
            var tablabody = document.getElementById("tablabody");
            for (var i = 0; i < myArr.length; i++) { //cambiar myArr por nuevoArr.length
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);
                var orden = myArr[i].Cuenta; //cambiar por nuevoArr con todos los campos
                var posicion = i;
                console.log("posición", i);
                console.log("posición variable", posicion);
                var campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = orden;
                campo.value = orden;
                linea.appendChild(campo);
                var opt = myArr[i].CuentaDesc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:300px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF1;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF1Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF2;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF2Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF3;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF3Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF4;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF4Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF5;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF5Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF6;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF6Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF7;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = myArr[i].EF7Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
              }
              console.log("posición final varianle", posicion);
              console.log("posición final", i);
              myArr.splice(1,1);
              console.log("elemento eliminado", myArr);
            } catch (err) 
            {
                console.log(err)
            }
        }
        
         //Botón para Buscar cuentas con base al valor ingresado en el input del search.
        const handleChangeCuenta = (filtro) => {
          try{ 
         //   alert('orden: ',orden,'cambio: ',cambio);
            CuentasContables_Api(filtro); 
            getCuentasContables(filtro); 
 
          }catch(err){
                console.log(err);
          }
        }


    const handleUpdateCuenta = (ef1,ef1desc,ef2,ef2desc,ef3,ef3desc,ef4,ef4desc,ef5,ef5desc,ef6,ef6desc,ef7,ef7desc) => {
        try {
          var cuenta = '1001,0001,0001,0006 ';
         //lent cuenta =  ['1001,0001,0001,0006 ' , '1001,0001,0001,0012 ' , '1001,0001,0001,0017 '];
          //let ef1 [];
          UpdateCuentas_Api (cuenta,ef1,ef1desc,ef2,ef2desc,ef3,ef3desc,ef4,ef4desc,ef5,ef5desc,ef6,ef6desc,ef7,ef7desc);
          Swal.fire({
            icon: 'success',
            title: 'Registros Actualizados',
            showConfirmButton: false,
            timer: 1500
        });

        } catch (err) {
            console.log(err)
        }

       //AQUI
    }



        const init = () => {
        //getCuentasContables();
    }

   

    //Mandar a llamar getCuentasContables
    init();


/******* Fin Apis  *******/




</script>

<!-- VISTA -->

<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> 
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
          </a>
          <div class="row">
            <div class="col-6 col-sm-3">
              <input class="form-control m-1" placeholder="1001,0001,????" id="inputSearch"></input>
            </div>
            <div class="col-6 col-sm-3"> <button class="btn btn-primary" onclick="handleChangeCuenta($('#inputSearch').val())">
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
        </div>

        <div class="w-100"></div>

        <div class="text-center">
        <h6>DESCRIPCIONES</h6>
        </div>

        <div class="w-100"></div>

        <!-- AQUI FILAS DE INPUTS EF Descripciones -->

        <div class="col">
              <input class="form-control m-1" placeholder="EF1" id="IdEf1Desc"></input>
        </div>
        
        <div class="col">
            <input class="form-control m-1" placeholder="EF2" id="IdEf2Desc"></input>
        </div>

        <div class="col">
              <input class="form-control m-1" placeholder="EF3" id="IdEf3Desc"></input>
        </div>

        <div class="col">
              <input class="form-control m-1" placeholder="EF4" id="IdEf4Desc"></input>
        </div>

        <div class="col"> 
          <input class="form-control m-1" placeholder="EF5" id="IdEf5Desc"></input>
        </div>

        <div class="col">
          <input class="form-control m-1" placeholder="EF6" id="IdEf6Desc"></input>
        </div>

        <div class="col">
          <input class="form-control m-1" placeholder="EF7" id="IdEf7Desc"></input>
        </div>

        <div class="col">
          <div class="col"> <button class="btn btn-primary" onclick="handleUpdateCuenta($('#IdEf1').val(),$('#IdEf1Desc').val(),$('#IdEf2').val(),$('#IdEf2Desc').val(),$('#IdEf3').val(),$('#IdEf3Desc').val(),$('#IdEf4').val(),$('#IdEf4Desc').val(),$('#IdEf5').val(),$('#IdEf5Desc').val(),$('#IdEf6').val(),$('#IdEf6Desc').val(),$('#IdEf7').val(),$('#IdEf7Desc').val())">
                    Mofificar
                  </button></div>
        </div>

          </div>
      </div> 
    </nav> 


    <div style="padding-top:170px;"> </div>
    <main class="container" style="max-width:1822px;">  
        <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
          <div class="border-bottom d-flex flex-row">
            <h3 class="w-100  d-flex justify-content-center text-primary" id="titulo">Cuentas Contables</h3>
          </div>
          <table class="table" id="tabla">
            <thead>
              <tr class="d-flex flex-row">
                <th scope="col" style="width:200px;" class="text-center">Cuenta</th>
                <th scope="col" style="width:300px;" class="text-center">Descripción</th>
                <th scope="col" style="width:100px;" class="text-center">EF1</th>
                <th scope="col" style="width:200px;" class="text-center">Descripción EF1</th> 
                <th scope="col" style="width:100px;" class="text-center">EF2</th> 
                <th scope="col" style="width:200px;" class="text-center">Descripción EF2</th> 
                <th scope="col" style="width:100px;" class="text-center">EF3</th> 
                <th scope="col" style="width:200px;" class="text-center">Descripción EF3</th> 
                <th scope="col" style="width:100px;" class="text-center">EF4</th>
                <th scope="col" style="width:200px;" class="text-center">Descripción EF4</th>
                <th scope="col" style="width:100px;" class="text-center">EF5</th>
                <th scope="col" style="width:200px;" class="text-center">Descripción EF5</th>
                <th scope="col" style="width:100px;" class="text-center">EF6</th>
                <th scope="col" style="width:200px;" class="text-center">Descripción EF6</th>
                <th scope="col" style="width:100px;" class="text-center">EF7</th>
                <th scope="col" style="width:200px;" class="text-center">Descripción EF7</th> 
              </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
            </table>
        </div> 

</body>
</html>
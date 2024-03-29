<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AsignacionCuentas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/caf35569f5.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="input-mask.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
/******* Models ************/
    let cuentascontables = [];
/******* Servicios  *******/
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
    const UpdateCuentas_Api = () => {
        //const form = cuentascontables.slice();
        const data = JSON.stringify(cuentascontables);
          return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                  if (objXMLHttpRequest.status == 200) {
                      resolve(objXMLHttpRequest.responseText);
                      //console.log(data);
                  } else {
                    reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                  }
              }
            }
            objXMLHttpRequest.open('POST','getCuentasContables.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
      }
const RegistrarCambios_Api = (cuentasInput) => {
    const data = JSON.stringify(cuentasInput);
    return new Promise(function (resolve, reject) {
        const objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function () {
            if (objXMLHttpRequest.readyState === 4) {
                if (objXMLHttpRequest.status == 200) {
                    resolve(objXMLHttpRequest.responseText);
                    //console.log(data);
                } else {
                    reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                }
            }
        }
        objXMLHttpRequest.open('POST','postAsignacion.php');
        objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
        objXMLHttpRequest.send(data);
    });
}
/******* Controladores y funciones *******/
const deleteChild = () => {
    $(".tr").remove();
}
const getCuentasContables = async () => {
        try {
            const response = await CuentasContables_Api();
            cuentascontables = JSON.parse(response);
            $('#IdEf1').val(cuentascontables[0].EF1);
            $('#IdEf1Desc').val(cuentascontables[0].EF1Desc);
            $('#IdEf2').val(cuentascontables[0].EF2);
            $('#IdEf2Desc').val(cuentascontables[0].EF2Desc);
            $('#IdEf3').val(cuentascontables[0].EF3);
            $('#IdEf3Desc').val(cuentascontables[0].EF3Desc);
            $('#IdEf4').val(cuentascontables[0].EF4);
            $('#IdEf4Desc').val(cuentascontables[0].EF4Desc);
            $('#IdEf5').val(cuentascontables[0].EF5);
            $('#IdEf5Desc').val(cuentascontables[0].EF5Desc);
            $('#IdEf6').val(cuentascontables[0].EF6);
            $('#IdEf6Desc').val(cuentascontables[0].EF6Desc);
            $('#IdEf7').val(cuentascontables[0].EF7);
            $('#IdEf7Desc').val(cuentascontables[0].EF7Desc);
            $('#IdEf8').val(cuentascontables[0].EF8);
            $('#IdEf8Desc').val(cuentascontables[0].EF8Desc);
            await getCuentasContables_Table();
            } catch (err) 
            {
                console.log(err)
            }
        }
const getCuentasContables_Table = async () => {
    try {
        deleteChild ();
        /*const nuevoArr = myArr.filter( ({ Cuenta }) => Cuenta.includes(cuenta));*/
        var tablabody = document.getElementById("tablabody");
        for (var i = 0; i < cuentascontables.length; i++) { //cambiar myArr por nuevoArr.length
            var linea = document.createElement("tr");
            linea.setAttribute("class", "d-flex flex-row tr");
            tablabody.appendChild(linea);
            var cuenta = cuentascontables[i].Cuenta; //cambiar por nuevoArr con todos los campos
            var campo = document.createElement("td");
            campo.setAttribute("style", "width:200px;");
            campo.textContent = cuenta;
            campo.value = cuenta;
            linea.appendChild(campo);
            var opt = cuentascontables[i].CuentaDesc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:380px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF1;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF1Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF2;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF2Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF3;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF3Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF4;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF4Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF5;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF5Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF6;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF6Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF7;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF7Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF8;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:100px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            opt = cuentascontables[i].EF8Desc;
            campo = document.createElement("td");
            campo.setAttribute("style", "width:250px;");
            campo.textContent = opt;
            campo.value = opt;
            linea.appendChild(campo);
            var boton = document.createElement("button");
            boton.setAttribute("name",cuentascontables[i].Cuenta);
            boton.setAttribute("id", cuenta);
            boton.onclick = function(){
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Se descartará el registro",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Descartar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let indice = cuentascontables.findIndex(cuenta => cuenta.Cuenta === this.id);
                        cuentascontables.splice(indice, 1);
                        getCuentasContables_Table();
                        Swal.fire(
                            '¡Descartado!',
                            'Registro Descartado.',
                            'Success'
                        )
                    }
                });
            };
            boton.setAttribute("class", "btn btn-outline-danger px-3");
            boton.setAttribute("type", "button");
            linea.appendChild(boton);
            var icon = document.createElement("i");
            icon.setAttribute("class", "fa-solid fa-close");
            boton.appendChild(icon);
        }
    } catch (err)
    {
        console.log(err)
    }
}
         //Botón para Buscar cuentas con base al valor ingresado en el input del search.
        const handleChangeCuenta = () => {
          try{
            getCuentasContables();
          }catch(err){
                console.log(err);
          }
        }

    const handleUpdateCuenta = (filtro,ef1,ef1desc,ef2,ef2desc,ef3,ef3desc,ef4,ef4desc,ef5,ef5desc,ef6,ef6desc,ef7,ef7desc,ef8,ef8desc) => {
        try {
            for (var i = 0; i < cuentascontables.length; i++) {
                var cuenta = cuentascontables[i].Cuenta;
                cuentascontables.map(function (dato) {
                    if (dato.Cuenta == cuenta) {
                        if (ef1 && ef1desc) {
                            dato.EF1 = ef1;
                            dato.EF1Desc = ef1desc;
                        }
                        if (ef2 && ef2desc) {
                            dato.EF2 = ef2;
                            dato.EF2Desc = ef2desc;
                        }
                        if(ef3 && ef3desc) {
                            dato.EF3 = ef3;
                            dato.EF3Desc = ef3desc;
                        }
                        if(ef4 && ef4desc) {
                            dato.EF4 = ef4;
                            dato.EF4Desc = ef4desc;
                        }
                        if(ef5 && ef5desc) {
                            dato.EF5 = ef5;
                            dato.EF5Desc = ef5desc;
                        }
                        if(ef6 && ef6desc) {
                            dato.EF6 = ef6;
                            dato.EF6Desc = ef6desc;
                        }
                        if(ef7 && ef7desc) {
                            dato.EF7 = ef7;
                            dato.EF7Desc = ef7desc;
                        }
                        if(ef8 && ef8desc) {
                            dato.EF8 = ef8;
                            dato.EF8Desc = ef8desc;
                        }
                    }
                    return dato;
                });
            }
            let cuentasInput = {
                filtro : filtro,
                ef1 : ef1,
                ef1desc : ef1desc,
                ef2 : ef2,
                ef2desc : ef2desc,
                ef3 : ef3,
                ef3desc : ef3desc,
                ef4 : ef4,
                ef4desc : ef4desc,
                ef5 : ef5,
                ef5desc : ef5desc,
                ef6 : ef6,
                ef6desc : ef6desc,
                ef7 : ef7,
                ef7desc : ef7desc,
                ef8 : ef8,
                ef8desc : ef8desc
            };
            UpdateCuentas_Api();
            RegistrarCambios_Api(cuentasInput);
            getCuentasContables_Table();
            Swal.fire({
            icon: 'success',
            title: 'Registros Actualizados',
            showConfirmButton: false,
            timer: 1500
            });
            $('#IdEf1').val("");
            $('#IdEf1Desc').val("");
            $('#IdEf2').val("");
            $('#IdEf2Desc').val("");
            $('#IdEf3').val("");
            $('#IdEf3Desc').val("");
            $('#IdEf4').val("");
            $('#IdEf4Desc').val("");
            $('#IdEf5').val("");
            $('#IdEf5Desc').val("");
            $('#IdEf6').val("");
            $('#IdEf6Desc').val("");
            $('#IdEf7').val("");
            $('#IdEf7Desc').val("");
            $('#IdEf8').val("");
            $('#IdEf8Desc').val("");
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
              <input class="form-control m-1" placeholder="1001,0001,%%%%" id="inputSearch"></input>
            </div>
            <div class="col-6 col-sm-3"> <button class="btn btn-primary" onclick="handleChangeCuenta()">
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
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf3">EF3</p>
              <input class="form-control m-1" placeholder="EF3" id="IdEf3"></input>
        </div>
        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf4">EF4</p>
              <input class="form-control m-1" placeholder="EF4" id="IdEf4"></input>
        </div>
        <div class="col"> 
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf5">EF5</p>
              <input class="form-control m-1" placeholder="EF5" id="IdEf5"></input>
        </div>
        <div class="col">  
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf6">EF6</p>
              <input class="form-control m-1" placeholder="EF6" id="IdEf6"></input>
        </div>
        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf7">EF7</p>
              <input class="form-control m-1" placeholder="EF7" id="IdEf7"></input>
        </div>
        <div class="col">
              <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf8">EF8</p>
              <input class="form-control m-1" placeholder="EF8" id="IdEf8"></input>
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
          <input class="form-control m-1" placeholder="EF8" id="IdEf8Desc"></input>
        </div>
        <div class="col">
          <div class="col"> <button class="btn btn-primary" onclick="handleUpdateCuenta($('#inputSearch').val(),$('#IdEf1').val(),$('#IdEf1Desc').val(),$('#IdEf2').val(),$('#IdEf2Desc').val(),$('#IdEf3').val(),$('#IdEf3Desc').val(),$('#IdEf4').val(),$('#IdEf4Desc').val(),$('#IdEf5').val(),$('#IdEf5Desc').val(),$('#IdEf6').val(),$('#IdEf6Desc').val(),$('#IdEf7').val(),$('#IdEf7Desc').val(),$('#IdEf8').val(),$('#IdEf8Desc').val())">
                    Modificar
                  </button></div>
        </div>
          </div>
      </div> 
    </nav> 
    <div style="padding-top:200px;"> </div>
    <main class="container" style="max-width:1840px;">
         <div class="my-3 p-2" id="panel">
           <div class="border-bottom d-flex flex-row"> 
            <h3 class="w-100  d-flex justify-content-center text-primary" id="titulo">Cuentas Contables</h3>
            </div>
          </div>
          <table class="table" id="tabla">
            <thead>
              <tr class="d-flex flex-row">
                <th scope="col" style="width:200px;">Cuenta</th>
                <th scope="col" style="width:380px;">Descripción</th>
                <th scope="col" style="width:100px;">EF1</th>
                <th scope="col" style="width:250px;">Descripción EF1</th> 
                <th scope="col" style="width:100px;">EF2</th> 
                <th scope="col" style="width:250px;">Descripción EF2</th> 
                <th scope="col" style="width:100px;">EF3</th> 
                <th scope="col" style="width:250px;">Descripción EF3</th> 
                <th scope="col" style="width:100px;">EF4</th>
                <th scope="col" style="width:250px;">Descripción EF4</th>
                <th scope="col" style="width:100px;">EF5</th>
                <th scope="col" style="width:250px;">Descripción EF5</th>
                <th scope="col" style="width:100px;">EF6</th>
                <th scope="col" style="width:250px;">Descripción EF6</th>
                <th scope="col" style="width:100px;">EF7</th>
                <th scope="col" style="width:250px;">Descripción EF7</th> 
                <th scope="col" style="width:100px;">EF8</th>
                <th scope="col" style="width:250px;">Descripción EF8</th>
              </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
            </table>
</body>
</html>
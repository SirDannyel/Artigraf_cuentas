

    <!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARTIGRAF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="input-mask.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
   
   <script>  

        /******* Apis  *******/

        const getEstadosApi = () => {
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
        
                objXMLHttpRequest.open('GET', 'EstadosDb.php');
                objXMLHttpRequest.send();
            });
        }

        const getConceptosApi = (estado = 'ER Interno') => {   
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
        
                objXMLHttpRequest.open('POST', 'getConceptos.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("estado="+estado);
            });
        }

        /******* Fin Apis  *******/

        const deleteChild = () => {
          $(".tr").remove(); 
          console.log('1');             
        }    

        /******* Services  *******/

        const getEstados = async () => {
            try{
                const response = await getEstadosApi();
                console.log("getEstados Response", response);
                const myArr = JSON.parse(response);

                var select = document.getElementById("EstadoSelect");
                for(var i = 0; i < myArr.length; i++) {
                    var opt = myArr[i];
                    var el = document.createElement("option");
                    el.textContent = opt;
                    el.value = opt;
                    select.appendChild(el);
                }
            }
            catch(err){
                console.log(error)
            }           
        }

        const getConceptos = async (estado = 'ER Interno') => {
            try{
                const response = await getConceptosApi(estado);
                console.log("getEstados Response", response);

                if(response === 'Sin resultados') return;

                deleteChild();
                const myArr = JSON.parse(response);
                var tablabody = document.getElementById("tablabody");    

                for(var i = 0; i < myArr.length; i++) {
                    var linea = document.createElement("tr");
                    linea.setAttribute("class", "d-flex flex-row tr");  
                    tablabody.appendChild(linea); 
                    
                    var opt = myArr[i].Orden;
                    var campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                     campo.textContent = opt;
                     campo.value = opt;
                     linea.appendChild(campo);
                    
                    opt = myArr[i].Rubro;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:300px;");  
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
 
                    opt = myArr[i].Descripcion;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:400px;");  
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);

                    opt = myArr[i].Nivel;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
                    
                    opt = myArr[i].Naturaleza;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
                    
                    opt = myArr[i].Identado;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
                    
                    opt = myArr[i].Formato;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
                }
            }
            catch(err){
                console.log(error)
            }           
        } 

        /******* Fin Services  *******/


        /******* DOM Events  *******/

        const handleSelectChange = (estado) => {
            getConceptos(estado);
        }

        /******* Fin DOM Events  *******/

        

        const validar = () => {
          
            const arr = document.getElementsByName("inputclave"); 
            for (var x = 0; x < arr.length; x++) {
                // validacion
                if(arr[x].value === ''){
                 // alert('No se admiten valores vacios');
                  Swal.fire('No se admiten valores vacios')
                  return;
                } 
            } 
     
           document.getElementById('boton_enviar').disabled=true;

            for (var x = 0; x < arr.length; x++) {
            
              // Create an XMLHttpRequest object
                const xhttp = new XMLHttpRequest();

                // Define a callback function
                xhttp.onload = function() {
                  // Here you can use the Data
                }

                // Send a request 
                xhttp.open("POST", "db.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("descripcion="+arr[x].value);
     
            }

          let timerInterval
            Swal.fire({
              title: 'Registros Agregados!',
          //    html: 'I will close in <b></b> milliseconds.',
              timer: 1000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                }, 100)
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
              }
            });
          // fin  
         
           document.getElementById('boton_enviar').disabled=false;
        } 
         

        const init = () => {
            getEstados();
            getConceptos();
        }

        init();
 
   </script>
  
  <body class="bg-light"> 
    
    <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> 
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>  
        <select id="EstadoSelect" class="form-select m-1" role="listbox" placeholder="Estado" onchange="handleSelectChange(this.value)" > 
        </select>
        <input class="form-control m-1" placeholder="Rubro"></input>
        <input class="form-control m-1" placeholder="Descripción"></input>
        <select class="form-select m-1" placeholder="Nivel">
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
        <button class="btn btn-primary" onclick="addConcepto()"><i class="plus"></i>Agregar</button>
      </div>
    </nav> 
    <div style="padding-top:90px;"> </div>
    <main class="container">  
        <div class="my-3 p-5 bg-body rounded shadow-sm" id="panel">
          <div class="d-flex flex-row">
            <h6 class="border-bottom pb-2 mb-0 w-100">Conceptos</h6>
          </div>
          <table class="table" id="tabla">
            <thead>
              <tr class="d-flex flex-row">
                <th scope="col" style="width:100px;">Orden</th>
                <th scope="col" style="width:300px;">Rubro</th> 
                <th scope="col" style="width:400px;">Descripción</th> 
                <th scope="col" style="width:100px;">Nivel</th> 
                <th scope="col" style="width:100px;">Naturaleza</th> 
                <th scope="col" style="width:100px;">Identado</th> 
                <th scope="col" style="width:100px;">Formato</th> 
              </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
            </table>
        </div> 
        <div class="d-flex flex-row my-3 p-3 bg-body rounded shadow-sm">
          <div class="pb-2 mb-0 w-25"> </div>
          <button id='boton_enviar' class="btn btn-success w-100" onclick="validar();">Confirmar</button>
          <div class="pb-2 mb-0 w-25"> </div>
        </div> 
    </main>
     
  </body>
</html>

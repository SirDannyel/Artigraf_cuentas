 
    <!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARTIGRAF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/caf35569f5.js" crossorigin="anonymous"></script>
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
        
                objXMLHttpRequest.open('POST', 'EstadosDb.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"get" );
            });
        }

        const getRubrosApi = (nivel) => {
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
        
                objXMLHttpRequest.open('POST', 'CuentasContablesDb.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"getRubros"+"&nivel="+nivel );
            });
        }
        const getConceptosApi = (estado = $('#EstadoSelect').val()) => {   
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
        
                objXMLHttpRequest.open('POST', 'ConceptosDB.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"get&"+"estado="+estado);
            });
        }

        const postConceptoApi = (estado,rubro,desc,nivel,nat,identado,resaltado) => {   
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
        
                objXMLHttpRequest.open('POST', 'ConceptosDB.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"post"+"&estado="+estado+"&orden="+(Number(ult_orden)+10)+"&rubro="+rubro+"&desc="+desc+"&nivel="+nivel+"&pasivo="+nat+"&identado="+identado+"&resaltado="+resaltado);
            });
        }
        
        const postEstadoApi = (estado) => {   
            return new Promise(function (resolve, reject) {
                const objXMLHttpRequest = new XMLHttpRequest();
        
                objXMLHttpRequest.onreadystatechange = function () {
                    if (objXMLHttpRequest.readyState === 4) {
                        if (objXMLHttpRequest.status == 200) {
                             resolve(objXMLHttpRequest.responseText); 
                                getEstados();
                        } else {
                            reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                        }
                    }
                }
        
                objXMLHttpRequest.open('POST', 'EstadosDb.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"post"+"&estado="+estado);
            });
        }
        const deleteConceptoApi = (estado,orden,desc) => {   
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
        
                objXMLHttpRequest.open('POST', 'ConceptosDB.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"delete"+"&estado="+estado+"&orden="+orden+"&desc="+desc );
            });
        }

        const changeConceptoApi = (estado,orden,cambio,desc) => {   
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
        
                objXMLHttpRequest.open('POST', 'ConceptosDB.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"change"+"&estado="+estado+"&orden="+orden+"&cambio="+cambio+"&desc="+desc );
            });
        }
        /******* Fin Apis  *******/
   

        /******* Services  *******/

        const changeConcepto = async(estado, orden, cambio,desc)=>{
          try{ 
         //   alert('orden: ',orden,'cambio: ',cambio);
             const response = await changeConceptoApi(estado, orden, cambio,desc); 
            getConceptos(estado); 
 
          }catch(err){
                console.log(err)
          }
        }
        const deleteConcepto = async(estado, orden,desc)=>{
          try{ 
            const response = await deleteConceptoApi(estado,orden,desc); 
            getConceptos(estado);
          }catch(err){
                console.log(err)
          }
        }
 
        const postConcepto = async (estado,rubro,desc,nivel,pasivo,identado,resaltado) => {
            try{
              //  alert('pasivo: '+pasivo+' identado: '+identado+' resaltado: '+resaltado );
                let nat;
                if(pasivo === true){
                  nat =  1;
                }else{ 
                  nat = -1;
                }
                let iden;
                if(identado === true){
                  iden =  1;
                }else{ 
                  iden = 0;
                }
                let res;
                if(resaltado === true){
                  res = 'BOLD';
                }else{ 
                  res = '';
                }
                var rubroName;
                if(rubro == '')
                    rubroName = desc;
                else    
                    rubroName = rubro;
               // alert('estado: '+estado+' rubro: '+rubro+' desc: '+desc+' nivel: '+nivel+' nat: '+nat+' iden: '+iden+' res: '+res);

                const response = await postConceptoApi(estado,rubroName,desc,nivel,nat,iden,res);
               // console.log("postConcepto Response", response); 
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Registro Agregado',
                  showConfirmButton: false,
                  timer: 1000
                });

                getConceptos(estado);
  
            }
            catch(err){
                console.log(err)
            }           
        }
        const getEstados = async () => {
            try{
                const response = await getEstadosApi();
               // console.log("getEstados ResponseS", response);
                const myArr = JSON.parse(response);

                var select = document.getElementById("EstadoSelect"); 
                $(".optionEstado").remove(); 
                for(var i = 0; i < myArr.length; i++) {
                    var opt = myArr[i];
                    var el = document.createElement("option");
                    el.setAttribute("class", "optionEstado");  
                    el.textContent = opt;
                    el.value = opt;
                    select.appendChild(el);
                }
                
                getConceptos($('#EstadoSelect').val());
            }
            catch(err){
                console.log(err)
            }           
        }
        
        const getRubros = async (nivel) => {
            try{
                const response = await getRubrosApi(nivel);  
                const myArr = JSON.parse(response); 

                var select = document.getElementById("IdRubro"); 
                if(nivel == 'FIJO'){
                  select.setAttribute("disabled", ""); 
                }else{
                  select.removeAttribute("disabled");   
                }
                $(".optionRubro").remove(); 
                for(var i = 0; i < myArr.length; i++) {
                    var opt = myArr[i];
                    var el = document.createElement("option");
                      el.setAttribute("class", "optionRubro"); 
                    if(nivel != 'FIJO'){ 
                      el.textContent = opt;
                      el.value = opt;
                    } 
                    select.appendChild(el);
                }
                 
            }
            catch(err){
                console.log(err)
            }           
        }

        var ult_orden;
        const getConceptos = async (estado = $('#EstadoSelect').val()) => {
            try{
                const response = await getConceptosApi(estado);
               // console.log("getEstados Response", response);

                $(".tr").remove(); 
                ult_orden = 0;
                if(response === 'Sin resultados') return;
 
                const myArr = JSON.parse(response);
                var tablabody = document.getElementById("tablabody");    

                for(var i = 0; i < myArr.length; i++) {
                    var linea = document.createElement("tr");
                    linea.setAttribute("class", "d-flex flex-row tr");  
                    tablabody.appendChild(linea);  
                    
                    var orden = myArr[i].Orden;
                    var campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.setAttribute("class", "text-center"); 
                     campo.textContent = orden;
                     campo.value = orden;
                     linea.appendChild(campo);
                    
                     var opt = myArr[i].Nivel;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.setAttribute("class", "text-center"); 
                    campo.setAttribute("id", "Nivel"+orden); 
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);

                     opt = myArr[i].Rubro;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:300px;");  
                    campo.setAttribute("id", "Rubro"+orden); 
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
 
                    opt = myArr[i].Descripcion;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:400px;");   
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo); 
                    
                    opt = myArr[i].Naturaleza;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.setAttribute("id", "Naturaleza"+orden); 
                    if(opt == 1){
                      opt = 'Positiva';
                      campo.setAttribute("class", "text-success text-center");  
                    }else{
                      opt = 'Negativa';
                      campo.setAttribute("class", "text-danger text-center");  
                    }
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
                    
                    opt = myArr[i].Identado;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.setAttribute("id", "Identado"+orden); 
                    if(opt == 1){
                      opt = 'Si';
                      campo.setAttribute("class", "text-success fw-bold text-center");  
                    }else{
                      opt = 'No';
                      campo.setAttribute("class", "text-muted text-center");  
                    }
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo);
                    
                    opt = myArr[i].Formato;
                    campo = document.createElement("td");
                    campo.setAttribute("style", "width:100px;");  
                    campo.setAttribute("class", "fw-bold text-center"); 
                    campo.setAttribute("id", "Formato"+orden); 
                    if(opt == 'BOLD'){
                      opt = 'Si'; 
                    }
                    campo.textContent = opt;
                    campo.value = opt;
                    linea.appendChild(campo); 
                    
                    var boton = document.createElement("button");  
                    boton.setAttribute("name", myArr[i].Descripcion);   
                    boton.setAttribute("id", orden);     
                    boton.onclick = function(){
                  //    alert($('#Naturaleza'+this.id).val() == 'Positiva' ? 1 : 0 );
                      getRubros($('#Nivel'+this.id).val());
                      $('#IdNivel').val($('#Nivel'+this.id).val());

                      Swal.fire({
                            title: '¿Estas seguro?',
                            text: "Se eliminará el registro",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Eliminarlo',
                            cancelButtonText: 'Cancelar'
                          }).then((result) => {
                            if (result.isConfirmed) { 
                              
                              deleteConcepto(estado, this.id,this.name);
                              Swal.fire(
                                'Eliminado!',
                                'Registro Eliminado.',
                                'success'
                              )
                            }
                            
                              $('#IdRubro').val($('#Rubro'+this.id).val());
                              $('#IdDesc').val(this.name);
                              $('#pasivoSwitch').val($('#Naturaleza'+this.id).val() == 'Positiva' ? $('#pasivoSwitch').prop('checked', true) : $('#pasivoSwitch').prop('checked', false) );
                              $('#identadoSwitch').val($('#Identado'+this.id).val() == 'Si' ? $('#identadoSwitch').prop('checked', true) : $('#identadoSwitch').prop('checked', false)  );
                              $('#boldSwitch').val($('#Formato'+this.id).val() == 'Si' ? $('#boldSwitch').prop('checked', true) : $('#boldSwitch').prop('checked', false)  ); 
                          });
                    }; 
                    boton.setAttribute("class", "btn btn-outline-danger px-3");
                    boton.setAttribute("type", "button");
                    linea.appendChild(boton);  
                    var icon = document.createElement("i");
                    icon.setAttribute("class", "fa-solid fa-close"); 
                    boton.appendChild(icon);  
                    
                    boton = document.createElement("button");  
                    boton.setAttribute("id", orden);   
                    boton.setAttribute("name", myArr[i].Descripcion);  
                    boton.onclick = function(){
                         changeConcepto(estado, Number(this.id), Number(this.id) - 10, this.name);                             
                    }; 
                    boton.setAttribute("class", "btn btn-outline-warning px-3");
                    boton.setAttribute("type", "button");
                    linea.appendChild(boton); 
                    icon = document.createElement("i");
                    icon.setAttribute("class", "fa-solid fa-chevron-up"); 
                    boton.appendChild(icon);  
                    

                    boton = document.createElement("button");  
                    boton.setAttribute("id", orden);    
                    boton.setAttribute("name", myArr[i].Descripcion);  
                    boton.onclick = function(){
                         changeConcepto(estado, Number(this.id), Number(this.id) + 10, this.name);                             
                    }; 
                    boton.setAttribute("class", "btn btn-outline-warning px-3");
                    boton.setAttribute("type", "button");
                    linea.appendChild(boton); 
                    icon = document.createElement("i");
                    icon.setAttribute("class", "fa-solid fa-chevron-down"); 
                    boton.appendChild(icon); 

                } 
                   ult_orden = orden;
                $("#titulo").text(estado);
                   
            }
            catch(err){
                console.log(err)
            }           
        } 

        /******* Fin Services  *******/


        /******* DOM Events  *******/

        const handleSelectChange = (estado) => {
            getConceptos(estado);
            $("#titulo").text(estado);
        }
        const handleAddConcepto = (estado,rubro,desc,nivel,nat,identado,resaltado) => { 
               postConcepto(estado,rubro,desc,nivel,nat,identado,resaltado);
        }
        const handleChangeNivel = (nivel) => { 
               getRubros(nivel);
        }

        const handleAddEstado = () => {
          Swal.fire({
              title: 'Nombre del Estado',
              input: 'text',
              inputAttributes: {
                autocapitalize: 'off'
              },
              showCancelButton: true,
              confirmButtonText: 'Agregar',
              cancelButtonText: 'Cancelar',
              showLoaderOnConfirm: true,
              allowOutsideClick: false,
              inputValidator: (value) => {
                if (!value) {
                  return 'Ingresar nombre del Estado'
                }
              },
              preConfirm: (estado) => {
                if(estado == '') return false;

                return postEstadoApi(estado);
              },
              allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
              if (result==='True') { 

                Swal.fire({
                  title: result 
                });
                  
              } 
            })
        }

        function UserValidation(){
             let us = '';
               us = localStorage.getItem('user');  
           //    $('#usuarioLogueado').text(us); 
                console.log(us);
               if(us === null || us ==='null'){
                    location.href ="http://localhost/Projects/Artigraf/login.php"; 
               } 

        }
        /******* Fin DOM Events  *******/ 

        const init = () => {
            getEstados();
            handleChangeNivel('MAYOR');
        }

        init();
 
        $(document).ready(UserValidation); 
   </script>
  
  <body class="bg-light"> 
    
    <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/Projects/Artigraf/menu.php">  
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>
        <div class="d-flex flex-column  w-100">  
          <p style="height:8px;" class="form-check-label d-flex justify-content-left px-5" for="EstadoSelect">Tipo</p>
          <div class="d-flex flex-row pb-2 w-100"> 
              <select id="EstadoSelect" class="form-select m-1 d-flex justify-content-left" role="listbox" placeholder="Estado" onchange="handleSelectChange(this.value)" > 
              </select>
              <button class="btn btn-success d-flex justify-content-left mt-1" style="height:38px;" onclick="handleAddEstado()">
              <i class="fa-solid fa-plus mt-1"></i>
               </button>
          </div>
        </div>
        
        <div class="d-flex flex-column px-2 pb-2 w-100">  
          <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdNivel">Nivel</p>
          <select class="form-select m-1" placeholder="Nivel" id="IdNivel" onchange="handleChangeNivel(this.value)">
              <option class="option" value ="MAYOR">MAYOR</option>
              <option class="option" value ="FIJO">FIJO</option>
              <option class="option" value ="EF1">EF1</option>
              <option class="option" value ="EF2">EF2</option> 
              <option class="option" value ="EF3">EF3</option> 
              <option class="option" value ="EF4">EF4</option> 
              <option class="option" value ="EF5">EF5</option> 
              <option class="option" value ="EF6">EF6</option> 
              <option class="option" value ="EF7">EF7</option> 
              <option class="option" value ="EF8">EF8</option> 
          </select>
        </div>
        <div class="d-flex flex-column px-2 pb-0 w-100">  
          <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdRubro">Rubro</p>
          <div class="d-flex flex-row pb-2 w-100"> 
              <select id="IdRubro" class="form-select m-1 d-flex justify-content-left" role="listbox" placeholder="Rubro"> </select> 
          </div> 
        </div>
        <div class="d-flex flex-column px-2 pb-2 w-100">  
          <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdDesc">Descripción</p>
          <input class="form-control m-1" placeholder="Descripción" id="IdDesc"></input>
        </div>
         
        <div class="d-flex flex-column px-2 pb-3">
          <p style="height:8px;" class="form-check-label d-flex justify-content-center" for="pasivoSwitch">Positiva</p>
          <div class="d-flex justify-content-center">
            <input class="form-switch form-check-input d-flex justify-content-center" style="height:25px;" type="checkbox" id="pasivoSwitch" checked>
          </div>
        </div>
        <div class="d-flex flex-column px-2 pb-3">
          <p style="height:8px;" class="form-check-label d-flex justify-content-center" for="identadoSwitch">Identado</p>
          <div class="d-flex justify-content-center">
            <input class="form-switch form-check-input d-flex justify-content-center" style="height:25px;" type="checkbox" id="identadoSwitch" checked>
          </div>
        </div>
        
        <div class="d-flex flex-column px-2 pb-3">
          <p style="height:8px;" class="form-check-label d-flex justify-content-center" for="boldSwitch">Resaltado</p>
          <div class="d-flex justify-content-center">
            <input class="form-switch form-check-input d-flex justify-content-center" style="height:25px;" type="checkbox" id="boldSwitch" checked> 
          </div>
        </div>
 
        <button class="btn btn-success" onclick="handleAddConcepto($('#EstadoSelect').val(),$('#IdRubro').val(),$('#IdDesc').val(),$('#IdNivel').val(),$('#pasivoSwitch').is(':checked'),$('#identadoSwitch').is(':checked'),$('#boldSwitch').is(':checked'))">
                    Agregar
                  </button>
      </div>
    </nav> 
    <div style="padding-top:90px;"> </div>
    <main class="container" style="max-width:1420px;">  
        <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
          <div class="border-bottom d-flex flex-row">
            <h6 class="pt-2 w-75  d-flex justify-content-left text-muted" >Configurador de tipos de Estados Financieros</h6>
            <h3 class="w-100  d-flex justify-content-left text-primary" id="titulo">Conceptos</h3>
          </div>
          <table class="table" id="tabla">
            <thead>
              <tr class="d-flex flex-row">
                <th scope="col" style="width:100px;" class="text-center">Orden</th>
                <th scope="col" style="width:100px;" class="text-center">Nivel</th> 
                <th scope="col" style="width:300px;" class="text-center">Rubro</th> 
                <th scope="col" style="width:400px;" class="text-center">Descripción</th> 
                <th scope="col" style="width:100px;" class="text-center">Naturaleza</th> 
                <th scope="col" style="width:100px;" class="text-center">Identado</th> 
                <th scope="col" style="width:100px;" class="text-center">Resaltado</th> 
              </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
            </table>
        </div> 
        <div class="d-flex flex-row my-3 p-3 bg-body rounded shadow-sm">
          <div class="pb-2 mb-0 w-25"> </div>
           <div class="pb-2 mb-0 w-25"> </div>
        </div> 
    </main>
     
  </body>
</html>

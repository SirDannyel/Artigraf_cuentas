

    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARTIGRAF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   
    <script src="input-mask.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
   
   <script> 
    let i = 0 ;
    function addInput()
    {   
        i++; 
        var div = document.createElement("div");
        div.setAttribute("class", "d-flex text-muted p-3 border-bottom caja");
        var iddiv = "div"+i; 
        div.setAttribute("id", iddiv);
        document.getElementById("panel").appendChild(div); 

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "inputclave");  
        input.setAttribute("placeholder", "####.####.####.####.####.####.####"); 

         input.setAttribute("class", "form-control masked");  
         input.setAttribute("data-pattern", "****.****.****.****.****.****.****");  
        
        document.getElementById(iddiv).appendChild(input);  
         
        var boton = document.createElement("button");
        var node = document.createTextNode("Eliminar");
        boton.appendChild(node);
        boton.setAttribute("name", "deletebutton");   
        boton.onclick = function(){
        var el = document.getElementById(iddiv); 
           panel.removeChild(el);
        }; 
        boton.setAttribute("class", "btn btn-danger pl-3");
        document.getElementById(iddiv).appendChild(boton); 
      
        setMaskedInputListener(input);
         
    }

    function eliminar(identificador){
      panel.removeChild(document.getElementById(identificador));
    }

    function validar(){
      
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

      // fin 
      document.querySelectorAll('.caja').forEach( n => n.remove() );
    
       addInput();
       document.getElementById('boton_enviar').disabled=false;

    }
      

 
   </script>
  
  <body class="bg-light" onload="addInput()"> 
    
    <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> 
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>  
      </div>
    </nav> 
    <div style="padding-top:90px;"> </div>
    <main class="container">  
        <div class="my-3 p-5 bg-body rounded shadow-sm" id="panel">
          <div class="d-flex flex-row">
            <h6 class="border-bottom pb-2 mb-0 w-100">Clave</h6>
            <button class="btn btn-primary" onclick="addInput()"><i class="plus"></i>Agregar</button>
          </div>
        </div> 
        <div class="d-flex flex-row my-3 p-3 bg-body rounded shadow-sm">
          <div class="pb-2 mb-0 w-25"> </div>
          <button id='boton_enviar' class="btn btn-success w-100" onclick="validar();">Enviar</button>
          <div class="pb-2 mb-0 w-25"> </div>
        </div> 
    </main>
     
  </body>
</html>

 
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
    <script type="text/javascript" src="ValidaUser.js"></script>
  </head>
  
   <script>  
  
        const init = () => {  
               UserValidation();
        }

        let salida = 0;
        $(document).ready(init); 

        window.addEventListener("beforeunload", function (e) {
        var confirmationMessage = "lol"; 
        if(salida === 0){
         localStorage.setItem("user", null);
        }
       // (e || window.event).returnValue = confirmationMessage; //Gecko + IE
      //  return confirmationMessage;                            //Webkit, Safari, Chrome
      });

      function redirecciona(page){
            salida = 1;
        switch(page){
          case "1":
            location.href ="http://localhost/Artigraf/EF1.php";
            break;
          case "2": 
            location.href ="http://localhost/Artigraf/EF2.php";
            break;
          case "3": 
            location.href ="http://localhost/Artigraf/EF3.php";
            break;
          case "4": 
            location.href ="http://localhost/Artigraf/EF4.php";
            break;
          case "5": 
            location.href ="http://localhost/Artigraf/EF5.php";
            break;
          case "6": 
            location.href ="http://localhost/Artigraf/EF6.php";
            break;
          case "7": 
            location.href ="http://localhost/Artigraf/EF7.php";
            break;
          case "8": 
            location.href ="http://localhost/Artigraf/EF8.php";
            break;
        }
      }
   </script>
  
  <body class="bg-light"> 
    
    <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> 
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>  

      <!--  <button class="btn btn-sm btn-danger" onclick="logout()"><i class="fa-solid fa-power-off"></i></button> -->
         
      </div>
    </nav> 
    <div style="padding-top:150px;"> </div>
    <main class="container" style="max-width:600px;">  
        <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
          <div class="border-bottom d-flex flex-row">
            <h3 class="w-100  d-flex justify-content-center text-primary" id="titulo">SUBMENU CATEGORIAS</h3>
          </div>
          <div class="p-4">
            
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('1')" class="btn btn-outline-primary btn-lg px-3 w-100">EF1</button>   
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">       
                    <button onclick="redirecciona('2')" class="btn btn-outline-primary btn-lg px-3 w-100">EF2</button>  
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('3')" class="btn btn-outline-primary btn-lg px-3 w-100">EF3</button>   
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('4')" class="btn btn-outline-primary btn-lg px-3 w-100">EF4 </button>   
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('5')" class="btn btn-outline-primary btn-lg px-3 w-100">EF5 </button>   
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('6')" class="btn btn-outline-primary btn-lg px-3 w-100">EF6 </button>   
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('7')" class="btn btn-outline-primary btn-lg px-3 w-100">EF7 </button>   
                </div>
                <div class="d-flex flex-column px-1 pb-4 w-100">   
                    <button onclick="redirecciona('8')" class="btn btn-outline-primary btn-lg px-3 w-100">EF8 </button>   
                </div>
                

                <h6 class="pt-2 w-75  d-flex justify-content-left text-danger" id="mensaje" > </h6> 

          </div>
          
        </div> 
        <div class="d-flex flex-row fixed-bottom p-3 bg-body rounded shadow-sm">
          <div class="pb-2 mb-0 w-25"> </div>
           <div class="pb-2 mb-0 w-25">
            <p id="usuarioLogueado"></p>
         </div>
        </div> 
    </main>
     
  </body>
</html>

 
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
   
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 120px;
  height: 120px;
  margin: -76px 0 0 -76px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

.myDiv {
  display: none;
  text-align: center;
}
</style>
   <script>  

        /******* Apis  *******/ 
        const validaUserApi = (user,pass) => {   
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
        
                objXMLHttpRequest.open('POST', 'LoginDb.php');
                objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                objXMLHttpRequest.send("tipo="+"get"+"&user="+user+"&pass="+pass);
            });
        }
           
        /******* Fin Apis  *******/
   

        /******* Services  *******/
 
 
        const validaUser = async (user,pass ) => {
            try{
              
                document.getElementById("loader").style.display = "block";
              //  alert('user: '+user+' pass: '+pass ); 
                let titulo ='Accediendo';
                let resolucion = 'success';
                const response = await validaUserApi(user,pass);
              //   console.log("validaUser Response", response); 
             //    console.log("user", response); 
             
                  document.getElementById("loader").style.display = "none";
                 if(response == 'Error'){
                   titulo = 'El usuario y/o el password no son correctos';
                   resolucion = 'error';
                  Swal.fire({
                    position: 'center',
                    icon: resolucion,
                    title: titulo,
                    showConfirmButton: false,
                    timer: 2000
                  });
                 }else{
                    localStorage.setItem("user", response);
                 // alert('userLogueado: '+localStorage.getItem("user")); 
                 } 

                if(resolucion == 'success'){
                    location.href ="http://localhost/Artigraf/menu.php";

                }
  
            }
            catch(err){
                console.log(err)
            }           
        } 
         
 

        /******* Fin Services  *******/


        /******* DOM Events  *******/
 

  

        /******* Fin DOM Events  *******/ 
            /*
        const init = () => {
            getEstados();
            handleChangeNivel('MAYOR');
        }

        init();
       */
   </script>
  
  <body class="bg-light"> 
    
    <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> 
        <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a> 
           
      </div>
    </nav> 
    <div style="padding-top:150px;"> </div>
    <main class="container" style="max-width:600px;">  
        <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
          <div class="border-bottom d-flex flex-row">
            <h3 class="w-100  d-flex justify-content-center text-primary" id="titulo">Acceso</h3>
                <div id="loader" style="display:none;"></div>
          </div>
          
          <div class="p-4" >
            
                <div class="d-flex flex-column px-1 pb-2 w-100">  
                <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdUser">Usuario</p>
                <input class="form-control m-1" id="IdUser" value="Admin"> </input>
                </div>
                <div class="d-flex flex-column px-1 pb-2 w-100">  
                <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdPass">Contraseña</p>
                <input type="password" class="form-control m-1" id="IdPass"  value="admin"> </input>
                </div>
 
                <div class="d-flex flex-row-reverse">
                <button class="btn btn-success btn-md" onclick="validaUser($('#IdUser').val(),$('#IdPass').val()  )"> Ingresar </button>
                </div>

          </div>
          
        </div> 
        <div class="d-flex flex-row fixed-bottom p-3 bg-body rounded shadow-sm">
          <div class="pb-2 mb-0 w-25"> </div>
           <div class="pb-2 mb-0 w-25"> </div>
        </div> 
    </main>
     
  </body>
</html>

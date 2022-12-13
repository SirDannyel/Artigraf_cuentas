 
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
              //  alert('user: '+user+' pass: '+pass ); 
                let titulo ='Accediendo';
                let resolucion = 'success';
                const response = await validaUserApi(user,pass);
              //   console.log("validaUser Response", response); 
             //    console.log("user", response); 
                 if(response == 'Error'){
                   titulo = 'El usuario y/o el password no son correctos';
                   resolucion = 'error';
                 }else{
                    localStorage.setItem("user", response);
                 // alert('userLogueado: '+localStorage.getItem("user")); 
                 } 

                Swal.fire({
                  position: 'center',
                  icon: resolucion,
                  title: titulo,
                  showConfirmButton: false,
                  timer: 2000
                });
                if(resolucion == 'success')
                    location.href ="http://localhost/Projects/Artigraf/menu.php"; 
  
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
          </div>
          <div class="p-4">
            
                <div class="d-flex flex-column px-1 pb-2 w-100">  
                <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdUser">Usuario</p>
                <input class="form-control m-1" id="IdUser" value="Admin"> </input>
                </div>
                <div class="d-flex flex-column px-1 pb-2 w-100">  
                <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdPass">Contraseña</p>
                <input class="form-control m-1" id="IdPass"  value="admin"> </input>
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

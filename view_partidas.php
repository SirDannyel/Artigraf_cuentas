
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

  /*  function getEstados() {
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

                objXMLHttpRequest.open('GET', 'partidas_especiales.php');
            objXMLHttpRequest.send();
        });
    }*/

 /*   getEstados().then(
        data => { console.log('Success Response: ' + data)
            const myArr = JSON.parse(data);
            var select = document.getElementById("EstadoSelect");
            for(var i = 0; i < myArr.length; i++) {
                var opt = myArr[i].Cuenta_Contable;
                var el = document.createElement("option");
                el.textContent = opt;
                el.value = opt;
                select.appendChild(el);
            }
        },
        error => { console.log(error) }
    );*/

    /******* Apis  *******/

    const CuentasContablesApi = () => {

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

            objXMLHttpRequest.open('GET','partidas_especiales.php');
            objXMLHttpRequest.send();
        });
    }

    /******* Fin Apis  *******/

    const deleteChild = () => {
        $(".tr").remove();
        console.log('1');
    }

    /******* Services  *******/

    const getCuentasContables. = async () => {
        try{
            const response = await CuentasContablesApi;
            console.log("getCuentas Response", response);
            const myArr = JSON.parse(response);
            var select = document.getElementById("CuentaSelect");
            for(var i = 0; i < myArr.length; i++) {
                var opt = myArr[i].Cuenta_Contable;
                var el = document.createElement("option");
                el.textContent = opt;
                el.value = opt;
                select.appendChild(el);
            }
        }
        catch(err){
            console.log(err)
        }
    }

    /******* Fin Services  *******/

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
        getCuentasContables();
    }

    init();

</script>

<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>
        <select id="CuentaSelect" class="form-select m-1" role="listbox" placeholder="Cuenta">
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


</body>
</html>
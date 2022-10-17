
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

            objXMLHttpRequest.open('GET','http://localhost/Artigraf/partidas_especiales.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const PartidasEspeciales_Api = () => {

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

            objXMLHttpRequest.open('GET','http://localhost/Artigraf/getpartidas.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    /******* Fin Apis  *******/

    const deleteChild = () => {
        $(".tr").remove();
        console.log('1');
    }

    /******* Services  *******/

    const getCuentas = async (cuenta = $('#Cuenta').val() ) => {
        try{ 
            const response = await Cuentas_Api();

            const myArr = JSON.parse(response);

            const result = myArr.find( ({ Cuenta }) => Cuenta === cuenta);
            //const result2 = myArr.filter( ({ Cuenta }) => Cuenta.includes(cuenta));
            //console.log("getCuentas2", result2);
            //const Descripcion = result.CuentaDesc;
            $("#Descripcion").val(result.CuentaDesc);
            $("#Mayor").val(result.Mayor);
        }
        catch(err){
            console.log(err)
        }
    }


    const getPartidas = async () => {
        try {
            const response = await PartidasEspeciales_Api();

            const myArr = JSON.parse(response);
            //console.log("getCuentas", myArr);

            var tablabody = document.getElementById("tablabody");

            for (var i = 0; i < myArr.length; i++) {
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);

                var orden = myArr[i].Fecha;
                var campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = orden;
                campo.value = orden;
                linea.appendChild(campo);

                var opt = myArr[i].Descripcion;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:400px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = myArr[i].Cuenta;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = myArr[i].Cargos;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = myArr[i].Abonos;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = myArr[i].Movimientos;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
            }

            } catch (err)
            {
                console.log(err)
            }
        }


    /******* Fin Services  *******/

    const handleSelectChange = (cuenta) => {
        getCuentas(cuenta);
    }

    /******* Fin DOM Events  *******/



    const init = () => {
        getPartidas();
    }

    init();

</script>

<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>
        <input id="Cuenta" class="form-control m-1" placeholder="Cuenta" onchange="handleSelectChange(this.value)"></input>
        <input id="Descripcion" class="form-control m-1" placeholder="Descripcion"></input>
        <input id="Mayor" class="form-control m-1" placeholder="Mayor"></input>
        <input type=number id="Cargo" class="form-control m-1" placeholder="0.0"></input>
        <input type=number id="Abono" class="form-control m-1" placeholder="0.0"></input>
        <button class="btn btn-primary" ><i class="plus" ></i>Agregar</button>
    </div>
</nav>
<div style="padding-top:90px;"> </div>

<main class="container" style="max-width:1420px;">
    <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
        <div class="d-flex flex-row">
            <h3 class="border-bottom pb-2 mb-0 w-100  d-flex justify-content-center text-primary" id="titulo">Partidas Especiales</h3>
        </div>
        <table class="table" id="tabla">
            <thead>
            <tr class="d-flex flex-row">
                <th scope="col" style="width:150px;">Fecha</th>
                <th scope="col" style="width:400px;">Descripcion</th>
                <th scope="col" style="width:200px;">Cuenta</th>
                <th scope="col" style="width:150px;">Cargo</th>
                <th scope="col" style="width:150px;">Abono</th>
                <th scope="col" style="width:150px;">Movimiento</th>
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
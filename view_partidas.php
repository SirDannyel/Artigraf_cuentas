
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

    /******* Models ************/

    class PartidasEspeciales {
        // Propiedad (variable de clase sin valor definido)
        fecha;
        descripcion;
        cuenta;
        cargo;
        abono;
        movimiento;
        constructor(fecha,descripcion,cuenta,cargo,abono,movimiento) {
            // Hacemos referencia a la propiedad name del objeto instanciado
            this.fecha = fecha;
            this.descripcion = descripcion;
            this.cuenta = cuenta;
            this.cargo = cargo;
            this.abono = abono;
            this.movimiento = movimiento;
        }
    }

    class cuentasContables {
        // Propiedad (variable de clase sin valor definido)
        Cuenta;
        CuentaDesc;
        Mayor;

        constructor(cuenta,cuentaDesc,mayor) {
            // Hacemos referencia a la propiedad name del objeto instanciado
            this.Cuenta = cuenta;
            this.CuentaDesc = cuentaDesc;
            this.Mayor = mayor;
        }
    }

    let partidasdia = [];
    let cuentascontables = [];

    /******* Servicios  *******/

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

            objXMLHttpRequest.open('GET','partidas_especiales.php');
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
            //var url = "http://localhost/Artigraf/getpartidas.php";
            //var parametro = "?fecha=";
            //var fecha = n;
            //var UrltoSend = url + parametro + url;

            objXMLHttpRequest.open('GET', 'getpartidas.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const InsertPartidas_Api = (cuenta,descripcion,cargo,abono,mayor,movimiento) => {

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

            objXMLHttpRequest.open('POST','partidas_especiales.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send("cuenta="+cuenta+"&descripcion="+descripcion+"&cargo="+cargo+"&abono="+abono+"&mayor="+mayor+"&mov="+movimiento);
        });
    }

    /******* Hora *******/

    const fecha = new Date("2022-10-19");
    const fechaZona = fecha.toLocaleString("es-MX", {timeZone: "America/Monterrey"});
    const fechaNueva = fechaZona.slice(0,10);

    /******* Controladores y funciones *******/

    const deleteChild = () => {
        $(".tr").remove();
    }

    const formato = new Intl.NumberFormat('en-MX', {
        style: 'currency',
        currency: 'MXN',
        minimumFractionDigits: 2
    })

   function formatter(value) {
        const formatter = new Intl.NumberFormat('en-MX', {
            style: 'currency',
            currency: 'MXN',
            minimumFractionDigits: 2
        })
        const numero = formatter.format(value);
        var strNumero = numero.replace("MX","");
        return strNumero
    }

    const getCuentas = async () => {
        try{
            const response = await Cuentas_Api();
            const myArr = JSON.parse(response);

            for (var i = 0; i < myArr.length; i++) {
                var cuentas = myArr[i].Cuenta;
                var cuentaSN = cuentas.trim();
                const nuevaCuenta = new cuentasContables(cuentaSN,myArr[i].CuentaDesc,myArr[i].Mayor);
                cuentascontables.push(nuevaCuenta);
            }
     /*       const result = cuentascontables.find( ({ Cuenta }) => Cuenta === cuenta);
            //const result2 = myArr.filter( ({ Cuenta }) => Cuenta.includes(cuenta));
            //console.log("getCuentas2", result2);
            //const Descripcion = result.CuentaDesc;
            $("#Descripcion").val(result.CuentaDesc);
            $("#Mayor").val(result.Mayor);*/
        }
        catch(err){
            console.log(err)
        }
    }


    const getPartidas = async () => {

        try {
            const response = await PartidasEspeciales_Api();

            const myArr = JSON.parse(response);
             //console.log("getCuentas", response);
            for (var i = 0; i < myArr.length; i++) {

            const nuevaPartida = new PartidasEspeciales(fechaNueva,myArr[i].descripcion,myArr[i].cuenta,formatter(myArr[i].cargo),formatter(myArr[i].abono),formatter(myArr[i].movimiento));
                partidasdia.unshift(nuevaPartida);
            }

            if (!partidasdia.length){
                const nuevaPartida = new PartidasEspeciales("Sin Registro","Sin Registro","Sin Registro","Sin Registro","Sin Registro","Sin Registro");
                partidasdia.push(nuevaPartida);
             }

            var tablabody = document.getElementById("tablabody");

            for (var i = 0; i < partidasdia.length; i++) {
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);

                var opt = partidasdia[i].fecha;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                var opt = partidasdia[i].descripcion;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:370px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].cuenta;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].cargo;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].abono;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].movimiento;
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

    const getPartidaslocal = async () => {

        try {
            deleteChild ();

            var tablabody = document.getElementById("tablabody");

            for (var i = 0; i < partidasdia.length; i++) {
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);

                var opt = partidasdia[i].fecha;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                var opt = partidasdia[i].descripcion;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:370px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].cuenta;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:200px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].cargo;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].abono;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:150px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                opt = partidasdia[i].movimiento;
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

    /******* Eventos *******/
    function toggleButton() {
        var campo1 = $("#Cuenta").val();
        var campo2 = $("#Descripcion").val();
        var campo3 = $("#Mayor").val();
        var campo4 = $("#Cargo").val();
        var campo5 = $("#Abono").val();

        if (campo1 && campo2 && campo3 && campo4 && campo5) {
            $("#submitButton").removeAttr("disabled");
        } else {
            $("#submitButton").attr("disabled", "disabled");
        }
    }

    const handleSelectChange = (cuenta) => {
        if (cuenta) {
            //getCuentas(cuenta);
            //getCuentas();
            const result = cuentascontables.find( ({ Cuenta }) => Cuenta === cuenta);
            //const result2 = cuentascontables.filter( ({ Cuenta }) => Cuenta.includes(cuenta));
            //console.log("getCuentas2", result);
            //const Descripcion = result.CuentaDesc;
            $("#Descripcion").val(result.CuentaDesc);
            $("#Mayor").val(result.Mayor)
        } else {
            $("#Descripcion").val("");
            $("#Mayor").val("");
        }
    }

    const handleInsertPartida = (cuenta,descripcion,cargo,abono,mayor) => {
        try {
            var mov = cargo - abono;
            InsertPartidas_Api (cuenta,descripcion,cargo,abono,mayor,mov.toFixed(2));

            const nuevaPartida = new PartidasEspeciales(fechaNueva,descripcion,cuenta,formatter(cargo),formatter(abono),formatter(mov));

            if (partidasdia[0].descripcion === "Sin Registro") {
                partidasdia.shift();
                partidasdia.unshift(nuevaPartida);
            } else {
                partidasdia.unshift(nuevaPartida);
            }

            $("#Cuenta").val("");
            $("#Descripcion").val("");
            $("#Mayor").val("");
            $("#Cargo").val("");
            $("#Abono").val("");

            getPartidaslocal();
            $("#submitButton").attr("disabled", "disabled");
        } catch (err) {
            console.log(err)
        }

        Swal.fire({
            icon: 'success',
            title: 'Registro Agregado',
            showConfirmButton: false,
            timer: 1500
        });
    }

    /******* Fin Events  *******/

    const init = () => {
        //Iniciar tabla vacio
        getCuentas();
        getPartidas();
    }

    init();

</script>

<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
    <div class="container-fluid align-items-center">
        <a class="navbar-brand" href="#">
            <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>

        <form>
            <div class="form-group mb-2 row align-items-center">

                <div class="form-group col-md">
                    <label for="InputCuenta">Cuenta</label>
                    <input type="text" id="Cuenta" class="form-control" placeholder="1201,0001,0001,1351"  onchange="handleSelectChange(this.value)"></input>
                </div>

                <div class="form-group col-md-4">
                    <label for="InputDescripcion">Descripción</label>
                    <input id="Descripcion" class="form-control-plaintext" readonly placeholder="COMERCIALIZADORA DE LACTEOS Y DERIV"></input>
                </div>

                <div class="form-group col-md-1">
                    <label for="InputMayor">Mayor</label>
                    <input id="Mayor" class="form-control-plaintext" readonly placeholder="1201"></input>
                </div>

                <div class="col-md flex-column">
                    <label for="InputCargo">Cargo</label>
                    <input type=number id="Cargo" class="form-control" placeholder="1500"></input>
                </div>

                <div class="col-md flex-column">
                    <label for="InputAbono">Abono</label>
                    <input type=number id="Abono" class="form-control" onkeyup="toggleButton()" placeholder="1000"></input>
                </div>
                <div class="col-md mt-4 flex-column">
                    <button id="submitButton" class="btn btn-success" onclick="handleInsertPartida($('#Cuenta').val(),$('#Descripcion').val(),$('#Cargo').val(),$('#Abono').val(),$('#Mayor').val())" disabled>Agregar</button>
                </div>
            </div>

        </form>

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
                <th scope="col" style="width:370px;">Descripcion</th>
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

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

    const fecha = new Date("2022-10-19");
    const fechaZona = fecha.toLocaleString("es-MX", {timeZone: "America/Monterrey"});
    const fechaNueva = fechaZona.slice(0,10);

    let partidasdia = [];
    let cuentascontables = [];

    /******* Servicios *******/
    const CuentasApi = () => {
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

            objXMLHttpRequest.open('GET', 'getpartidas.php');
            objXMLHttpRequest.send();
        });
    }

    const InsertPartidas_Api = (cuenta,descripcion,cargo,abono,mayor) => {

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
            objXMLHttpRequest.send("cuenta="+cuenta+"&descripcion="+descripcion+"&cargo="+cargo+"&abono="+abono+"&mayor="+mayor);
        });
    }


    /******* Fin Services  *******/
    const deleteChild = () => {
        $(".tr").remove();
        console.log('1');
    }
    /******* Services  *******/
    const getCuentas = async (cuenta) => {
        try{
            const response = await CuentasApi();
            const myArr = JSON.parse(response);

            for (var i = 0; i < myArr.length; i++) {
                var cuentas = myArr[i].Cuenta;
                var cuentaSN = cuentas.trim();
                const nuevaCuenta = new cuentasContables(cuentaSN,myArr[i].CuentaDesc,myArr[i].Mayor);
                cuentascontables.push(nuevaCuenta);
            }
            const result = cuentascontables.find( ({ Cuenta }) => Cuenta === cuenta);
            //console.log("getCuentas Response", cuentascontables);
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
            //console.log("getCuentas", response);

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

    const handleInsertPartida = (cuenta,descripcion,cargo,abono,mayor) => {
        try {
            deleteChild ();
            InsertPartidas_Api (cuenta,descripcion,cargo,abono,mayor);

            var mov = cargo - abono;
            const nuevaPartida = new PartidasEspeciales(fechaNueva,descripcion,cuenta,cargo,abono,mov);

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

            //PartidasEspeciales_Api();
            getPartidas();

            Swal.fire({
                icon: 'success',
                title: 'Registro Agregado',
                showConfirmButton: false,
                timer: 1500
            });
        } catch (err)
        {
            console.log(err)
        }

    }

    /******* Fin Services  *******/

    /******* Fin DOM Events  *******/

    const handleSelectChange = (cuenta) => {
        getCuentas(cuenta);
    }

    const init = () => {
        //Iniciar tabla vacio
        const nuevaPartida = new PartidasEspeciales("Sin Registro","Sin Registro","Sin Registro","Sin Registro","Sin Registro","Sin Registro");
        partidasdia.unshift(nuevaPartida);

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
        <input id="Descripcion" class="form-control m-1" placeholder="Descripción"></input>
        <input id="Mayor" class="form-control m-1" placeholder="Mayor"></input>
        <input id="Cargo" type="number" class="form-control m-1" placeholder="Abono"></input>
        <input id="Abono" type="number" class="form-control m-1" placeholder="Cargo"></input>
        <button class="btn btn-primary" onclick="handleInsertPartida($('#Cuenta').val(),$('#Descripcion').val(),$('#Cargo').val(),$('#Abono').val(),$('#Mayor').val())" ><i class="plus"></i>Agregar</button>
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
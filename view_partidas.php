
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
    /******* Models ************/
    class PartidasEspeciales {
        // Propiedad (variable de clase sin valor definido)
        fecha;
        descripcion;
        cuenta;
        cargo;
        abono;
        movimiento;
        Linea;
        constructor(fecha,descripcion,cuenta,cargo,abono,movimiento,linea) {
            // Hacemos referencia a la propiedad name del objeto instanciado
            this.fecha = fecha;
            this.descripcion = descripcion;
            this.cuenta = cuenta;
            this.cargo = cargo;
            this.abono = abono;
            this.movimiento = movimiento;
            this.Linea = linea;
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
    var contador_linea = 0;
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

    const PartidasEspeciales_Api = (fechaini,fechafin) => {
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
            var url = "http://localhost/Artigraf/getpartidas.php";
            var parametro = "?fechaini=";
            var parametro2 = "&fechafin=";
            var fecha1 = fechaini;
            var fecha2 = fechafin;
            var UrltoSend = url + parametro + fecha1 + parametro2 + fechafin;
            objXMLHttpRequest.open('GET', UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const InsertPartidas_Api = (fecha,cuenta,descripcion,cargo,abono,mayor,movimiento) => {
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
            objXMLHttpRequest.send("fecha="+fecha+"&cuenta="+cuenta+"&descripcion="+descripcion+"&cargo="+cargo+"&abono="+abono+"&mayor="+mayor+"&mov="+movimiento);
        });
    }

    const DeletePartidas_Api = (linea) => {
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
            objXMLHttpRequest.open('POST','getPartidas.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send("linea="+linea);
        });
    }

    /******* Hora *******/
    function formatterDate(value) {
        const fecha = value;
        const fechaZona = fecha.toLocaleString("es-MX", {timeZone: "America/Monterrey"});
        const fechaNueva = fechaZona.slice(0,10);
        return fechaNueva
        }

  //  formato de fecha en inputs

            const fecha = new Date();

            var ultimoDia = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 0);
            const fechaZona = ultimoDia.toLocaleString("es-MX", {timeZone: "America/Monterrey"});
            var Ultimo_Dia = fechaZona.slice(0,2);

            var ffechaInicial = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) +"-"+ '01';
            var ffechaFinal = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) +"-"+Ultimo_Dia;

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
    const getPartidas = async (fechaini,fechafin) => {
        try {
            const response = await PartidasEspeciales_Api(fechaini,fechafin);
            const myArr = JSON.parse(response);
            //console.log("getCuentas", response);
            for (var i = 0; i < myArr.length; i++) {
                const nuevaPartida = new PartidasEspeciales(formatterDate(myArr[i].fecha.date),myArr[i].descripcion,myArr[i].cuenta,formatter(myArr[i].cargo),formatter(myArr[i].abono),formatter(myArr[i].movimiento),myArr[i].linea);
                partidasdia.unshift(nuevaPartida);
            }
            if (!partidasdia.length){
                const nuevaPartida = new PartidasEspeciales("Sin Registro","Sin Registro","Sin Registro","Sin Registro","Sin Registro","Sin Registro", contador_linea);
                partidasdia.unshift(nuevaPartida);
            }
            getPartidas_Table();
        } catch (err)
        {
            console.log(err)
        }
    }

    const getPartidas_Table = async () => {
        try {
            deleteChild ();
            var tablabody = document.getElementById("tablabody");
            var contador = 1;
            for (var i = 0; i < partidasdia.length; i++) {
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);
                var opt = partidasdia[i].fecha;
                var campo = document.createElement("td");
                campo.setAttribute("style", "width:10%;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = partidasdia[i].descripcion;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:32%;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                var cuenta = partidasdia[i].cuenta;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:25%;");
                campo.textContent = cuenta;
                campo.value = cuenta;
                linea.appendChild(campo);
                opt = partidasdia[i].cargo;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:10%;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = partidasdia[i].abono;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:10%;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = partidasdia[i].movimiento;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:10%;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                var boton = document.createElement("button");
                boton.setAttribute("name",partidasdia[i].cuenta);
                boton.setAttribute("id",partidasdia[i].Linea);
                boton.onclick = function() {
                handleDeletePartida(this.id);
    /*                Swal.fire({
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
                            handleDeletePartida(this.id);
                            //console.log(indice);
                            Swal.fire(
                                'Eliminado!',
                                'Registro Eliminado.',
                                'success'
                            )
                        }
                    });*/
                };
                boton.setAttribute("class", "btn btn-outline-danger px-3");
                boton.setAttribute("type", "button");
                linea.appendChild(boton);
                var icon = document.createElement("i");
                icon.setAttribute("class", "fa-solid fa-close");
                boton.appendChild(icon);

            }
        } catch (err)
        {
            console.log(err)
        }
    }
    /******* Eventos *******/
    function toggleButton() {
        var campo6 = $("#Fecha").val();
        var campo1 = $("#Cuenta").val();
        var campo2 = $("#Descripcion").val();
        var campo3 = $("#Mayor").val();
        var campo4 = $("#Cargo").val();
        var campo5 = $("#Abono").val();
        if (campo1 && campo1 && campo2 && campo3 && (campo4 || campo5)) {
            $("#submitButton").removeAttr("disabled");
        } else {
            $("#submitButton").attr("disabled", "disabled");
        }
    }
    const handleSelectChange = (cuenta) => {

        if (cuenta) {
            const result = cuentascontables.find( ({ Cuenta }) => Cuenta === cuenta);
            //const result2 = cuentascontables.filter( ({ Cuenta }) => Cuenta.includes(cuenta));
            //console.log("getCuentas2", result);
            $("#Descripcion").val(result.CuentaDesc);
            $("#Mayor").val(result.Mayor);
        } else {
            $("#Descripcion").val("");
            $("#Mayor").val("");
        }
    }
    const handleInsertPartida =  async (fecha,cuenta,descripcion,cargo,abono,mayor) => {
        try {
            var  mov = abono - cargo;
            const response = await InsertPartidas_Api (fecha,cuenta,descripcion,cargo,abono,mayor,mov);
            const myArr = JSON.parse(response);
            //console.log(myArr);
            //console.log(myArr[0].id);

            if (partidasdia[0].descripcion === "Sin Registro") {
                partidasdia.shift();
                const nuevaPartida = new PartidasEspeciales(fecha,descripcion,cuenta,formatter(cargo),formatter(abono),formatter(mov),myArr[0].id);
                partidasdia.push(nuevaPartida);
            } else {

                const nuevaPartida = new PartidasEspeciales(fecha,descripcion,cuenta,formatter(cargo),formatter(abono),formatter(mov),myArr[0].id);
                partidasdia.unshift(nuevaPartida);
            }

            $("#Cuenta").val("");
            $("#Descripcion").val("");
            $("#Mayor").val("");
            $("#Cargo").val("0.00");
            $("#Abono").val("0.00");
            $("#submitButton").attr("disabled", "disabled");

            getPartidas_Table();
            //partidasdia = [];

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
    const handleDeletePartida = (linea) => {
    try{
               var line = linea;
               var lin = Number(linea);
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

                            let indice = partidasdia.findIndex(linea => linea.Linea === line);
                            partidasdia.splice(indice, 1);
                            getPartidas_Table();
                            DeletePartidas_Api(lin);
                            Swal.fire(
                                'Eliminado!',
                                'Registro Eliminado.',
                                'success'
                            )
                        }
                    });
        }
        catch (err){
        console.log(err)
        }
    }

    const handleFiltro = (fechaIni, fechaFin) => {
           partidasdia = [];
           getPartidas(fechaIni,fechaFin);

    }
    /******* Fin Events  *******/
    const init = () => {

        //Iniciar tabla vacio
        getCuentas();
        getPartidas(ffechaInicial,ffechaFinal);
    }

    init();
    $(document).ready(UserValidation);

</script>
<body class="bg-light">
<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>

        <div class="row align-items-center">

        <div class="w-100"></div>
            <div class="col flex-column">
                <label for="InputFecha">Fecha</label>
                <input type="date" id="Fecha" class="form-control"></input>
            </div>
            <div class="col flex-column">
                <label for="InputCuenta">Cuenta</label>
                <input type="text" id="Cuenta" class="form-control" placeholder="####,####,####,####"  onchange="handleSelectChange(this.value)"></input>
            </div>
            <div class="col-md-4">
                <label for="InputDescripcion">Descripción</label>
                <input id="Descripcion" class="form-control" ></input>
            </div>
            <div class="col-md-1">
                <label for="InputMayor">Mayor</label>
                <input id="Mayor" class="form-control" ></input>
            </div>
            <div class="col flex-column">
                <label for="InputCargo">Cargo</label>
                <input type=number id="Cargo" class="form-control" value="0.00" onkeyup="toggleButton()"></input>
            </div>
            <div class="col flex-column">
                <label for="InputAbono">Abono</label>
                <input type=number id="Abono" class="form-control" value="0.00"  onkeyup="toggleButton()"></input>
            </div>
            <div class="col mt-4 flex-column">
                <button id="submitButton" class="btn btn-success" onclick="handleInsertPartida($('#Fecha').val(),$('#Cuenta').val(),$('#Descripcion').val(),$('#Cargo').val(),$('#Abono').val(),$('#Mayor').val())" disabled>Agregar</button>
            </div>
        </div>
    </div>
</nav>
<div style="padding-top:90px;"> </div>
<main class="container" style="max-width:1420px;">
    <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
    <div class="row align-items-center">
            <div class="col-md-2  flex-column">
                <label for="InputFechaInicial">Fecha inicial:</label>
                <input type="date" id="FechaInicial" class="form-control"></input>
            </div>
            <div class="col-md-2 flex-column">
                <label for="InputFechaFinal">Fecha final:</label>
                <input type="date" id="FechaFinal" class="form-control"></input>
            </div>
            <div class="col mt-4 flex-column">
                <button id="submitButtonFiltro" class="btn btn-success" onclick="handleFiltro($('#FechaInicial').val(),$('#FechaFinal').val())">Filtrar</button>
            </div>
            <script>
            $("#FechaFinal").val(ffechaFinal);
            $("#FechaInicial").val(ffechaInicial);
            </script>
    </div>
        <div class="d-flex flex-row">
            <h3 class="border-bottom pb-2 mb-0 w-100  d-flex justify-content-center text-primary" id="titulo">Partidas Especiales</h3>
        </div>
        <table class="table" id="tabla">
            <thead>
            <tr class="d-flex flex-row">
                <th scope="col" style="width:10%;">Fecha</th>
                <th scope="col" style="width:32%;">Descripcion</th>
                <th scope="col" style="width:25%;">Cuenta</th>
                <th scope="col" style="width:10%;">Cargo</th>
                <th scope="col" style="width:10%;">Abono</th>
                <th scope="col" style="width:10%;">Movimiento</th>
            </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
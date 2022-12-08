<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rango Cuentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/caf35569f5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="input-mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style type="text/css">
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
</head>

<script>
    /******* Models ************/
    let RangosCuentas = [];
    let EF1 = [] ;
    let EF2 = [];
    let EF3 = [];
    let EF4 = [];
    let EF5 = [];
    let EF6 = [];
    let EF7 = [];
    let EF8 = [];

    /******* Servicios  *******/
    const RangosCuentas_Api = () => {
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
            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=RangoCuentas";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET', UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const EF1Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF1";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF2Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF2";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF3Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF3";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF4Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF4";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF5Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF5";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF6Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF6";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF7Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF7";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    const EF8Select_Api = () => {
        return new Promise(function (resolve, reject) {
            const objXMLHttpRequest = new XMLHttpRequest();
            objXMLHttpRequest.onreadystatechange = function () {
                if (objXMLHttpRequest.readyState === 4) {
                    if (objXMLHttpRequest.status == 200) {
                        resolve(objXMLHttpRequest.responseText);
                        //console.log(data);
                    } else {
                        reject('Error Code: ' +  objXMLHttpRequest.status + ' Error Message: ' + objXMLHttpRequest.statusText);
                    }
                }
            }

            var url = "http://localhost/Artigraf/getRangosCuentas.php";
            var Parametro = "?tipo=EF8";
            var UrltoSend = url + Parametro;

            objXMLHttpRequest.open('GET',UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send();
        });
    }

    /******* Controladores y funciones *******/
    const deleteChild = () => {
        $(".tr").remove();
    }

    const get_EFs = async () => {
        try {
            const responseEF1 = await EF1Select_Api();
            EF1 = JSON.parse(responseEF1);
            var selectEF1 = document.getElementById("IdEf1");
            var selectEF1_Desc = document.getElementById("EF1");

            for (let ef1 of EF1) {
                var o = document.createElement("option");
                o.text = ef1.EF1;
                o.value = ef1.EF1;
                selectEF1.appendChild(o);

                var opt = document.createElement("option");
                opt.text = ef1.EF1_Desc;
                opt.value = ef1.EF1_Desc;
                selectEF1_Desc.appendChild(opt);

            }

            const responseEF2 = await EF2Select_Api();
            EF2 = JSON.parse(responseEF2);
            var selectEF2 = document.getElementById("IdEf2");
            var selectEF2_Desc = document.getElementById("EF2");

            for (let ef2 of EF2) {
                var option2 = document.createElement("option");
                option2.text = ef2.EF2;
                option2.value = ef2.EF2;
                selectEF2.appendChild(option2);

                var opt2 = document.createElement("option");
                opt2.text = ef2.EF2_Desc;
                opt2.value = ef2.EF2_Desc;
                selectEF2_Desc.appendChild(opt2);

            }

            const responseEF3 = await EF3Select_Api();
            EF3 = JSON.parse(responseEF3);
            var selectEF3 = document.getElementById("IdEf3");
            var selectEF3_Desc = document.getElementById("EF3");

            for (let ef3 of EF3) {
                var option3 = document.createElement("option");
                option3.text = ef3.EF3;
                option3.value = ef3.EF3;
                selectEF3.appendChild(option3);

                var opt3 = document.createElement("option");
                opt3.text = ef3.EF3_Desc;
                opt3.value = ef3.EF3_Desc;
                selectEF3_Desc.appendChild(opt3);

            }

            const responseEF4 = await EF4Select_Api();
            EF4 = JSON.parse(responseEF4);
            var selectEF4 = document.getElementById("IdEf4");
            var selectEF4_Desc = document.getElementById("EF4");

            for (let ef4 of EF4) {
                var option4 = document.createElement("option");
                option4.text = ef4.EF4;
                option4.value = ef4.EF4;
                selectEF4.appendChild(option4);

                var opt4 = document.createElement("option");
                opt4.text = ef4.EF4_Desc;
                opt4.value = ef4.EF4_Desc;
                selectEF4_Desc.appendChild(opt4);

            }

            const responseEF5 = await EF5Select_Api();
            EF5 = JSON.parse(responseEF5);
            var selectEF5 = document.getElementById("IdEf5");
            var selectEF5_Desc = document.getElementById("EF5");

            for (let ef5 of EF5) {
                var option5 = document.createElement("option");
                option5.text = ef5.EF5;
                option5.value = ef5.EF5;
                selectEF5.appendChild(option5);

                var opt5 = document.createElement("option");
                opt5.text = ef5.EF5_Desc;
                opt5.value = ef5.EF5_Desc;
                selectEF5_Desc.appendChild(opt5);

            }

            const responseEF6 = await EF6Select_Api();
            EF6 = JSON.parse(responseEF6);
            var selectEF6 = document.getElementById("IdEf6");
            var selectEF6_Desc = document.getElementById("EF6");

            for (let ef6 of EF6) {
                var option6 = document.createElement("option");
                option6.text = ef6.EF6;
                option6.value = ef6.EF6;
                selectEF6.appendChild(option6);

                var opt6 = document.createElement("option");
                opt6.text = ef6.EF6_Desc;
                opt6.value = ef6.EF6_Desc;
                selectEF6_Desc.appendChild(opt6);

            }

            const responseEF7 = await EF7Select_Api();
            EF7 = JSON.parse(responseEF7);
            var selectEF7 = document.getElementById("IdEf7");
            var selectEF7_Desc = document.getElementById("EF7");

            for (let ef7 of EF7) {
                var option7 = document.createElement("option");
                option7.text = ef7.EF7;
                option7.value = ef7.EF7;
                selectEF7.appendChild(option7);

                var opt7 = document.createElement("option");
                opt7.text = ef7.EF7_Desc;
                opt7.value = ef7.EF7_Desc;
                selectEF7_Desc.appendChild(opt7);

            }

            const responseEF8 = await EF8Select_Api();
            EF8 = JSON.parse(responseEF8);
            var selectEF8 = document.getElementById("IdEf8");
            var selectEF8_Desc = document.getElementById("EF8");

            for (let ef8 of EF8) {
                var option8 = document.createElement("option");
                option8.text = ef8.EF8;
                option8.value = ef8.EF8;
                selectEF8.appendChild(option8);

                var opt8 = document.createElement("option");
                opt8.text = ef8.EF8_Desc;
                opt8.value = ef8.EF8_Desc;
                selectEF8_Desc.appendChild(opt8);

            }

        } catch (err) {
            console.log(err)
        }
    }


        const getRangosCuentas = async () => {
        try {

            const response = await RangosCuentas_Api();
            RangosCuentas = JSON.parse(response);
            // console.log(RangosCuentas);
            getRangosCuentas_Table();
        } catch (err)
        {
            console.log(err)
        }
    }

    const getRangosCuentas_Table = async () => {
        try {
            deleteChild ();

            /*const nuevoArr = myArr.filter( ({ Cuenta }) => Cuenta.includes(cuenta));*/
            var tablabody = document.getElementById("tablabody");
            for (var i = 0; i < RangosCuentas.length; i++) { //cambiar myArr por nuevoArr.length
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);
                var cuenta = RangosCuentas[i].EF1; //cambiar por nuevoArr con todos los campos
                var campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = cuenta;
                campo.value = cuenta;
                linea.appendChild(campo);
                var opt = RangosCuentas[i].EF1Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].CuentaInicio;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:250px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].CuentaFin;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:250px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF2;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF2Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF3;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF3Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF4;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF4Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF5;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF5Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF6;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF6Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF7;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF7Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF8;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:70px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                opt = RangosCuentas[i].EF8Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:380px;");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);
                var boton = document.createElement("button");
                boton.setAttribute("name",RangosCuentas[i].Orden);
                boton.setAttribute("id", cuenta);
                boton.onclick = function(){
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "Se descartará el registro",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Descartar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                '¡Descartado!',
                                'Registro Descartado.',
                                'Success'
                            )
                        }
                    });
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

    const init = () => {
            get_EFs();
            getRangosCuentas();
    }

    //Mandar a llamar getRangosCuentas
    init();
    /******* Fin Apis  *******/
</script>
<!-- VISTA -->
<body class="bg-light">
<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">

    <div class="container-fluid align-items-center">
        <a class="navbar-brand" href="#">
            <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>

        <div class="row  align-items-center w-100">
            <div class="col">
                <h3 class="d-flex justify-content-center text-primary" id="titulo">Rangos Cuentas Contables</h3>
            </div>
            <div class="col-4">
                <input class="form-control" placeholder="Search" id="CuentaSearch"></input>
            </div>
            <script>
                $(document).ready(function(){
                    $('#CuentaSearch').mask('0000,0000,0000,0000,0000,0000');
                });
            </script>

            <div class="col-1">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>

        </div>

    </div>
</nav>
<div style="padding-top:70px;"> </div>
<main class="container mt-4" style="max-width:1840px">

<div class="my-3 p-2 shadow-sm border-bottom bg-body rounded" id="panel">

    <div class="row  align-items-center w-100">

        <div class="col-4">
            <label>Cuenta Inicio</label>
            <input class="form-control form-control-sm" id="CuentaInicio"></input>
        </div>
        <div class="col-4">
            <label>Cuenta Fin</label>
            <input class="form-control form-control-sm" id="CuentaFin"></input>
        </div>
        <script>
            $(document).ready(function(){
                $('#CuentaInicio').mask('0000,0000,0000,0000,0000,0000');
                $('#CuentaFin').mask('0000,0000,0000,0000,0000,0000');
            });
        </script>
        <div class="col">
            <label>Orden</label>
            <input class="form-control form-control-sm" id="Orden"></input>
        </div>

        <div class="col mt-4">
            <button type="submit" class="btn btn-primary">Agregar Rango</button>
        </div>

        <div class="col flex-col mt-4">
            <button type="button"  class="btn btn-success" >Agregar Nivel</button>
        </div>

    </div>
    <div class="row flex-row mb-2 align-items-center rounded w-100">
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf1">EF1</p>
            <select class="form-select form-select-sm" id="IdEf1" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF2</p>
            <select class="form-select form-select-sm" id="IdEf2" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf3">EF3</p>
            <select class="form-select form-select-sm" id="IdEf3" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf4">EF4</p>
            <select class="form-select form-select-sm" id="IdEf4" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf5">EF5</p>
            <select class="form-select form-select-sm" id="IdEf5" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf6">EF6</p>
            <select class="form-select form-select-sm" id="IdEf6" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf7">EF7</p>
            <select class="form-select form-select-sm" id="IdEf7" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf8">EF8</p>
            <select class="form-select form-select-sm" id="IdEf8" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="text-center w-100 mt-1 "><h6>DESCRIPCIONES</h6></div>

        <!-- AQUI FILAS DE INPUTS EF Descripciones -->
        <div class="col">
            <select class="form-select form-select-sm" id="EF1" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="col">
            <select class="form-select form-select-sm" id="EF2" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="col">
            <select class="form-select form-select-sm" id="EF3" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="col">
            <select class="form-select form-select-sm" id="EF4" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <select class="form-select form-select-sm" id="EF5" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <select class="form-select form-select-sm" id="EF6" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <select class="form-select form-select-sm" id="EF7" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <select class="form-select form-select-sm" id="EF8" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>
    </div>
</div>

    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar shadow-sm border-bottom bg-body rounded">

        <table class="table" id="tabla">
            <thead >
            <tr class="d-flex flex-row">
                <th class="th" style="width:70px;">EF1</th>
                <th class="th" style="width:380px;">Descripción EF1</th>
                <th class="th" style="width:250px;">Cuenta Inicio</th>
                <th class="th" style="width:250px;">Cuenta Fin</th>
                <th class="th" style="width:70px;">EF2</th>
                <th class="th" style="width:380px;">Descripción EF2</th>
                <th class="th" style="width:70px;">EF3</th>
                <th class="th" style="width:380px;">Descripción EF3</th>
                <th class="th" style="width:70px;">EF4</th>
                <th class="th" style="width:380px;">Descripción EF4</th>
                <th class="th" style="width:70px;">EF5</th>
                <th class="th" style="width:380px;">Descripción EF5</th>
                <th class="th" style="width:70px;">EF6</th>
                <th class="th" style="width:380px;">Descripción EF6</th>
                <th class="th" style="width:70px;">EF7</th>
                <th class="th" style="width:380px;">Descripción EF7</th>
                <th class="th" style="width:70px;">EF8</th>
                <th class="th" style="width:380px;">Descripción EF8</th>
            </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
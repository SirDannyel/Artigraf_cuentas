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
    <script type="text/javascript" src="ValidaUser.js"></script>
    <style type="text/css">

        .headerSiding {
            position: relative; /* need a non-static position */
            padding-top: 1.4em; /* place for the fixed header */

        }

        .scrollPane {
            height: 40em; /* without height no scrollbar ever */
            overflow: auto; /* show scrollbar when needed */
            width:4200px
        }

        .scrollPane {
            position: absolute; /* pinned to next non-static parent */
            top: 0; /* at top of parent */
        }

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
        let data =
            JSON.stringify({
                tipo : "RangoInicio"
            });
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

            objXMLHttpRequest.open('POST', "getRangosCuentas.php");
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
    }

    const RangosSearch_Api = (nivel,dato) => {
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
            var url = "search_nivel.php";
            var Parametro2 = "?nivel="+nivel;
            var Parametro3 = "&dato="+dato;
            var UrltoSend = url+Parametro2+Parametro3;

            objXMLHttpRequest.open('GET', UrltoSend);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const EF1Select_Api = (Tabla, Columna) => {
        let data =
            JSON.stringify({
                tipo : "getEFs",
                tabla : Tabla,
                columna : Columna
            });
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

            objXMLHttpRequest.open('POST',"getRangosCuentas.php");
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
    }

    const InsertRangos_Api = (RangosInput) => {
        const data = JSON.stringify(RangosInput);
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

            var url = "getRangosCuentas.php";

            objXMLHttpRequest.open('POST',url);
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
    }

    const UpdateRangos_Api = () => {
        const data = JSON.stringify(RangosCuentas);
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

            objXMLHttpRequest.open('POST',"putRangosCuentas.php");
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
    }

    /******* Controladores y funciones *******/
    const deleteChild = () => {
        $(".tr").remove();
    }

    const get_EFs = async () => {
        try {
            let table = "Dim_EF2";
            let column = "EF2_Desc";

            const responseEF2 = await EF1Select_Api(table, column);
            EF2 = JSON.parse(responseEF2);

            var selectEF2 = document.getElementById("IdEf2");
            for (let ef2 of EF2) {
                var option2 = document.createElement("option");
                option2.text = ef2.EF2_Desc;
                option2.value = ef2.EF2_Desc;
                selectEF2.appendChild(option2);

            }

            table = "EF1_Select";
            column = "EF1_Desc";

            const responseEF1 = await EF1Select_Api(table, column);
            EF1 = JSON.parse(responseEF1);

             table = "Dim_EF3";
             column = "EF3_Desc";

            const responseEF3 = await EF1Select_Api(table, column);
            EF3 = JSON.parse(responseEF3);

            var selectEF3 = document.getElementById("IdEf3");
            for (let ef3 of EF3) {
                var option3 = document.createElement("option");
                option3.text = ef3.EF3_Desc;
                option3.value = ef3.EF3_Desc;
                selectEF3.appendChild(option3);

            }

             table = "Dim_EF4";
             column = "EF4_Desc";

            const responseEF4 = await EF1Select_Api(table, column);
            EF4 = JSON.parse(responseEF4);

            var selectEF4 = document.getElementById("IdEf4");
            for (let ef4 of EF4) {
                var option4 = document.createElement("option");
                option4.text = ef4.EF4_Desc;
                option4.value = ef4.EF4_Desc;
                selectEF4.appendChild(option4);

            }

            table = "Dim_EF5";
            column = "EF5_Desc";

            const responseEF5 = await EF1Select_Api(table, column);
            EF5 = JSON.parse(responseEF5);

            var selectEF5 = document.getElementById("IdEf5");
            for (let ef5 of EF5) {
                var option5 = document.createElement("option");
                option5.text = ef5.EF5_Desc;
                option5.value = ef5.EF5_Desc;
                selectEF5.appendChild(option5);
            }

            table = "Dim_EF6";
            column = "EF6_Desc";

            const responseEF6 = await EF1Select_Api(table, column);
            EF6 = JSON.parse(responseEF6);

            var selectEF6 = document.getElementById("IdEf6");
            for (let ef6 of EF6) {
                var option6 = document.createElement("option");
                option6.text = ef6.EF6_Desc;
                option6.value = ef6.EF6_Desc;
                selectEF6.appendChild(option6);

            }

            table = "Dim_EF7";
            column = "EF7_Desc";

            const responseEF7 = await EF1Select_Api(table, column);
            EF7 = JSON.parse(responseEF7);

            var selectEF7 = document.getElementById("IdEf7");
            for (let ef7 of EF7) {
                var option7 = document.createElement("option");
                option7.text = ef7.EF7_Desc;
                option7.value = ef7.EF7_Desc;
                selectEF7.appendChild(option7);
            }

            table = "Dim_EF8";
            column = "EF8_Desc";

            const responseEF8 = await EF1Select_Api(table, column);
            EF8 = JSON.parse(responseEF8);

            var selectEF8 = document.getElementById("IdEf8");
            for (let ef8 of EF8) {
                var option8 = document.createElement("option");
                option8.text = ef8.EF8_Desc;
                option8.value = ef8.EF8_Desc;
                selectEF8.appendChild(option8);
            }

            await get_EFsModal();
        } catch (err) {
            console.log(err)
        }
    }

    const get_EFsModal = async () => {
        try {

            var selectEF2_Modal = document.getElementById("Ef2");
            for (var i = 0; i < EF2.length; i++) {
                var option2_Modal = document.createElement("option");
                option2_Modal.text = EF2[i].EF2_Desc;
                option2_Modal.value = EF2[i].EF2_Desc;
                selectEF2_Modal.appendChild(option2_Modal);
            }

            var selectEF3_Modal = document.getElementById("Ef3");
            for (let ef3 of EF3) {
                var option3_Modal = document.createElement("option");
                option3_Modal.text = ef3.EF3_Desc;
                option3_Modal.value = ef3.EF3_Desc;
                selectEF3_Modal.appendChild(option3_Modal);
            }

            var selectEF4_Modal = document.getElementById("Ef4");
            for (let ef4 of EF4) {
                var option4_Modal = document.createElement("option");
                option4_Modal.text = ef4.EF4_Desc;
                option4_Modal.value = ef4.EF4_Desc;
                selectEF4_Modal.appendChild(option4_Modal);
            }

            var selectEF5_Modal = document.getElementById("Ef5");
            for (let ef5 of EF5) {
                var option5_Modal = document.createElement("option");
                option5_Modal.text = ef5.EF5_Desc;
                option5_Modal.value = ef5.EF5_Desc;
                selectEF5_Modal.appendChild(option5_Modal);
            }
            ;
            var selectEF6_Modal = document.getElementById("Ef6");
            for (let ef6 of EF6) {
                var option6_Modal = document.createElement("option");
                option6_Modal.text = ef6.EF6_Desc;
                option6_Modal.value = ef6.EF6_Desc;
                selectEF6_Modal.appendChild(option6_Modal);
            }

            var selectEF7_Modal = document.getElementById("Ef7");
            for (let ef7 of EF7) {
                var option7_Modal = document.createElement("option");
                option7_Modal.text = ef7.EF7_Desc;
                option7_Modal.value = ef7.EF7_Desc;
                selectEF7_Modal.appendChild(option7_Modal);
            }

            var selectEF8_Modal = document.getElementById("Ef8");
            for (var i = 0; i < EF8.length; i++) {
                var option8_Modal = document.createElement("option");
                option8_Modal.text = EF8[i].EF8_Desc;
                option8_Modal.value = EF8[i].EF8_Desc;
                selectEF8_Modal.appendChild(option8_Modal);
            }

        } catch (err) {
            console.log(err)
        }
    }

        const getRangosCuentas = async () => {
        try {
            RangosCuentas = [];
            const response = await RangosCuentas_Api();
            RangosCuentas = JSON.parse(response);
            // console.log(RangosCuentas);
             await getRangosCuentas_Table();
        } catch (err)
        {
            console.log(err)
        }
    }

    const getRangosSearch = async (nivel,dato) => {
        try {
            RangosCuentas = [];
            const response = await RangosSearch_Api(nivel,dato);
            RangosCuentas = JSON.parse(response);
            // console.log(RangosCuentas);
            await getRangosCuentas_Table();
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
                boton.setAttribute("name",RangosCuentas[i].EF1);
                boton.setAttribute("id", RangosCuentas[i].RangoCuentas_id);
                boton.onclick = function(){
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "Se descartará el registro de la lista",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            let indice = RangosCuentas.findIndex(cuenta => cuenta.RangoCuentas_id === this.id);
                            RangosCuentas.splice(indice, 1);
                            getRangosCuentas_Table();

                        }
                    });
                };
                boton.setAttribute("class", "btn btn-outline-warning px-3");
                boton.setAttribute("type", "button");
                linea.appendChild(boton);
                var icon = document.createElement("i");
                icon.setAttribute("class", "fa-solid fa-minus");
                boton.appendChild(icon);
            }

        } catch (err)
        {
            console.log(err)
        }
    }

    const handleInsertRango = async (cuentainicio, cuentafin, orden, desc, ef2, ef3, ef4, ef5, ef6, ef7, ef8) => {

        var Tipo = "InsertRango";
        try {

            var desc2 = "";
            if (ef2) {
                const ef2desc = EF2.find(({EF2_Desc}) => EF2_Desc === ef2);
                desc2 = ef2desc.EF2;
            }

            var desc3 = "";
            if (ef3) {
                const ef3desc = EF3.find(({EF3_Desc}) => EF3_Desc === ef3);
                var desc3 = ef3desc.EF3;
            }

            var desc4 = "";
            if (ef4) {
                const ef4desc = EF4.find(({EF4_Desc}) => EF4_Desc === ef4);
                var desc4 = ef4desc.EF4;
            }

            var desc5 = ""
            if (ef5) {
                const ef5desc = EF5.find(({EF5_Desc}) => EF5_Desc === ef5);
                var desc5 = ef5desc.EF5;
            }

            var desc6 = ""
            if (ef6) {
                const ef6desc = EF6.find(({EF6_Desc}) => EF6_Desc === ef6);
                var desc6 = ef6desc.EF6;
            }

            var desc7 = ""
            if (ef7) {
                const ef7desc = EF7.find(({EF7_Desc}) => EF7_Desc === ef7);
                var desc7 = ef7desc.EF7;
            }

            var desc8 = ""
            if (ef8) {
                const ef8desc = EF8.find(({EF8_Desc}) => EF8_Desc === ef8);
                var desc8 = ef8desc.EF8;
            }

            let cuentasInput = {
                CuentaInicio: cuentainicio,
                CuentaFin: cuentafin,
                Orden: orden,
                EF1: orden,
                EF1Desc: desc,
                EF2: desc2,
                EF2Desc: ef2,
                EF3: desc3,
                EF3Desc: ef3,
                EF4: desc4,
                EF4Desc: ef4,
                EF5: desc5,
                EF5Desc: ef5,
                EF6: desc6,
                EF6Desc: ef6,
                EF7: desc7,
                EF7Desc: ef7,
                EF8: desc8,
                EF8Desc: ef8,
                tipo: Tipo
            };

            await InsertRangos_Api(cuentasInput);
            await getRangosCuentas();

            $("#Orden").val("");
            $("#Descripcion").val("");
            $("#CuentaInicio").val("");
            $("#CuentaFin").val("");
            $("#Ef2").val("");
            $("#Ef3").val("");
            $("#Ef4").val("");
            $("#Ef5").val("");
            $("#Ef6").val("");
            $("#Ef7").val("");
            $("#Ef8").val("");

            Swal.fire({
                icon: 'success',
                title: 'Registro Agregado',
                showConfirmButton: false,
                timer: 1500
            });

        } catch (err) {
            console.log(err)
        }

    }

    const handleUpdateRango = (ef2desc,ef2,ef3desc,ef3,ef4desc,ef4,ef5desc,ef5,ef6desc,ef6,ef7desc,ef7,ef8desc,ef8) => {
        try {
            for (var i = 0; i < RangosCuentas.length; i++) {
                var Rango = RangosCuentas[i].RangoCuentas_id;

                RangosCuentas.map(function (dato) {
                    if (dato.RangoCuentas_id == Rango) {
                        if (ef2 && ef2desc) {
                            dato.EF2 = ef2;
                            dato.EF2Desc = ef2desc;
                        }
                        if(ef3 && ef3desc) {
                            dato.EF3 = ef3;
                            dato.EF3Desc = ef3desc;
                        }
                        if(ef4 && ef4desc) {
                            dato.EF4 = ef4;
                            dato.EF4Desc = ef4desc;
                        }
                        if(ef5 && ef5desc) {
                            dato.EF5 = ef5;
                            dato.EF5Desc = ef5desc;
                        }
                        if(ef6 && ef6desc) {
                            dato.EF6 = ef6;
                            dato.EF6Desc = ef6desc;
                        }
                        if(ef7 && ef7desc) {
                            dato.EF7 = ef7;
                            dato.EF7Desc = ef7desc;
                        }
                        if(ef8 && ef8desc) {
                            dato.EF8 = ef8;
                            dato.EF8Desc = ef8desc;
                        }
                    }
                    return dato;
                });
            }


                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Se modificarán los registros de la lista",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Modificar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        UpdateRangos_Api();

                        $('#IdEf2').val("");
                        $('#IdEf3').val("");
                        $('#IdEf4').val("");
                        $('#IdEf5').val("");
                        $('#IdEf6').val("");
                        $('#IdEf7').val("");
                        $('#IdEf8').val("");

                        $('#EF2').val("");
                        $('#EF3').val("");
                        $('#EF4').val("");
                        $('#EF5').val("");
                        $('#EF6').val("");
                        $('#EF7').val("");
                        $('#EF8').val("");
                        getRangosCuentas_Table();
                    }

                });

        } catch (err) {
            console.log(err)
        }
        //AQUI
    }

    const funcion_addcoma = (texto) => {
        let textoAjustado;

        if(texto.length < 4) {

            $("#CuentaInicio").val(texto);

        } else if(texto.length == 4) {
            const parte1 = texto.slice(0,4);
            const parte2 = texto.slice(4,8);
            textoAjustado = parte1+","+parte2;
            $("#CuentaInicio").val(textoAjustado);
        }  else if(texto.length == 9) {
            const parte1 = texto.slice(0,9);
            const parte2 = texto.slice(9,13);
            textoAjustado = parte1+","+parte2;
            $("#CuentaInicio").val(textoAjustado);
        } else if(texto.length == 14) {
            const parte1 = texto.slice(0,14);
            const parte2 = texto.slice(14,18);
            textoAjustado = parte1+","+parte2;
            $("#CuentaInicio").val(textoAjustado);
        } else if(texto.length == 19) {

            const parte1 = texto.slice(0,19);
            const parte2 = texto.slice(19,23);
            textoAjustado = parte1+","+parte2;
            $("#CuentaInicio").val(textoAjustado);
        } else if(texto.length == 24) {

            const parte1 = texto.slice(0,24);
            const parte2 = texto.slice(24,29);
            textoAjustado = parte1+","+parte2;
            $("#CuentaInicio").val(textoAjustado);
        }

    }

    const funcion_addcomaFin = (texto) => {
        let textoAjustado;

        if(texto.length < 4) {

            $("#CuentaFin").val(texto);

        } else if(texto.length == 4) {
            const parte1 = texto.slice(0,4);
            const parte2 = texto.slice(4,8);
            textoAjustado = parte1+","+parte2;
            $("#CuentaFin").val(textoAjustado);
        }  else if(texto.length == 9) {

            const parte1 = texto.slice(0,9);
            const parte2 = texto.slice(9,13);
            textoAjustado = parte1+","+parte2;
            $("#CuentaFin").val(textoAjustado);
        } else if(texto.length == 14) {

            const parte1 = texto.slice(0,14);
            const parte2 = texto.slice(14,18);
            textoAjustado = parte1+","+parte2;
            $("#CuentaFin").val(textoAjustado);
        } else if(texto.length == 19) {

            const parte1 = texto.slice(0,19);
            const parte2 = texto.slice(19,23);
            textoAjustado = parte1+","+parte2;
            $("#CuentaFin").val(textoAjustado);
        } else if(texto.length == 24) {

            const parte1 = texto.slice(0,24);
            const parte2 = texto.slice(24,29);
            textoAjustado = parte1+","+parte2;
            $("#CuentaFin").val(textoAjustado);
        }

    }

    const Nivel_onchange = (efn) => {

            if(efn === "EF1") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                for (let ef1 of EF1) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef1.EF1_Desc;
                    option_Search.value = ef1.EF1_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF2") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                for (let ef2 of EF2) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef2.EF2_Desc;
                    option_Search.value = ef2.EF2_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF3") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                for (let ef3 of EF3) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef3.EF3_Desc;
                    option_Search.value = ef3.EF3_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF4") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                for (let ef4 of EF4) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef4.EF4_Desc;
                    option_Search.value = ef4.EF4_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF5") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                for (let ef5 of EF5) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef5.EF5_Desc;
                    option_Search.value = ef5.EF5_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF6") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                for (let ef6 of EF6) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef6.EF6_Desc;
                    option_Search.value = ef6.EF6_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF7") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");

                for (let ef7 of EF7) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef7.EF7_Desc;
                    option_Search.value = ef7.EF7_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "EF8") {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");

                for (let ef8 of EF8) {
                    var option_Search = document.createElement("option");
                    option_Search.text = ef8.EF8_Desc;
                    option_Search.value = ef8.EF8_Desc;
                    search.appendChild(option_Search);
                }
            } else if (efn === "" ) {
                $("#CuentaSearch option").remove();
                var search = document.getElementById("CuentaSearch");
                var option_Search = document.createElement("option");
                option_Search.text = "";
                option_Search.value = "";
                search.appendChild(option_Search);

        }
    }

    const EF2_onchange = (ef2) => {
        if (ef2){
            const ef2desc = EF2.find( ({ EF2_Desc }) => EF2_Desc === ef2);
            $('#EF2').val(ef2desc.EF2);
        } else {
            $('#EF2').val("");
        }
    }

    const EF3_onchange = (ef3) => {
        if (ef3){
            const ef3desc = EF3.find( ({ EF3_Desc }) => EF3_Desc === ef3);
            $('#EF3').val(ef3desc.EF3);
        } else {
            $('#EF3').val("");
        }
    }

    const EF4_onchange = (ef4) => {
        if (ef4){
            const ef4desc = EF4.find( ({ EF4_Desc }) => EF4_Desc === ef4);
            $('#EF4').val(ef4desc.EF4);
        } else {
            $('#EF4').val("");
        }
    }

    const EF5_onchange = (ef5) => {
        if (ef5){
            const ef5desc = EF5.find( ({ EF5_Desc }) => EF5_Desc === ef5);
            $('#EF5').val(ef5desc.EF5);
        } else {
            $('#EF5').val("");
        }
    }

    const EF6_onchange = (ef6) => {
        if (ef6){
            const ef6desc = EF6.find( ({ EF6_Desc }) => EF6_Desc === ef6);
            $('#EF6').val(ef6desc.EF6);
        } else {
            $('#EF6').val("");
        }
    }

    const EF7_onchange = (ef7) => {
        if (ef7){
            const ef7desc = EF7.find( ({ EF7_Desc}) => EF7_Desc === ef7);
            $('#EF7').val(ef7desc.EF7);
        } else {
            $('#EF7').val("");
        }
    }

    const EF8_onchange = (ef8) => {
        if (ef8){
            const ef8desc = EF8.find( ({ EF8_Desc }) => EF8_Desc === ef8);
            $('#EF8').val(ef8desc.EF8);
        } else {
            $('#EF8').val("");
        }
    }

    function hidemodal (){
        $("#exampleModal").modal("hide");
        $("#Orden").val("");
        $("#Descripcion").val("");
        $("#CuentaInicio").val("");
        $("#CuentaFin").val("");
        $("#Ef2").val("");
        $("#Ef3").val("");
        $("#Ef4").val("");
        $("#Ef5").val("");
        $("#Ef6").val("");
        $("#Ef7").val("");
        $("#Ef8").val("");

    }

    const init = () => {
            get_EFs();
            getRangosCuentas();
    }

    //Mandar a llamar getRangosCuentas
    init();

    $(document).ready(UserValidation);
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
            <div class="col" align="center">
                <h3 class="d-flex justify-content-center text-primary" id="titulo">Rangos Cuentas Contables</h3>
            </div>
            <div class="col" align="right">
                <button type="button" class="btn btn-primary" onclick='$("#exampleModal").modal("show");'>Agregar Rango</button>
            </div>
        </div>

    </div>
</nav>
<div style="padding-top:70px;"> </div>
<main class="container mt-4" style="max-width:1840px">

    <div class="my-3 p-2 shadow-sm border-bottom bg-body rounded" id="panel">

    <div class="row mt-2 align-items-center w-100">

        <div class="col-2">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Select_search">Nivel</p>
            <select class="form-select form-select-sm" id="Select_search" onchange="Nivel_onchange(this.value)" aria-label="Default select example">
                <option selected></option>
                <option>EF1</option>
                <option>EF2</option>
                <option>EF3</option>
                <option>EF4</option>
                <option>EF5</option>
                <option>EF6</option>
                <option>EF7</option>
                <option>EF8</option>
            </select>
        </div>
        <div class="col-4">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="CuentaSearch">Descripción</p>
            <select class="form-select form-select-sm" id="CuentaSearch" placeholder="Descripción" aria-label="Default select example">
                <option selected></option>
            </select>
        </div>

        <div class="col-1">
                <button type="button" class="btn btn-secondary mt-4" onclick="getRangosSearch($('#Select_search').val(),$('#CuentaSearch').val())">Buscar</button>
        </div>

        <div class="col flex-col" align="right">
            <button type="button"  class="btn btn-success mt-4" onclick="handleUpdateRango($('#IdEf2').val(),$('#EF2').val(),$('#IdEf3').val(),$('#EF3').val(),$('#IdEf4').val(),$('#EF4').val(),$('#IdEf5').val(),$('#EF5').val(),$('#IdEf6').val(),$('#EF6').val(),$('#IdEf7').val(),$('#EF7').val(),$('#IdEf8').val(),$('#EF8').val())" >Modificar Rangos</button>
        </div>

    </div>

    <div class="row flex-row mb-3 mt-2 align-items-center w-100">

        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf2">EF2</p>
            <select class="form-select form-select-sm" id="IdEf2" aria-label="Default select example" onchange="EF2_onchange(this.value)">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf3">EF3</p>
            <select class="form-select form-select-sm" id="IdEf3" aria-label="Default select example" onchange="EF3_onchange(this.value)">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf4">EF4</p>
            <select class="form-select form-select-sm" id="IdEf4" aria-label="Default select example" onchange="EF4_onchange(this.value)">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf5">EF5</p>
            <select class="form-select form-select-sm" id="IdEf5" aria-label="Default select example" onchange="EF5_onchange(this.value)">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf6">EF6</p>
            <select class="form-select form-select-sm" id="IdEf6" aria-label="Default select example" onchange="EF6_onchange(this.value)">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf7">EF7</p>
            <select class="form-select form-select-sm" id="IdEf7" aria-label="Default select example" onchange="EF7_onchange(this.value)">
                <option selected></option>
            </select>
        </div>
        <div class="col">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdEf8">EF8</p>
            <select class="form-select form-select-sm" id="IdEf8" aria-label="Default select example" onchange="EF8_onchange(this.value)">
                <option selected></option>
            </select>
        </div>

        <!-- AQUI FILAS DE INPUTS EF Descripciones -->
        <form>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF2">
            </div>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF3">
            </div>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF4">
            </div>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF5">
            </div>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF6">
            </div>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF7">
            </div>
            <div class="col">
                <input type="hidden" value="" class="form-control form-control-sm" id="EF8">
            </div>
        </form>

    </div>

    </div>

    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar shadow-sm border-bottom bg-body rounded">
   <!-- <div class="scrollPane"> -->
        <table class="table" id="tabla">
            <thead>
            <tr class="d-flex flex-row">
                <th style="width:70px;"><div>EF1</div></th>
                <th style="width:380px;"><div>Descripción EF1</div></th>
                <th style="width:250px;"><div>Cuenta Inicio</div></th>
                <th style="width:250px;"><div>Cuenta Fin</div></th>
                <th style="width:70px;"><div>EF2</div></th>
                <th style="width:380px;"><div>Descripción EF2</div></th>
                <th style="width:70px;"><div>EF3</div></th>
                <th style="width:380px;"><div>Descripción EF3</div></th>
                <th style="width:70px;"><div>EF4</div></th>
                <th style="width:380px;"><div>Descripción EF4</div></th>
                <th style="width:70px;"><div>EF5</div></th>
                <th style="width:380px;"><div>Descripción EF5</div></th>
                <th style="width:70px;"><div>EF6</div></th>
                <th style="width:380px;"><div>Descripción EF6</div></th>
                <th style="width:70px;"><div>EF7</div></th>
                <th style="width:380px;"><div>Descripción EF7</div></th>
                <th style="width:70px;"><div>EF8</div></th>
                <th style="width:380px"><div>Descripción EF8</div></th>
            </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
        </table>
    <!--</div>-->
    </div>
    <div class="modal fade bd-example-modal-l" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Agregar Rango </h5>
                    <button type="button" class="btn btn-outline-danger px-3" onclick='hidemodal()'>
                        <i class="fa-solid fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row flex-row mb-2 align-items-x w-100">
                        <div class="col-2">
                            <label>Orden</label>
                            <input class="form-control form-control-sm" id="Orden"></input>
                        </div>
                        <div class="col">
                            <label>Descripción</label>
                            <input class="form-control form-control-sm" id="Descripcion"></input>
                        </div>
                    </div>

                    <div class="row flex-row mb-2 align-items-center w-100">
                        <div class="col">
                            <label>Cuenta Inicio</label>
                            <input class="form-control form-control-sm" maxlength="29" placeholder="1001,0001,????" value="????,????,????,????,????,????" id="CuentaInicio" oninput="funcion_addcoma(this.value)"></input>
                        </div>
                        <div class="col">
                            <label>Cuenta Fin</label>
                            <input class="form-control form-control-sm" maxlength="29" placeholder="1001,0001,????" value="????,????,????,????,????,????" id="CuentaFin" oninput="funcion_addcomaFin(this.value)"></input>
                        </div>

                   <!-- <script>
                        $(document).ready(function(){
                            $('#CuentaInicio').mask('0000,????0000,????0000,????0000,????0000,????0000');
                            $('#CuentaFin').mask("{1,4},{1,4},{1,4},{1,4},{1,4},{1,4},{1,4}");
                        });
                    </script> -->
                    </div>

                    <div class="row flex-row mb-2 align-items-center w-100">
                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef2">EF2</p>
                            <select class="form-select form-select-sm" id="Ef2" aria-label="Default select example">
                                <option selected></option>
                            </select>
                        </div>
                    </div>

                    <div class="row flex-row mb-2 align-items-center w-100">
                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef3">EF3</p>
                            <select class="form-select form-select-sm" id="Ef3" aria-label="Default select example" >
                                <option selected></option>
                            </select>
                        </div>

                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef4">EF4</p>
                            <select class="form-select form-select-sm" id="Ef4" aria-label="Default select example" >
                                <option selected></option>
                            </select>
                        </div>

                    </div>
                    <div class="row flex-row mb-2 align-items-center  w-100">
                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef5">EF5</p>
                            <select class="form-select form-select-sm" id="Ef5" aria-label="Default select example" >
                                <option selected></option>
                            </select>
                        </div>
                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef6">EF6</p>
                            <select class="form-select form-select-sm" id="Ef6" aria-label="Default select example" >
                                <option selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="row flex-row mb-2 align-items-center  w-100">
                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef7">EF7</p>
                            <select class="form-select form-select-sm" id="Ef7" aria-label="Default select example" >
                                <option selected></option>
                            </select>
                        </div>
                        <div class="col">
                            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Ef8">EF8</p>
                            <select class="form-select form-select-sm" id="Ef8" aria-label="Default select example" >
                                <option selected></option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick='hidemodal()'>Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="handleInsertRango($('#CuentaInicio').val(),$('#CuentaFin').val(),$('#Orden').val(),$('#Descripcion').val(),$('#Ef2').val(),$('#Ef3').val(),$('#Ef4').val(),$('#Ef5').val(),$('#Ef6').val(),$('#Ef7').val(),$('#Ef8').val())">Agregar</button>
                </div>
            </div>

        </div>
    </div>


</main>
</body>
</html>
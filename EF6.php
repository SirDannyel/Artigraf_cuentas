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

    /******* Services  *******/


    EF6_Id_AntG = 0;
    const EF6_ID = 0;
    const EF6_service = () => {
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

            objXMLHttpRequest.open('GET', 'http://localhost/Artigraf/ef6_controller.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send();
        });
    }

    const EF6Insert_service = (ef6_orden_nvo,ef6_desc_nvo) => {
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

            objXMLHttpRequest.open('POST', 'http://localhost/Artigraf/ef6_controller.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            objXMLHttpRequest.send("ef6_orden="+ef6_orden_nvo+"&ef6_desc="+ef6_desc_nvo);
        });
    }

    const EF6Update_service = (ID,Ef6_orden_ant,Ef6_desc_ant,ID_EF_NVO,Ef6_desc_nvo) => {
        const ID_big = parseInt(ID);
        let data =
            JSON.stringify({
                id : ID_big,
                ef6_orden_ant : Ef6_orden_ant,
                ef6_desc_ant :  Ef6_desc_ant,
                ef6_orden_nvo : ID_EF_NVO,
                ef6_desc_nvo : Ef6_desc_nvo});

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

            objXMLHttpRequest.open('PUT', 'http://localhost/Artigraf/ef6_controller.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
    }

    const EF6Delete_service = (ID) => {

        const data = JSON.stringify({id : ID});
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

            objXMLHttpRequest.open('DELETE', 'http://localhost/Artigraf/ef6_controller.php');
            objXMLHttpRequest.setRequestHeader("Content-type", "application/json");
            objXMLHttpRequest.send(data);
        });
    }

    /******* Fin Servicios  *******/


    /******* Controller  *******/

    const deleteChild = () => {
        $(".tr").remove();
    }

    const getEF6 = async () => {
        try{
            const response = await EF6_service();
            //    console.log("getEFs Response", response);
            //     console.log(response);
            const myArr = JSON.parse(response);
            var tablabody = document.getElementById("tablabody");

            for(var i = 0; i < myArr.length; i++) {
                var linea = document.createElement("tr");
                linea.setAttribute("class", "d-flex flex-row tr");
                tablabody.appendChild(linea);

                var ef6 = myArr[i].EF6;
                var campo = document.createElement("td");
                campo.setAttribute("style", "width:100px;");
                campo.setAttribute("class", "text-center");
                campo.textContent = ef6;
                campo.value = ef6;
                linea.appendChild(campo);

                var opt = myArr[i].EF6_Desc;
                campo = document.createElement("td");
                campo.setAttribute("style", "width:400px;");
                campo.setAttribute("class", "text-center");
                campo.textContent = opt;
                campo.value = opt;
                linea.appendChild(campo);

                var editar = document.createElement("button");
                editar.setAttribute("name", myArr[i].EF6_Desc);
                editar.setAttribute("id", myArr[i].EF6);
                editar.setAttribute("class", "btn btn-outline-warning px-3");
                editar.setAttribute("type", "button");
                editar.textContent = "Editar";
                editar.value = myArr[i].id_ef6;
                editar.onclick = function(){
                    $("#exampleModal").modal("show");
                    $("#ID_EF_ANT").val(this.id);
                    $("#EF_name").val(this.name);
                    $("#postId").val(Number(this.value));
                };
                linea.appendChild(editar);

                var boton = document.createElement("button");
                boton.setAttribute("name", myArr[i].id_ef6);
                boton.setAttribute("id", myArr[i].id_ef6);
                boton.onclick = function(){

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
                            delete_ef6(this.id);
                            Swal.fire(
                                'Eliminado!',
                                'Registro Eliminado.',
                                'success'
                            )
                        }

                    });
                };
                boton.setAttribute("class", "btn btn-outline-danger px-3");
                boton.setAttribute("type", "button");
                boton.textContent = "Eliminar";
                linea.appendChild(boton);

            }

        }
        catch(err){
            console.log(err);
        }
    }

    const insert_ef6 = (ef6_orden_nvo,ef6_desc_nvo) => {
        try {
            EF6Insert_service(ef6_orden_nvo, ef6_desc_nvo);
            Swal.fire({
                icon: 'success',
                title: 'Registro Agregado',
                showConfirmButton: false,
                timer: 1500
            });
            deleteChild ();
            getEF6();
        } catch (err) {
            console.log(err);
        }
    }

    const update_ef6 = (id,ef6_orden_ant, ef6_desc_ant,ID_EF_NVO,ef6_desc_nvo) => {
        try {
            EF6Update_service(id,ef6_orden_ant, ef6_desc_ant,ID_EF_NVO,ef6_desc_nvo);
            Swal.fire({
                icon: 'success',
                title: 'Registro Agregado',
                showConfirmButton: false,
                timer: 1500
            });
            deleteChild ();
            getEF6();
        } catch (err) {
            console.log(err);
        }
    }

    const delete_ef6 = (id) => {
        try {
            EF6Delete_service(id);
            Swal.fire({
                icon: 'success',
                title: 'Registro Agregado',
                showConfirmButton: false,
                timer: 1500
            });
            deleteChild ();
            getEF6();
        } catch (err) {
            console.log(err);
        }
    }




    /******* Fin Controller  *******/



    /******* Fin DOM Events  *******/

    const init = () => {
        getEF6();
    }

    init();

</script>

<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white border-bottom" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="me-3" src="Artigraf.png" alt="" width="100" >
        </a>

        <div class="d-flex flex-column px-2 pb-2 w-100">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="IdDesc">ID</p>
            <input class="form-control m-1" placeholder="ID" id="IdDesc"></input>
        </div>

        <div class="d-flex flex-column px-2 pb-2 w-100">
            <p style="height:8px;" class="form-check-label d-flex justify-content-left px-3" for="Desc">Descripción</p>
            <input class="form-control m-1" placeholder="Descripción" id="Desc"></input>
        </div>

        <button class="btn btn-success mt-3" onclick="insert_ef6($('#IdDesc').val(),$('#Desc').val())">
            Agregar
        </button>
    </div>
</nav>
<div style="padding-top:90px;"> </div>
<main class="container" style="max-width:1420px;">
    <div class="my-3 p-4 bg-body rounded shadow-sm" id="panel">
        <div class="border-bottom d-flex flex-row">
            <h6 class="pt-2 w-75  d-flex justify-content-left text-muted" >Configurador de Agrupadores de Cuentas Financieros</h6>
            <h3 class="w-100  d-flex justify-content-left text-primary" id="titulo">Agrupación EF6</h3>
        </div>
        <table class="table" id="tabla">
            <thead>
            <tr class="d-flex flex-row">
                <th scope="col" style="width:100px;" class="text-center">ID</th>
                <th scope="col" style="width:400px;" class="text-center">Descripción</th>
            </tr>
            </thead>
            <tbody  id="tablabody">
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDITAR REGISTRO</h5>
                    <button type="button" class="btn btn-outline-danger px-3" onclick='$("#exampleModal").modal("hide");'>
                        <i class="fa-solid fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="hidden"  class="form-control form-control-sm" id="postId" name="postId"" />
                        </div>
                        <div class="form-group">
                            <label for="ID_EF_ANT" class="col-form-label">ID Anterior:</label>
                            <input type="text" class="form-control form-control-sm" id="ID_EF_ANT" disabled>
                        </div>
                        <div class="form-group">
                            <label for="EF_name" class="col-form-label">Descripción Anterior</label>
                            <input type="text" class="form-control form-control-sm" id="EF_name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ID_EF_NVO" class="col-form-label">ID Nuevo</label>
                            <input type="text" class="form-control form-control-sm" id="ID_EF_NVO">
                        </div>
                        <div class="form-group">
                            <label for="EF_name_nvo" class="col-form-label">Descripción Nuevo</label>
                            <input type="text" class="form-control form-control-sm" id="EF_name_nvo">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick='$("#exampleModal").modal("hide");'>Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="EF6Update_service($('#postId').val(),$('#ID_EF_ANT').val(),$('#EF_name').val(),$('#ID_EF_NVO').val(),$('#EF_name_nvo').val())">Editar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-2 mb-0 w-25"> </div>
        <div class="pb-2 mb-0 w-25"> </div>
    </div>
</main>

</body>
</html>

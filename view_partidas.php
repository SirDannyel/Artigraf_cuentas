
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
            objXMLHttpRequest.send();
        });
    }

    /******* Fin Apis  *******/

    const deleteChild = () => {
        $(".tr").remove();
        console.log('1');
    }

    /******* Services  *******/

    const getCuentas = async (cuenta = $('#Cuenta').val()) => {
        try{ 
            const response = await Cuentas_Api();

            const myArr = JSON.parse(response);
            const result = myArr.find(({ Cuenta }) => Cuenta === cuenta);
            const Descripcion = result.CuentaDesc;
            console.log("getCuentas",Descripcion);
            $("#Descripcion").val(Descripcion);
        }
        catch(err){
            console.log(err)
        }
    }

    /******* Fin Services  *******/

    const handleSelectChange = (cuenta) => {
        getCuentas(cuenta);
    }
    /******* Fin DOM Events  *******/



    const init = () => {
        //getCuentas();
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
        <input id="Cargo" class="form-control m-1" placeholder="Cargo"></input>
        <input id="Abono" class="form-control m-1" placeholder="Abono"></input>
        <button class="btn btn-primary" ><i class="plus"></i>Agregar</button>
    </div>
</nav>
<div style="padding-top:90px;"> </div>

</body>
</html>
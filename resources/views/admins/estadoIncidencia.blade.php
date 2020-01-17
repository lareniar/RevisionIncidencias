<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>estado</title>
</head>

<body>

    <div class="header">
        <div id="headerContent">
            <div id="bienvenida"><h2 >Formulario de adquisiciones</h2></div>
            <div id="exit">
                <a href="/homeAdmin">
                    <img src="https://www.ulricianum-aurich.net/wp-content/uploads/2019/02/cross-296507_960_720.png" alt="" width="70%">
                </a>
            </div>
        </div>        
    </div>

    <div id="cuerpo">
        <form action="" method="POST">
            @csrf  
            <label for="">Profesor</label>
            <input type="text" readonly value="{{$profesor}}" >            
            <label for="">Fecha</label>
            <input type="text" readonly value="{{$incidencia->created_at}}">           
            <br>
            <label for="">Código de equipo</label>
            <input type="text" readonly value="{{$incidencia->cod_equipo}}">
            <label for="">Tipo de equipo</label>
            <input type="text" readonly value="{{$incidencia->tipo_equipo}}">
            <br>
            <label for="">Código de incidencia</label>
            <input type="text" readonly value="{{$incidencia->cod_incidencia}}">
            <label for="">Descripcion</label>
            <textarea name="" id="" cols="30" rows="10" readonly >"{{$incidencia->descripcion}}"</textarea>
            <br>

            <label for="estado" >Estado de la incidecia</label>
            <input type="hidden" id="elEstado" value="{{$incidencia->estado}}">
            <select name="estado" class="idEstado" >
                <option value="Sin asignar">Sin asignar</option>
                <option value="En proceso">En proceso</option>
                <option value="Pausado">Pausado</option>
                <option value="Finalizado">Finalizado</option>
            </select><br>
            <input type="submit" value="Guardar cambios">
        </form>
    </div>
   
    
</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
        var estado= $("#elEstado").val();
        console.log(estado);
        $('.idEstado option[value="'+estado+'"]').attr('selected','selected');
    });
</script>
</html>
<style>
    
    .header{
        background-color: rgb(187, 255, 170);
        padding:1%;
    }
    #headerContent{
        width: 70%;
        padding-left:17%;
    }
    #bienvenida{
        width: 50%;
        display: inline-block;
    }
    #btnAceptar{
        background-color: aquamarine;
        padding: 2%;
        font-size: 20px;
        border-radius: 5%;
        xwidth: 10%;
        border: 2px solid green;
    }
    body{
        background-color: rgb(255, 253, 191);
        margin:0;
    }

    #cuerpo{
        width: 60%;
        padding-left: 30%;
        padding-top:10%;
    }
    #cuerpo h2{
        padding-left: 7%;
    }
    #exit{
        display: inline-block;
        width: 5%;
        margin-left: 35%;
    }
    input{
        padding:2%;
    }
    @media (max-width:1200px){
        #cuerpo{
            width: 95%;
            padding-left: 0%;
        }
        #bienvenida{
            font-size: 18px;
        }
    }
</style>
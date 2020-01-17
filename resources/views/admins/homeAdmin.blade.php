
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="header">
        <div id="headerContent">
            <div id="bienvenida"><h2 >¡Bienvenid@ admin!</h2></div>
            <div id="divBtnLogout">
                <button href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <!--iframe para que cuando el usuario de a logout se deslogee de la cuenta de google.-->
                    <iframe id="logoutframe" src="https://accounts.google.com/logout" style="display:none"></iframe>
                </form>
            </div>
            
        </div>        
    </div>

    <div id="cuerpo" >
        <div>
            <h2>Mis incidencias</h2>
            <table id="tabla1" >
                <tr class="tCabeza">
                    <td>Ver</td>
                    <td>Fecha</td>
                    <td>Aula</td>
                    <td>Código de equipo</td>
                    <td>Tipo de equipo</td>
                    <td>Código de incidencia</td>
                    <td>Estado</td>
                    <!--<td>Administrador</td>-->
                    <td>Editar</td>
                </tr>
                <!--por cada resultado del select de incidencias asociadas a este profesor se crea un tr con los datos de la fila de la bbdd -->
                @foreach ($aMias as $incidencia)
                    <tr>
                        <td><img class="btnInfo" id='ver-{{$incidencia->id}}' src="https://image.flaticon.com/icons/png/512/65/65000.png" width="40px;" ></td>
                        <td>{{$incidencia->created_at}}</td>
                        <td>{{$incidencia->aula}}</td>
                        <td>{{$incidencia->cod_equipo}}</td>
                        <td>{{$incidencia->tipo_equipo}}</td>
                        <td>{{$incidencia->cod_incidencia}}</td>                               
                        <td>{{$incidencia->estado}}</td>
                        <!--<td>{{$incidencia->admin_id}}</td>
                        <td><a href="/estado/{{$incidencia->id}}" >Estado</a></td>-->
                        <td><button class="btnEdit" id="btnEditar{{$incidencia->id}}">Editar</button></td>
                    </tr>
                @endforeach
            </table>
        </div>
        
        <!--TABLA 2-->
        <div >
            <h2>Incidencias sin asignar</h2>
            <table id="tabla2">
                <tr class="tCabeza">
                    <td>Ver</td>
                    <td>Fecha</td>
                    <td>Aula</td>
                    <td>Código de equipo</td>
                    <td>Tipo de equipo</td>
                    <td>Código de incidencia</td>
                    <td>Estado</td>
                    <!--<td>Administrador</td>-->
                    <td>Dialog</td>
                    <!--<td>Formulario de adquisición</td>-->
                </tr>
                <!--por cada resultado del select de incidencias asociadas a este profesor se crea un tr con los datos de la fila de la bbdd -->
                @foreach ($aTodas as $Tincidencia)
                    <tr>
                        <td><img class="btnInfo" id='ver-{{$Tincidencia->id}}' src="https://image.flaticon.com/icons/png/512/65/65000.png" width="40px;" ></td>
                        <td>{{$Tincidencia->created_at}}</td>
                        <td>{{$Tincidencia->aula}}</td>
                        <td>{{$Tincidencia->cod_equipo}}</td>
                        <td>{{$Tincidencia->tipo_equipo}}</td>
                        <td>{{$Tincidencia->cod_incidencia}}</td>                               
                        <td>{{$Tincidencia->estado}}</td>
                        <!--<td>{{$Tincidencia->admin_id}}</td>-->
                        <td><button class="btnAdquirir" id="btn{{$Tincidencia->id}}">Adquirir</button></td>
                        <!--<td><a href="/adquirir/{{$Tincidencia->id}}" >Adquirir</a></td>-->
                    </tr>
                @endforeach
            </table>
        </div>
        <!--DIV DIALOGO--> 
        <div id="dialog" ></div>
    </div>
    
</body>

</html>
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
<style>
    *{
        font-family: 'Lato', sans-serif;
        
    }
    a{
        text-decoration: none;
    }
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
        font-size: 30px;
    }
    #divBtnLogout{
        width: 7%;
        margin-left: 40%;
        display: inline-block;
    }
    #divBtnLogout>button{
        background-color: rgb(145, 178, 201);
        font-size: 20px;
        border: 2px solid rgb(72, 119, 190);
        border-radius: 5%;
        padding: 8%;
        font-family: 'Times New Roman';
        color: white;
    }
    
    body{
        background-color: rgb(255, 253, 191);
        margin:0;
    }
    table{
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
        margin:2%;   
        border: 2px solid rgb( 135, 255, 129 )
    }
    tr,td{
        border: 1px solid black;
        width: 25%;
        padding: 1%;
        font-size: 14px;
        text-align: center;
    }

    #cuerpo{
        width: 60%;
        padding-left: 20%;
        xtext-align: center
    }
    #cuerpo h2{
        padding-left: 7%;
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

    /* TABLA VER DATOS Y EDITAR ESTADO*/
    .atributo{
        color: red;
        font-size: 18px;
    }
    p, label{
        padding-left: 25%;
    }
    strong, label{
        color: red;
        font-family: 'Times'
    }
    #dialog, #dEditar {
        border: 2px solid green;
        border-radius: 5%;
    }
    
    input{
        margin-left: 30%;
        background-color: rgb( 180, 253, 168);
        border: 2px solid rgb( 115, 252, 93);
        padding: 3%;
    }
    select{
        margin-left: 30%;
        margin-bottom: 2%
    }
    /* BOTONES ADQUIRIR Y EDITAR*/
    .btnAdquirir, .btnEdit{
        background-color: rgb( 255, 251, 129 );
        border: 2px solid rgb( 252, 247, 93 );
        font-size: 16px;
        border-radius: 5%;
        padding: 7%;
    }
    
</style>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $("#tabla1 tr:even, #tabla2 tr:even").css("background-color","rgb(153,235,149)");
    $("#tabla1 tr:odd, #tabla2 tr:odd").css("background-color","rgb(194,255,191)");
    $("#tabla1 tr:first, #tabla2 tr:first").css("background-color","rgb(108,154,106)");

    $(".ui-dialog-titlebar").hide()

  $( "#dialog" ).dialog({
    autoOpen: false,
    show: {
      effect: "blind",
      duration: 1000
    },
    hide: {
      effect: "blind",
      duration: 1000
    },
    width:'400px',
    position:{ my: "center center", at: "center", of:"table" },
    dialogClass: 'noTitleStuff'
  });
  $("#dialog").dialog('option', 'dialogClass', 'noTitleStuff');
    //con dialogo
    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/
    //Adquirir incidencia
    $(".btnAdquirir").click(function(){
        var $btnInci=$(this).attr('id').substr(3,$(this).attr('id').length);
        console.log($btnInci);
        $("#dialog").empty();   
        //cogemos los datos de la incidencia en json y rellenamos el dialog
        $.getJSON("/updateAdmin/"+ $btnInci, function( data ){
            $form="<h2>¿Desea asignarse esta incidencia?</h2><form action='/updateAdmin' method='post'><input type='hidden' name='id' value="+$btnInci+"><input type='submit' value='Aceptar'></form>";
            $( "#dialog" ).append($form)
        });
       
        $( "#dialog" ).dialog( "open" );
        console.log("ajax fin")
    });
   
    //Editar estado
    $(".btnEdit").click(function(){
        var $btnInci=$(this).attr('id').substr(9,$(this).attr('id').length);
        console.log($btnInci);
        $("#dialog").empty();   
        //cogemos los datos de la incidencia en json y rellenamos el dialog
        $.getJSON("/estado/"+ $btnInci, function( data ){
            console.log(data.estado);
            $('.idEstado option[value="'+data.estado+'"]').attr('selected','selected');

            $form="<p ><strong>Fecha: </strong>"+ data.created_at +"</p>";
            $form+="<p><strong>Aula: </strong>"+ data.aula +"</p>";
            $form+="<p><strong>Código de equipo: </strong>"+ data.cod_equipo +"</p>";
            $form+="<p><strong>Código de incidencia: </strong>"+ data.cod_incidencia +"</p>";
            $form+="<p><strong>Descripción: </strong>"+ data.descripcion +"</p>";
            $form+="<form action='/estado' method='POST'><input type='hidden' value="+$btnInci+" name='id'> <label for='estado' >Estado de la incidecia</label><br>";
            $form+="<select name='estado' class='idEstado'>";
            $form+='<option value="Sin asignar">Sin asignar</option>';
            $form+='<option value="En proceso">En proceso</option>';
            $form+='<option value="Pausado">Pausado</option>';
            $form+='<option value="Finalizado">Finalizado</option>';
            $form+='</select><br>';
            $form+='<input type="submit" value="Guardar cambios"></form>';
            $( "#dialog" ).append($form)
        });
        
        $( "#dialog" ).dialog( "open" );
    });


    $("#dialog, #dEditar").animate({
        backgroundColor: "rgb(255, 253, 191)",
    });
    //Mostrar un dialogo con la información de la incidencia
    $(".btnInfo").click( function() {
        $("#dialog").empty();   
        var $id=$(this).attr('id');
        $id=$id.substring(4,$id.length)
        console.log($id)
        $.getJSON("/mostrarDato/"+ $id, function( data ){
            $form="<p ><strong>Profesor: </strong>"+ data.user_id +"</p>";
            $form+="<p ><strong>Fecha: </strong>"+ data.created_at +"</p>";
            $form+="<p><strong>Aula: </strong>"+ data.aula +"</p>";
            $form+="<p><strong>Código de equipo: </strong>"+ data.cod_equipo +"</p>";
            $form+="<p><strong>Código de incidencia: </strong>"+ data.cod_incidencia +"</p>";
            $form+="<p><strong>Descripción: </strong>"+ data.descripcion +"</p>";
            $form+="<p><strong>Estado: </strong>"+ data.estado +"</p>";
            $( "#dialog" ).append($form)
        });
        $( "#dialog" ).dialog( "open" );
        
  });
} );
</script>

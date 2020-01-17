
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="header">
        <div id="headerContent">
            <div id="bienvenida"><h2 >¡Bienvenid@!</h2></div>
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
    <div id="cuerpo">
       
        <div align="center">
            <div id="tituloProfe">
                <h2>Mis incidencias</h2>
                <div id='btnAdd'><a href="{{ url('/homeProfesor/formIncidencia') }}">+</a></div>
            </div>
           
            <table >
                <tr>
                    <td>Ver</td>
                    <td>Fecha</td>
                    <td>Aula</td>
                    <td>Código de equipo</td>
                    <td>Tipo de equipo</td>
                    <td>Código de incidencia</td>
                    <td>Estado</td>
                    <td>Editar</td>
                </tr>

                <!--por cada resultado del select de incidencias asociadas a este profesor se crea un tr con los datos de la fila de la bbdd -->                    
                @foreach ($aIncidencias as $incidencia)
                    <tr>
                        <td><img class="btnInfo" id='ver-{{$incidencia->id}}' src="https://image.flaticon.com/icons/png/512/65/65000.png" width="40px;" ></td>
                        <td>{{$incidencia->created_at}}</td>
                        <td>{{$incidencia->aula}}</td>
                        <td>{{$incidencia->cod_equipo}}</td>
                        <td>{{$incidencia->tipo_equipo}}</td>
                        <td>{{$incidencia->cod_incidencia}}</td>                               
                        <td>{{$incidencia->estado}}</td>
                        <!--<td><a href="/editar/{{$incidencia->id}}" ><img id='ed-{{$incidencia->id}}' src="https://pngriver.com/wp-content/uploads/2018/04/Download-Edit-File-Png-Image-80062-For-Designing-Projects.png" class="btnEdit"  width="40px"></td>-->
                        <td><img id='ed-{{$incidencia->id}}' src="https://pngriver.com/wp-content/uploads/2018/04/Download-Edit-File-Png-Image-80062-For-Designing-Projects.png" class="btnEdit"  width="40px"></td>  
                    </tr>
                @endforeach
            </table>
        </div>
            
        <!--DIV DIALOGO--> 
        <div id="dialog" title="Incidencia"></div>
        <div id="dialogEdicion" title="Editar incidencia"></div>
    </div>

</body>
</html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    //colores de la tabla
    $("table tr:even, #tabla2 tr:even").css("background-color","rgb(153,235,149)");
    $("table tr:odd, #tabla2 tr:odd").css("background-color","rgb(194,255,191)");
    $("table tr:first, #tabla2 tr:first").css("background-color","rgb(108,154,106)");
    
    //dialog ver datos
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
        position:{ my: "center top", at: "center top", of:"table" }
    });
    //dialog editar incidencia
    $( "#dialogEdicion" ).dialog({
        autoOpen: false,
        show: {
        effect: "blind",
        duration: 1000
        },
        hide: {
        effect: "blind",
        duration: 1000
        },
        width:'900px',
        position:{ my: "center top", at: "center top", of:"table" }
    });
    $("#dialog, #dialogEdicion").animate({
        backgroundColor: "rgb(255, 253, 191)",
    });
    $(".btnInfo").click( function() {
        $("#dialog").empty();   
        var $id=$(this).attr('id');
        $id=$id.substring(4,$id.length)
        console.log($id)
        $.getJSON("/mostrarDato/"+ $id, function( data ){
            $form="<p ><strong>Fecha: </strong>"+ data.created_at +"</p>";
            $form+="<p><strong>Aula: </strong>"+ data.aula +"</p>";
            $form+="<p><strong>Código de equipo: </strong>"+ data.cod_equipo +"</p>";
            $form+="<p><strong>Código de incidencia: </strong>"+ data.cod_incidencia +"</p>";
            $form+="<p><strong>Descripción: </strong>"+ data.descripcion +"</p>";
            $form+="<p><strong>Estado: </strong>"+ data.estado +"</p>";
            $( "#dialog" ).append($form)
        });
        $( "#dialog" ).dialog( "open" );        
    });

    //Editar estado
    $(".btnEdit").click(function(){
        var $id=$(this).attr('id').substr(3,$(this).attr('id').length);
        console.log($id);
        $("#dialogEdicion").empty();   
        //cogemos los datos de la incidencia en json y rellenamos el dialog
        $.getJSON("/editar/"+ $id, function( data ){
            console.log(data);
            $form="<form action='/editar' method='POST'><input type='hidden' value="+$id+" name='id'>";
            //fecha
            $form+="<label>Fecha</label><input type='text' value='"+data.created_at+"'readonly max='20'>";
            //aula
            $form+="<label>Aula</label><input type='text' value='"+data.aula+"' name='aula'><br>";
            //codigo de equipo
            $form+="<label>Código de equipo</label><input type='text' value='"+data.cod_equipo+"' name='cod_equipo'><br>";
            //tipo de equipo
            $form+="<label>Tipo de equipo</label><input type='hidden' value='"+data.tipo_equipo+"'>";
            $form+="<select name='tipo_equipo' class='tipo_equipo'>";
            $form+='<option value="pc">PC</option>';
            $form+='<option value="pantalla">Pantalla</option>';
            $form+='<option value="impresora">Impresora</option>';
            $form+='</select><br>';
            //cod incidencia
            $form+="<label>Código de incidencia</label><input type='hidden' value='"+data.cod_incidencia+"'>";
            $form+="<select name='cod_incidencia' class='cod_incidencia' id='cod_incidencia'>";
            $form+='<option value="01">01</option>';
            $form+='<option value="02">02</option>';
            $form+='<option value="03">03</option>';
            $form+='<option value="04">04</option>';
            $form+='<option value="05">05</option>';
            $form+='<option value="06">06</option>';
            $form+='<option value="07">07</option>';
            $form+='<option value="08">08</option>';
            $form+='<option value="09">09</option>';
            $form+='<option value="10">10</option>';
            $form+='</select>';
            //estado
            $form+="<label>Estado</label><input type='text' value='"+data.estado+"' readonly ><br>";
            //descripcion
            $form+="<label>Descripción</label><textarea name='descripcion' id='descripcion' cols='50' rows='10'>"+data.descripcion+"</textarea><br>";
            //submit
            $form+='<input type="submit" value="Guardar cambios"></form>';

            //$(".cod_incidencia option[value='"+data.cod_incidencia+"']").attr('selected','selected');
            console.log(data.cod_incidencia)
            $("#cod_incidencia").val("'"+data.cod_incidencia+"'");
            $(".tipo_equipo option[value='"+data.tipo_equipo+"']").attr('selected','selected');

            $( "#dialogEdicion" ).append($form)
        });
        $( "#dialogEdicion" ).dialog( "open" );
        console.log("fin editar")
    });


} );
</script>
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
<style>
    *{
        font-family: 'Lato', sans-serif;
        
    }
    #tituloProfe{
        display: flex;
        xmargin: 20%;
        justify-content: space-between;
    }
    #btnAdd{
        background-color: rgb(153,235,149 ) ;
        position: relative;
        xpadding: 1%;
        margin-top:1%;
        border-radius: 15%;
        border: 4px solid rgb( 122, 255, 104 );
        width: 50px;
    }
    #btnAdd>a{
        text-align: center;
        font-weight: bold;
        font-size: 40px;
        color:black;
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
        font-size: 18px;
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
        padding-left: 10%;
        xpadding: 5%
    }
    label{
        padding: 5%;
    }
    strong, label{
        color: red;
        font-family: 'Times'
    }
    #dialog, #dialogEdicion {
        border: 2px solid green;
        border-radius: 5%;
    }
    
    input[type=submit]{
        margin-left: 40%;
        background-color: rgb( 180, 253, 168);
        border: 2px solid rgb( 115, 252, 93);
        padding: 1%;
        margin-top: 2%;
        font-size: 20px;
    }

    /* IMÁGENES VER Y EDITAR */
    
    img{
        cursor: pointer;
        background-color: rgb( 255, 251, 129 );
        border: 2px solid rgb( 252, 247, 93 );
        border-radius: 5%;
        padding: 7%;
    }
</style>


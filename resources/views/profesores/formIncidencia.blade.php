<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de incidencias</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 

<style>
    *{
        font-family: 'Lato', sans-serif;
        
    }
    .header{
        background-color: rgb(187, 255, 170);
        padding:1%;
    }
    #headerContent{
        width: 70%;
        padding-left:17%;
    }

    body{
        background-color: rgb(255, 253, 191);
        margin:0;
    }

    #cuerpo{
        width: 60%;
        padding-left: 25%;
        xtext-align: center;
        padding-top:5%;
    }
    #bienvenida{
        width: 50%;
        display: inline-block;
        font-size: 30px;
    }
    #formX{
        width: 7%;
        margin-left: 40%;
        display: inline-block;
    }
    #formX>input{
        background-color: rgb( 227, 74, 74 );
        font-size: 20px;
        border: 2px solid rgb( 232, 39, 39 );
        border-radius: 5%;
        padding: 8%;
        font-family: 'Times New Roman';
        color: white;
    }
    #dialogo{
        border: 5px solid green;
        border-radius: 10%;
    }
</style>
<body>
    <div class="header">
        <div id="headerContent">
            <div id="bienvenida"><h2 >Nueva incidencia</h2></div>
            <form action="/homeProfesor" id="formX"><input type="submit" value="X"></form>            
        </div>        
    </div>
    <div id="cuerpo" align="center">
        <div >
            <form action="" method="POST" id="formulario">
                @csrf
                <table>
                    <tr>
                        <td><label>Aula</label></td>
                        <td><input type="text" name="aula" placeholder="107" required></td>
                        <td><label>Código de equipo</label></td>
                        <td><input type="text" name="cod_equipo" placeholder="HZ123456" required></td>
                    </tr>
                    <tr>
                    <td><label>Tipo de equipo</label></td>
                    <td><select name="tipo_equipo">
                                <option value="pc">PC</option>
                                <option value="patalla">Pantalla</option>
                                <option value="impresora">Impresora</option>
                            </select>
                        </td>
                    <td><label>Código de incidencia</label></td>
                    <td>
                        <select name="cod_incidencia">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                            </select>
                            <img id="imgInfo" src="https://image.flaticon.com/icons/png/512/1/1176.png" width="2%">
                    </td>
                    </tr>
                    <tr>
                        <td><label >Descripción</label></td>
                        <td colspan="3"><textarea name="descripcion" id="descripcion" cols="85" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"><input type="submit" value="enviar"></td>
                    </tr>
                </table>        
            </form>
        </div>    
    </div>
    
    <div id="dialogo" title="Listado de errores" >
        
        <ol>Código 01. No funciona la CPU.</ol>
        <ol>Código 02. No se enciende la pantalla.</ol>
        <ol>Código 03. No entra en mi sesión.</ol>
        <ol>Código 04. No navega por internet.</ol>
        <ol>Código 05. No se oye el sonido.</ol>
        <ol>Código 06. No se lee el DVD.</ol>
        <ol>Código 07. Teclado roto.</ol>
        <ol>Código 08. No funciona el ratón.</ol>
        <ol>Código 09. Muy lento para entrar en sesión.</ol>
        <ol>Código 10. Otros.</ol>
       
    </div>
    
</body>
</html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
        $( "#dialogo" ).dialog({
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
            position:{ my: "center ", at: "center ", of:"#formulario" }
        });
        $("#dialogo").animate({
            backgroundColor: "rgb(255, 253, 191)",
        });

        $("#imgInfo").click(function(){
            $( "#dialogo" ).dialog( "open" ); 
        });
    })
</script>
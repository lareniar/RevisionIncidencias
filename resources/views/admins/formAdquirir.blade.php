<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adquirir incidente</title>
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
    <div id="cuerpo" align="center">
        <h2 >¿Desea asignarse esta incidencia?</h2>
        <form action="" method="post">
            @csrf
            <label for=""></label>
            <input type="hidden" name='id' value={{$incidencia->id}}>
            <input type="submit" value="Aceptar" id="btnAceptar">
        </form>
    </div>

</body>
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
        padding-left: 20%;
        xtext-align: center;
        padding-top:10%
    }
    #cuerpo h2{
        padding-left: 7%;
    }
    #exit{
        display: inline-block;
        width: 5%;
        margin-left: 35%;
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
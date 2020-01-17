<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Incidencia</title>
</head>
<body>
    <a href="/homeProfesor" >VOLVER</a>
    
    <form action="" method="post">
        @csrf
        <input type="hidden" value={{$incidencia->id}} name='id'>
        Fecha:
        <input type="text" readonly value={{$incidencia->created_at}}  >
        <br>
        Aula
        <input type="text" value={{$incidencia->aula}} name='aula'>
        <br>
        Código de equipo
        <input type="text" value={{$incidencia->cod_equipo}} name='cod_equipo'>
        <br>
        Tipo de equipo
        <input type="hidden" id='t_equipo' value={{$incidencia->tipo_equipo}}>
        <select name="tipo_equipo" id="tipo_equipo" >
            <option value="pc">PC</option>
            <option value="pantalla">Pantalla</option>
            <option value="impresora">Impresora</option>
        </select>
        <br>
        Código incidencia
        <input type="hidden" id='cd_inci' value={{$incidencia->cod_incidencia}}>
        <select class="opIncidencia" name="cod_incidencia" >
            <option value="01">01</option>
            <option  value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option  value="06">06</option>
            <option  value="07">07</option>
            <option  value="08">08</option>
            <option  value="09">09</option>
            <option  value="10">10</option>
        </select>
        <br>
        Estado
        <input type="text" readonly value={{$incidencia->estado}} >
        <br>
        Admin encargado
        <input type="text" readonly value={{$incidencia->admin_id}}>
        <br>
        Descripción
        <input type="text" value={{$incidencia->descripcion}} name='descripcion'>
        <br><input type="submit" value="Guardar">
    </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    
   
    $(document).ready(function(){
        var codInci= $("#cd_inci").val();
        var tipoEquipo= $("#t_equipo").val();
        console.log(codInci + " codigo incidencia " + tipoEquipo)
        $('.opIncidencia option[value='+codInci+']').attr('selected','selected');
        $('#tipo_equipo option[value='+tipoEquipo+']').attr('selected','selected');
    });

</script>
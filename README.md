# CORRECCIONES DEL PROYECTO

### Tareas a realizar:
- Pide a tu compañero que te añada como colaborador en su proyecto de github|gitlab y obten su código. 
- Instala la aplicación en tu puesto de trabajo y hazla funcionar (documenta los cambios que hayas tenido que realizar para que todo funcione correctamente).

### Prueba de la aplicación:

`1.  Usa la apliación y prueba todas sus funcionalidades. `


   
`2. Comprueba que cumple con los requisitos que se pedían en el enunciado.`

1. No se pueden ver comentarios del administrador al darle al botón Ver.
2. Falta el botón para añadir documentos.

`3. Comprueba que cumple con el checklist de "mínimos de seguridad" de moodle.`
   
`4. Esté bien tabulado.`
   -   <span style="color: green;">Está bien tabulado.</span> 

`5. Cumple con los estándares de codificación y estilos de Laravel.`
-   <span style="color: green;">Los modelos, controladores y migraciones están en nomenclatura Laravel.</span> 

`6. Esté comentado`
- <span style="color: green;">Tiene comentarios en la mayoria de sus partes</span> 
   
`7. No haya nombres de variables|funciones|clases|middlewares que lleven a confusión.`
   
 -  <span style="color: red;">El controlador principal no indica su función, es decir: el controlador de incidencias está nombrado como HomeController y no algo referente a su función.</span> 

`8. Esté todo en un mismo idioma, sea homogéneo etc.`
   
- <span style="color: green;">A pesar de tener alguna mezcla con el inglés, la extensa mayoría está en un mismo idioma salvo cosas en concreto de Laravel como podría ser la palabra Controller.</span> 
  
`10. Fallos de programación.`

- <span style="color: red;">Es obligatorio tener un admin con id 0 para crear incidencias y estas se borran si eliminas el admin de la base de datos.</span> 
- <span style="color: red;"> Está todo creado en las plantillas de por defecto de Laravel, usando los mismos nombres que Laravel proporciona en vez de crear un Controlador y Modelos propios. </span> 

`11. Fallos de estilo.`

-  <span style="color: green;">Usa los estilos adecuadamente.</span> 

`12. Localiza los extractos de código responsables de los fallos enumerados y añádelos a la documentación.`

Interfaz:

1. No hay ningún elemento en pantalla que indique el usuario conectado. Se considera esto un problema ya que un equipo se podría usar por varios profesores y si hacemos auto-login no sabríamos que no estamos usando nuestra cuenta.
2. Los formularios con texto largo entran en celdas diferentes porque no las celdas no tienen un formato tipo flex-box o grid.
3. No hay botones para navegar por la interfaz y estaría bien por ejemplo tener un botón para cancelar la creación de una incidencia.
   
Formularios:

1.  Aula
    1. Al ser input text se le puede meter cualquier valor y este campo no tiene ninguna validación salvo "required". 
2. Código de Equipo
   1. Solo tiene una condición de "required". Se le puede meter cualquier dato. Estaría bien validar con una condición en la que se indique un código de equipo. 
   2. El "placeholder" del campo no está completo y ha sido corregido.

> Al no tener validaciones, podemos modificar los "name" de cada campo e intercambiarlos y cruzar datos.

> El .css está dentro de cada view y esto se podría ahorrar creando un .css propio en /public/css con un enlace en el header: {{ URL::asset('css/css.css') }}"
> Podemos intercambiar los valores de diferentes campos cambiando su valor "name", por lo tanto si al campo aula le ponemos el "name" como nombre_equipo, al no haber validaciones, podremos completar el formulario.


BBDD:

1. Se puede borrar el admin ID=0 manualmente y se borrarán todas las incidencias asociadas a este automáticamente. 
   

User:

1. Tiene que existir un admin para crear incidencias (id 0 en la base de datos) sino salta una ventana de error de PHP:
    - Integrity constraint violation: 1452 Cannot add or update a child row.

    En el momento que existe el admin con ID=0 , nos deja crearlas

2. Hay una condicion al crear una incidencia que no permite crearla(HomeController linea 72). Ocurre que los datos recogidos de la incidencia, dentro de la variable($i), no se verifica bien en la condifion IF e imposibilita crear incidencias.

3. Si salta el error 1, en la BBDD no se genera la incidencia pero si la incidencia tendría que ser la número 4, esta se creará como número 5.

4. Botón Ver incidencias:
    - Se puede modificar el elemento HTML y visualizar incidencias de otros profesores (id="ver-6")
  
5. Botón Editar:
    - Se puede modificar el elemento HTML y editar incidencias de otros profesores (id="ver-6")
    - Se puede modificar las incidencias de otros usuarios cuando entramos a editar cambiando la ID en el paso anterior
    - No hay validación al cambiar el Aula

Admin:

1. Botón Asignar
   1. Se puede modificar el "name" del botón y asignarse una diferencia con una ID distinta. Si modificamos este valor siendo la ID=3, cambiándolo a 5 podremos asignarnos la incidencia nº 5
2. Botón Editar
   1. Si cambiamos el "value" del "select" en el Estado de la Incidencia, podremos asignarnos un estado en la incidencia que no exista.






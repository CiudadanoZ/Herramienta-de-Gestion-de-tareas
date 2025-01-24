# Herramienta-de-Gestion-de-tareas
Tarea de la asignatura de Desarrollo Web.
# Bienvenidos a mi repositorio!
Aqui podras encontrar una explicacion de los diferentes ficheros php, que conforman este proyencto de pagina web.
Con login, registro. Y la posivilidad de añadir post y comentarlos. Tambien podras modificar y eliminar la cuenta 
que hallas creado

## index.php

Es una pagina simple que contiene dos botones uno para **Crear cuenta** y otro para **loguearse**, ademas cuenta con unas imagens flotantes.
Para que se vea mas bonitoñ. (:

------
## registro.php

En esta pagin procederemos a registrarnos, para crear una cuenta. Por ello devemos de conectarnos a la PDO, obtener los datos del formulario, he insertart
los nuestros.

------

## login.php

Esta pagina es para una vez registrados, podamos iniciar sesion. Contiene CSS, HTML y PHP. En el PHP os conectamos a la PDO, despues obtenemos los datos
del formulario, Buscara que los datos coincidan con los guaradados en el registro, verificara las contraseña **(encriptadas)**. Y si todo coincide
redirigira a la pagina **dashboard.php**, que sera nuestra web final.

------


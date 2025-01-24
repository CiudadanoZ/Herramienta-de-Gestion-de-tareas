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

## dashboard.php

Una vez creada la cuenta y pasado el login, seras redirigido a la pagina principal, donde podras postear y comentar a los posts que mande la gente. Volvemos a tener una conexion a la PDO, esta vez para obtener con un **SELECT** los posts que hemos escrito y asi ser visiebles en la pagina.  Despues utilizamos los **htmlspecialchars** para decir como y que queremos que se muestre

------

## comentarios.php

Esto en gran parte es un extra, pero he querido enfocarlo a lo de añadir trabajos en equipo y contenido a la PDO. En mi caso le he hecho con un **comentarios.php** Esta pagina php nos permite crear comentarios y reaccionar a los posts que podemos crear en el **dashboard.php**.
Nos conectamos a la PDO, verificamos la conexion, obtenemos el ID del POST al que queremos comentar, despues de obtener el ID obtenemos los datos del
post. Despues mostraremos los comentariso que ha añadido la gente con los **htmlspecialchars**. Y para finalizar el documente añadimos un Formulario para poenr nuestros comentarios y reacciones.

------





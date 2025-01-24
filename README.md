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

## editar_perfil.php

Con este **editar_perfil.php** cumplimos ua de las tareas, ya que podremos modificar los datos de nuestro perfil **nombre,email e intereses**, consta de un PHP, con el verificaremos si el usuario ha iniciado la sesion con anterioridad con un **if (!isset($_SESSION['user_id']))**, si no es asi no redirigira de nuevo al login.php. Una vez logueados nos conectaremos a la PDO y obtendremos el ID del usuario de la sesion, tras ello consultamos la inforamcion  del usuario con el que nos allamos logueado con un **SELECT**. Despues crearemos la estructura con **HTML** y **CSS**. En el HTML aladiremos los **htmlspecialchars** y **PHP** para añadir los cambios a la base de datos.

------

## eliminar_cuenta.php

Este **eliminat_cuenta.php** esta ligado al **editar_perfil.php** ya que a hambos se accedera en el **perfil.php**. Con este PHP podremos eliminar nuestara cuenta si queremos dejar la web y no volver, o hemos quedado descontentos. El **PHP** comemzamos con un **session_start**, verificamos que el usuario alla iniciado sesion. Despues nos conectamos a la bse de datos y verificamos la conexion, obtenemos el **ID** del usuario para identifivcarle. Tras identificar al usuario en la **PDO**, eliminamkos las publicaciones del usuario con **DELETE FROM**. Tras eliminar las publicaciones del usuario, nos dispondremos a eliminar al usuatio con **$sql = "DELETE FROM usuarios WHERE id = ?";**. Y para terminar destruiremos la sesion y redireccionara al **index.php**


 

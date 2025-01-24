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

"""
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    // Nos conectamos a la base de datos 
    $conn = new mysqli('localhost', 'root', 'Paco1234', 'AmistadApp');

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtenemos los datos del formaulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT); // Encripamos la contraseña

    // Insertar los datos añadidos a la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
    }
"""

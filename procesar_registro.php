<?php
// Iniciar sesión (si necesitas manejar sesiones después del registro)
session_start();

// Conexión a la base de datos
$host = "localhost";
$db_user = "root"; // Cambia esto si tienes otro usuario
$db_password = "Paco1234"; // Cambia esto según tu configuración
$db_name = "AmistadApp";

$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Validar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y sanitizar los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $intereses = $conn->real_escape_string($_POST['intereses']);

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden. <a href='registro.php'>Volver al registro</a>";
        exit;
    }

    // Encriptar la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar el usuario
    $sql = "INSERT INTO usuarios (nombre, email, password, intereses) 
        VALUES ('$nombre', '$email', '$password_hash', '$intereses')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

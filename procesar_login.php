<?php
session_start(); // Inicia la sesión

// Nos conectamos a la base de datos
$conexion = new mysqli("localhost", "root", "Paco1234", "AmistadApp");

// Verificamos si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obténemos los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Verificamos si el usuario existe en la base de datos
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuarios encontrados
    $user = $result->fetch_assoc();

    // Verificamos las contraseñas
    if (password_verify($password, $user['password'])) {
        // Contraseña correcta - guardamos los datos del usuario en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_email'] = $user['email'];

        // Redirige al dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "No existe un usuario con ese correo.";
}

$stmt->close();
$conexion->close();
?>

<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Nos conectamos a la base de datos
$conexion = new mysqli("localhost", "root", "Paco1234", "AmistadApp");

// Verificcamos la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtenemos el ID del usuario
$user_id = $_SESSION['user_id'];

// Eliminamos las publicaciones del usuario
$sql = "DELETE FROM publicaciones WHERE usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// Eliminamos la cuenta del usuario
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

$conexion->close();

// Destruimos la sesión y redirigimos al inicio
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>

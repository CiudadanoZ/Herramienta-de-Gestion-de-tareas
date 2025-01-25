<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Nos conectamos a la base de datos
$conn = new mysqli('localhost', 'root', 'Paco1234', 'AmistadApp');

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtenemos el ID del usuario de la sesión
$usuario_id = $_SESSION['user_id'];

// Obtenemos y sanitizamos los datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$email = $conn->real_escape_string($_POST['email']);
$intereses = $conn->real_escape_string($_POST['intereses']);

// Actualizamos la información del usuario en la base de datos
$sql = "UPDATE usuarios SET nombre = ?, email = ?, intereses = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $nombre, $email, $intereses, $usuario_id);

if ($stmt->execute()) {
    // Redirigirigimos al perfil con un mensaje de éxito
    header('Location: perfil.php?mensaje=Perfil actualizado correctamente');
} else {
    // Redirigimos al perfil con un mensaje de error
    header('Location: perfil.php?mensaje=Error al actualizar el perfil');
}

$stmt->close();
$conn->close();
exit();
?>

<?php
session_start(); // Inicia la sesión

// Verificamos si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Redirige al login si no está autenticado
    header("Location: login.php");
    exit();
}

$host = 'localhost'; // O la IP específica, como '172.17.0.1'
$user = 'root';
$password = 'Retro2005@';
$database = 'AmistadApp';

$conn = new mysqli($host, $user, $password, $database);

// Verificamos si la conexión se ha insertado correctamente
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtenemos el nombre del usuario de la sesión
$usuario = $_SESSION['user_name'];

// Obtenemos los datos del formulario
$texto = $_POST['texto'];
$imagen = null;

// Procesamos imagen si se sube
if (!empty($_FILES['imagen']['name'])) {
    $nombreImagen = basename($_FILES['imagen']['name']);
    $rutaDestino = 'uploads/' . $nombreImagen;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
        $imagen = $rutaDestino;
    }
}

// Insertamos la publicación en la base de datos
$sql = "INSERT INTO publicaciones (usuario, texto, imagen) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $usuario, $texto, $imagen);
$stmt->execute();

$stmt->close();
$conn->close();

// Redirigir al dashboard
header("Location: dashboard.php");
exit;
?>

<?php
// Nos conectamos a la base de datos
$conn = new mysqli('localhost', 'root', 'Retro2005@', 'AmistadApp');

// Verificicamos la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$post_id = intval($_POST['post_id']);
$usuario = $conn->real_escape_string($_POST['usuario']);
$texto = $conn->real_escape_string($_POST['texto']);

// Insertamos comentario
$sql = "INSERT INTO comentarios (post_id, usuario, texto) VALUES ($post_id, '$usuario', '$texto')";
if ($conn->query($sql) === TRUE) {
    header("Location: comentarios.php?id=$post_id");
    exit;
} else {
    echo "Error al insertar comentario: " . $conn->error;
}

// Cerramos la conexión
$conn->close();
?>
    
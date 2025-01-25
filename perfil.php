<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Nos conectamos a la base de datos
$conexion = new mysqli("localhost", "root", "Paco1234", "AmistadApp");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtenemos los datos del usuario
$user_id = $_SESSION['user_id'];
$sql = "SELECT nombre, email, intereses FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre, $email, $intereses);
$stmt->fetch();
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
            font-family: 'Montserrat', sans-serif;
        }
        .profile-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 350px;
            text-align: center;
        }
        .profile-card img {
            width: 100%;
            height: auto;
        }
        .profile-card .profile-info {
            padding: 20px;
        }
        .profile-card .profile-info h2 {
            margin: 0;
            color: #333;
        }
        .profile-card .profile-info p {
            color: #777;
            margin: 5px 0 20px;
        }
        .profile-card .profile-info .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s;
        }
        .profile-card .profile-info .btn:hover {
            background-color: #0056b3;
        }
        .profile-card .profile-info .btn.delete {
            background-color: #dc3545;
        }
        .profile-card .profile-info .btn.delete:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <img src="ruta_a_tu_imagen_de_perfil.jpg" alt="Foto de Perfil">
        <div class="profile-info">
            <h2><?php echo htmlspecialchars($nombre); ?></h2>
            <p>Correo electrónico: <?php echo htmlspecialchars($email); ?></p>
            <p>Intereses: <?php echo htmlspecialchars($intereses); ?></p>
            <a href="logout.php" class="btn btn-secondary">Cerrar Sesión</a>
            <a href="editar_perfil.php" class="btn btn-warning">Editar Perfil</a>
            <a href="eliminar_cuenta.php" class="btn delete" onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">Eliminar Cuenta</a>
        </div>
    </div>
</body>
</html>

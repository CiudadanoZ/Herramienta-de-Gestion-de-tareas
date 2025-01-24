<?php
session_start();

// Verificamos si el usuario ha iniciado sesión con su cuenta
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Nos conectamos a la base de datos
$conn = new mysqli('localhost', 'root', 'Retro2005@', 'AmistadApp');

// Verificamos la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtenemos el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

// Consultamos la información actual del usuario
$sql = "SELECT nombre, email, intereses FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($nombre, $email, $intereses);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - AmistadApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            background: linear-gradient(-45deg, #6a11cb, #2575fc, #6a11cb);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .edit-profile-container {
            max-width: 500px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .edit-profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <h2>Editar Perfil</h2>
        <form action="procesar_editar_perfil.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="intereses" class="form-label">Intereses</label>
                <textarea class="form-control" id="intereses" name="intereses" rows="3" required><?php echo htmlspecialchars($intereses); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>
        <p class="text-center mt-3"><a href="perfil.php">Cancelar</a></p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - AmistadApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&display=swap" rel="stylesheet">
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
            overflow: hidden;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .login-container {
            max-width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-family: 'Jersey 15', sans-serif;
        }
        .form-check-label {
            font-size: 0.9rem;
        }
        .floating-image {
            position: absolute;
            width: 80px;
            height: 80px;
            opacity: 0.8;
            animation: float 5s ease-in-out infinite;
        }
        .floating-image:nth-child(1) {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }
        .floating-image:nth-child(2) {
            top: 30%;
            left: 70%;
            animation-delay: 2s;
        }
        .floating-image:nth-child(3) {
            top: 60%;
            left: 40%;
            animation-delay: 4s;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iniciar_sesion'])) {
    // Nos conectamos a la base de datos
    $conn = new mysqli('localhost', 'root', 'Retro2005@', 'AmistadApp');

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtenemos los datos del formulario
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = $_POST['contraseña'];

    // Buscamos al usuario en la base de datos
    $sql = "SELECT id, nombre, contraseña FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verrificamos la contraseña. para ver que coincida
        if (password_verify($contraseña, $user['contraseña'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            echo "Inicio de sesión exitoso. Bienvenido, " . $user['nombre'];
            // Si es correcto redirigira a la pagina web
            // header('Location: dashboard.php');
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese correo.";
    }

    $conn->close();
}
?>

<body>
    <img src=".\assets\nubes.png" alt="Floating Icon 1" class="floating-image">
    <img src=".\assets\nubes.png" alt="Floating Icon 2" class="floating-image">
    <img src=".\assets\nubes.png" alt="Floating Icon 3" class="floating-image">

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="procesar_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>
        <p class="text-center mt-3">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

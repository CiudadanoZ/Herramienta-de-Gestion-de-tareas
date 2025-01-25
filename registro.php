<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - AmistadApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: orange;
            font-family: Arial, sans-serif;
        }
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-family: 'Jersey 15', sans-serif;
        }
    </style>
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', 'Paco1234', 'AmistadApp');

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtenemos los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT); // Encriptar la contraseña

    // Insertamos los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<body>
    <div class="container">
        <div class="register-container">
            <h2>Crear una cuenta</h2>
            <form action="procesar_registro.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                </div>
                <div class="mb-3">
                    <label for="intereses" class="form-label">Intereses</label>
                    <textarea class="form-control" id="intereses" name="intereses" rows="3" placeholder="Ejemplo: Deportes, música, programación..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

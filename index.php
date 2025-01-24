<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a AmistadApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .hero {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007bff;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.5rem;
            margin: 20px 0;
        }
        .hero .floating-images img {
            position: absolute;
            max-width: 150px;
            animation: float 6s ease-in-out infinite;
        }
        .hero .floating-images img:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        .hero .floating-images img:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 1s;
        }
        .hero .floating-images img:nth-child(3) {
            bottom: 15%;
            left: 20%;
            animation-delay: 2s;
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
<body>
    <!-- Lobby o menu incial de la red, aqui se puede ver una pagina simple con dos botones y unas imagenes flotantes -->
    <div class="hero">
        <div>
            <h1>Bienvenido a AmistadApp</h1>
            <p>Conecta con personas, forma equipos, crea amistades.</p>
            <a href="registro.php" class="btn btn-success btn-lg me-3">Registrarse</a>
            <a href="login.php" class="btn btn-outline-light btn-lg">Iniciar sesión</a>
        </div>
        <div class="floating-images">
            <img src=".\assets\Portada1.png" alt="Imagen 1">
            <img src=".\assets\Portada2.png" alt="Imagen 2">
            <img src=".\assets\Portada3.png" alt="Imagen 3">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

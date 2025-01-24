<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AmistadApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007bff;
            color: white;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .search-bar {
            max-width: 600px;
            margin: 20px auto;
        }
        .profile-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .profile-card:hover {
            transform: translateY(-5px);
        }
        .profile-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .profile-info {
            padding: 15px;
        }
        .profile-info h5 {
            margin: 0;
            color: #007bff;
        }
        .profile-info p {
            margin: 5px 0;
            color: #6c757d;
        }
        .post-section {
            margin-top: 30px;
        }
        .post-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 15px;
        }
        .post-card img {
            width: 100%;
            border-radius: 10px;
            margin-top: 10px;
        }
        .comment-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
        }
        .comment-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>


<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user_name'])) {
    $nombre_usuario = $_SESSION['user_name'];
} else {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AmistadApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Grupos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Amistades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mejores amigos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="search-bar container">
        <input type="text" class="form-control" placeholder="Buscar usuarios o intereses...">
    </div>

    <div class="container mt-4">
        <div class="row g-3">
            <!-- Como quedarian los perfiles al verse conectados -->
            <div class="col-md-4">
                <div class="profile-card">
                    <img src="user1.jpg" alt="Foto de perfil">
                    <div class="profile-info">
                        <h5>María González</h5>
                        <p>Intereses: Cocina, Viajes, Fotografía</p>
                    </div>
                </div>
            </div>
            <!-- Más perfiles -->
        </div>

        <div class="post-section">
            <h3>Publicaciones de la comunidad</h3>

            <!-- Formulario para crear posts, y comunicarse con la comunidad -->
            <div class="mb-4">
                <form action="procesar_post.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="postText" class="form-label">¿Qué quieres compartir?</label>
                        <textarea class="form-control" id="postText" name="texto" rows="3" placeholder="Escribe algo..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="postImage" class="form-label">Subir imagen</label>
                        <input class="form-control" type="file" id="postImage" name="imagen" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </form>
           </div>

            <!-- Mostrar publicaciones dinámicamente -->
            <?php
            // Nos conectamos a la base de datos
            $conn = new mysqli('localhost', 'root', 'Paco1234', 'AmistadApp');

            // Verificamos que la conexion sea correcta
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Obtenemos las publicaciones de la base de datos, para que sean visibles.
            $sql = "SELECT * FROM publicaciones ORDER BY fecha DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="post-card">';
                    echo '<h5>' . htmlspecialchars($row['usuario']) . '</h5>';
                    echo '<p>' . htmlspecialchars($row['texto']) . '</p>';
                    if (!empty($row['imagen'])) {
                        echo '<img src="' . htmlspecialchars($row['imagen']) . '" alt="Imagen de la publicación">';
                    }
                    echo '<button class="comment-button" onclick="window.location.href=\'comentarios.php?id=' . $row['id'] . '\'">Comentar</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay publicaciones aún.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

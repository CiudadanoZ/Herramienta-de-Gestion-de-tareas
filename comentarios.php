<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios - AmistadApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
            color: white;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .post-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 15px;
        }
        .comment-card {
            background-color: #f1f1f1;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .comment-form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">AmistadApp</a>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // Nos conectamos a la base de datos
        $conn = new mysqli('localhost', 'root', 'Retro2005@', 'AmistadApp');

        // Verificamos la conexion
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtenemos el ID del post
        $post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Obtenemos los datos del post
        $sql_post = "SELECT * FROM publicaciones WHERE id = $post_id";
        $result_post = $conn->query($sql_post);

        if ($result_post->num_rows > 0) {
            $post = $result_post->fetch_assoc();
            echo '<div class="post-card">';
            echo '<h5>' . htmlspecialchars($post['usuario']) . '</h5>';
            echo '<p>' . htmlspecialchars($post['texto']) . '</p>';
            if (!empty($post['imagen'])) {
                echo '<img src="' . htmlspecialchars($post['imagen']) . '" alt="Imagen de la publicación" style="width:100%;border-radius:10px;">';
            }
            echo '</div>';
        } else {
            echo '<p>Publicación no encontrada.</p>';
            exit;
        }

        // Mostramos los comentarios, para que la gente puede verlos en la web
        echo '<h4>Comentarios</h4>';
        $sql_comments = "SELECT * FROM comentarios WHERE post_id = $post_id ORDER BY fecha ASC";
        $result_comments = $conn->query($sql_comments);

        if ($result_comments->num_rows > 0) {
            while ($comment = $result_comments->fetch_assoc()) {
                echo '<div class="comment-card">';
                echo '<h6>' . htmlspecialchars($comment['usuario']) . '</h6>';
                echo '<p>' . htmlspecialchars($comment['texto']) . '</p>';
                echo '<small class="text-muted">' . htmlspecialchars($comment['fecha']) . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay comentarios aún. ¡Sé el primero en comentar!</p>';
        }

        // Cerramos la conexion
        $conn->close();
        ?>

        <!-- Formulario para añadir los comentarios -->
        <div class="comment-form">
            <form action="procesar_comentario.php" method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Tu nombre" required>
                </div>
                <div class="mb-3">
                    <label for="texto" class="form-label">Comentario</label>
                    <textarea class="form-control" id="texto" name="texto" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Comentar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

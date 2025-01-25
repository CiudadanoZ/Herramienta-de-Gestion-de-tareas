CREATE DATABASE AmistadApp;

USE AmistadApp;

CREATE TABLE publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    texto TEXT NOT NULL,
    imagen VARCHAR(255),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- ID único para cada usuario
    nombre VARCHAR(255) NOT NULL,       -- Nombre completo del usuario
    email VARCHAR(255) NOT NULL UNIQUE, -- Email único para cada usuario
    password VARCHAR(255) NOT NULL,     -- Contraseña (encriptada)
    intereses TEXT NOT NULL,            -- Intereses del usuario
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de creación del registro
);


CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    usuario VARCHAR(100) NOT NULL,
    texto TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES publicaciones(id) ON DELETE CASCADE
);

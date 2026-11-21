-- =======================================================
-- PROYECTO: Guía del Babytenno (Warframe)
-- MOTOR: MySQL (InnoDB)
-- =======================================================

DROP DATABASE IF EXISTS guia_babytenno;
CREATE DATABASE guia_babytenno CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE guia_babytenno;

-- -------------------------------------------------------
-- TABLA 1: usuarios
-- -------------------------------------------------------
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('lotus', 'cefalon', 'babytenno') NOT NULL DEFAULT 'babytenno',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- TABLA 2: categorias
-- -------------------------------------------------------
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- TABLA 3: guias
-- -------------------------------------------------------
CREATE TABLE guias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_autor INT NOT NULL,
    id_categoria INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    resumen VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    imagen_url VARCHAR(255) DEFAULT 'uploads/default_guide.jpg',
    dificultad ENUM('Principiante', 'Intermedio', 'Avanzado') NOT NULL DEFAULT 'Principiante',
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    -- Si se borra el usuario autor, se borran sus guías (CASCADE)
    CONSTRAINT fk_guia_autor FOREIGN KEY (id_autor) 
        REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE,
    -- Impide borrar una categoría si todavía tiene guías dentro (RESTRICT)
    CONSTRAINT fk_guia_categoria FOREIGN KEY (id_categoria) 
        REFERENCES categorias(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- TABLA 4: arsenal
-- -------------------------------------------------------
CREATE TABLE arsenal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo ENUM('Warframe', 'Arma Primaria', 'Arma Secundaria', 'Cuerpo a Cuerpo', 'Compañero') NOT NULL,
    nombre_objeto VARCHAR(100) NOT NULL,
    maestria_req TINYINT UNSIGNED NOT NULL DEFAULT 0,
    formas_instaladas TINYINT UNSIGNED NOT NULL DEFAULT 0,
    fecha_adquisicion DATE NOT NULL,
    -- Si se borra el usuario, se vacía su arsenal automáticamente (CASCADE)
    CONSTRAINT fk_arsenal_usuario FOREIGN KEY (id_usuario) 
        REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- TABLA 5: valoraciones
-- -------------------------------------------------------
CREATE TABLE valoraciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_guia INT NOT NULL,
    estrellas TINYINT UNSIGNED NOT NULL CHECK (estrellas BETWEEN 1 AND 5),
    comentario TEXT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_val_usuario FOREIGN KEY (id_usuario) 
        REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_val_guia FOREIGN KEY (id_guia) 
        REFERENCES guias(id) ON DELETE CASCADE ON UPDATE CASCADE,
    -- Impide que un mismo usuario valore dos veces la misma guía
    CONSTRAINT uk_usuario_guia UNIQUE (id_usuario, id_guia)
) ENGINE=InnoDB;

-- =======================================================
-- INSERCIÓN DE DATOS DE EJEMPLO (10 registros exactos)
-- =======================================================

-- 1. Usuarios (3 registros: 1 lotus, 1 cefalon, 1 babytenno)
-- Contraseña admin@test.com: admin123
-- Contraseña mod@test.com y usuari@test.com: 12345678
INSERT INTO usuarios (nombre, email, password, rol, fecha_registro) VALUES
('Lotus Central', 'admin@test.com', '$2y$10$8TqZc1qgVxlxU1sL0VLj2ODIx.kpLd6DmHGRwqYpeJXHQJKzXxE0G', 'lotus', '2026-01-10 10:00:00'),
('Cefalón Simaris', 'mod@test.com', '$2y$10$ukBckA5D2aSApHwv/GOKi.P/drP.jwAHOK/9SmWIgRxLUE.x9z.ZK', 'cefalon', '2026-02-01 12:00:00'),
('BabyExcalibur', 'usuari@test.com', '$2y$10$ukBckA5D2aSApHwv/GOKi.P/drP.jwAHOK/9SmWIgRxLUE.x9z.ZK', 'babytenno', '2026-02-15 14:30:00');

-- 2. Categorías (2 registros)
INSERT INTO categorias (nombre, descripcion) VALUES
('Warframes', 'Habilidades, estadísticas base y formas de obtención.'),
('Modding Básico', 'Conceptos de polaridades, capacidades y sinergias.');

-- 3. Guías iniciales (2 registros)
INSERT INTO guias (id_autor, id_categoria, titulo, resumen, contenido, imagen_url, dificultad, fecha_publicacion) VALUES
(1, 1, 'Excalibur: La espada del principio', 'Aprende a dominar la Espada Exaltada.', 'Excalibur es la opción más equilibrada para comenzar...', 'uploads/excalibur.jpg', 'Principiante', '2026-02-01 12:00:00'),
(2, 2, 'Guía de Modding: El secreto del daño', 'Cómo triplicar tu daño usando mods básicos.', 'El daño base no lo es todo...', 'uploads/modding_guia.jpg', 'Intermedio', '2026-02-10 16:45:00');

-- 4. Arsenal (2 registros vinculados al Babytenno)
INSERT INTO arsenal (id_usuario, tipo, nombre_objeto, maestria_req, formas_instaladas, fecha_adquisicion) VALUES
(3, 'Warframe', 'Excalibur', 0, 1, '2026-02-15'),
(3, 'Cuerpo a Cuerpo', 'Skana', 0, 0, '2026-02-15');

-- 5. Valoraciones (1 registro)
INSERT INTO valoraciones (id_usuario, id_guia, estrellas, comentario, fecha) VALUES
(3, 1, 5, 'Me ayudó muchísimo a empezar.', '2026-02-16 11:15:00');
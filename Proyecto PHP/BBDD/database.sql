-- =======================================================
-- PROYECTO: Guía del Babytenno (Warframe)
-- MOTOR: MySQL (InnoDB)
-- =======================================================

-- 1. Borra la base de datos si ya existe para evitar errores al reimportar
DROP DATABASE IF EXISTS guia_babytenno;

-- 2. Crea la base de datos aceptando tildes, eñes y caracteres especiales (utf8mb4)
CREATE DATABASE guia_babytenno CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 3. Selecciona la base de datos recién creada para trabajar sobre ella
USE guia_babytenno;

-- -------------------------------------------------------
-- TABLA 1: usuarios
-- Guarda las cuentas y diferencia los permisos mediante el campo 'rol'
-- -------------------------------------------------------
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('loto', 'babytenno') NOT NULL DEFAULT 'babytenno',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- TABLA 2: categorias
-- Clasifica las guías por temática dentro del juego
-- -------------------------------------------------------
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- -------------------------------------------------------
-- TABLA 3: guias (Entidad Principal 1 - CRUD Completo)
-- Relacionada con 'usuarios' (autor) y 'categorias'
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
-- TABLA 4: arsenal (Entidad Principal 2 - CRUD Completo)
-- Inventario personal vinculado a cada usuario
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
-- TABLA 5: valoraciones (Funcionalidad Extra)
-- Puntuación de 1 a 5 estrellas y reseñas de usuarios sobre las guías
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
-- INSERCIÓN DE DATOS DE EJEMPLO (18 registros en total)
-- =======================================================

-- 1. Usuarios (3 registros)
-- Contraseña para admin@test.com: admin123
-- Contraseña para usuari@test.com y volt@test.com: 12345678
INSERT INTO usuarios (nombre, email, password, rol, fecha_registro) VALUES
('Lotus Central', 'admin@test.com', '$2y$10$8TqZc1qgVxlxU1sL0VLj2ODIx.kpLd6DmHGRwqYpeJXHQJKzXxE0G', 'loto', '2026-01-10 10:00:00'),
('BabyExcalibur', 'usuari@test.com', '$2y$10$ukBckA5D2aSApHwv/GOKi.P/drP.jwAHOK/9SmWIgRxLUE.x9z.ZK', 'babytenno', '2026-02-15 14:30:00'),
('VoltRunner', 'volt@test.com', '$2y$10$ukBckA5D2aSApHwv/GOKi.P/drP.jwAHOK/9SmWIgRxLUE.x9z.ZK', 'babytenno', '2026-03-01 18:00:00');

-- 2. Categorías (4 registros)
INSERT INTO categorias (nombre, descripcion) VALUES
('Warframes', 'Habilidades, estadísticas base y formas de obtención de los trajes de combate.'),
('Armas y Equipo', 'Armamento principal, secundario y cuerpo a cuerpo disponible en el Sistema Origen.'),
('Modding Básico', 'Conceptos de polaridades, capacidades, catalizadores Orokin y sinergias.'),
('Progreso en el Mapa Estelar', 'Cómo desbloquear terminales y farmear recursos esenciales.');

-- 3. Guías iniciales (3 registros creados por el usuario 1: Lotus Central)
INSERT INTO guias (id_autor, id_categoria, titulo, resumen, contenido, imagen_url, dificultad, fecha_publicacion) VALUES
(1, 1, 'Excalibur: La espada del principio', 'Aprende a dominar la Espada Exaltada y sobrevivir en los primeros planetas.', 'Excalibur es la opción más equilibrada para comenzar. Concéntrate en mejorar Vitalidad y Redirección en los mods, y aprovecha su Destello Radial para aturdir a los enemigos más pesados.', 'uploads/excalibur.jpg', 'Principiante', '2026-02-01 12:00:00'),
(1, 3, 'Guía de Modding: El secreto del daño', 'Cómo triplicar tu daño sin gastar Platinum usando mods básicos.', 'El daño base no lo es todo. Combinar daño elemental como Frío y Electricidad para crear Magnetismo, o Toxina y Electricidad para Corrosivo, es vital para atravesar armaduras pesadas.', 'uploads/modding_guia.jpg', 'Principiante', '2026-02-10 16:45:00'),
(1, 4, 'Cómo abrir terminales planetarias', 'Condiciones indispensables para viajar de la Tierra a Venus y Mercurio.', 'Para abrir la terminal de Venus debes completar tareas sencillas: matar enemigos específicos, recolectar esferas de mods y equipar mods en tu Warframe desde el arsenal del orbitador.', 'uploads/junctions.jpg', 'Principiante', '2026-02-18 09:20:00');

-- 4. Arsenal de los usuarios (6 registros repartidos entre los usuarios 2 y 3)
INSERT INTO arsenal (id_usuario, tipo, nombre_objeto, maestria_req, formas_instaladas, fecha_adquisicion) VALUES
(2, 'Warframe', 'Excalibur', 0, 1, '2026-02-15'),
(2, 'Arma Primaria', 'Braton', 0, 0, '2026-02-16'),
(2, 'Arma Secundaria', 'Lato', 0, 0, '2026-02-16'),
(2, 'Cuerpo a Cuerpo', 'Skana', 0, 0, '2026-02-15'),
(3, 'Warframe', 'Volt', 0, 2, '2026-03-01'),
(3, 'Arma Primaria', 'Paris', 0, 0, '2026-03-02');

-- 5. Valoraciones (2 registros de prueba)
INSERT INTO valoraciones (id_usuario, id_guia, estrellas, comentario, fecha) VALUES
(2, 1, 5, 'Me ayudó muchísimo con los primeros niveles en la Tierra.', '2026-02-16 11:15:00'),
(3, 2, 4, 'Muy bien explicado el daño elemental, aunque me costó entender las combinaciones complejas.', '2026-03-03 20:10:00');    
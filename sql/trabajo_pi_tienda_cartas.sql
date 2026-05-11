-- BoardVerse - Base de datos
-- Proyecto intermodular DAW · Florida Universitària · 2025/2026
-- Script completo: crea la BBDD, todas las tablas y carga datos de prueba

DROP DATABASE IF EXISTS trabajo_pi_tienda_cartas;
CREATE DATABASE trabajo_pi_tienda_cartas CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE trabajo_pi_tienda_cartas;

-- ============================================================
-- Tabla productos
-- ============================================================
CREATE TABLE productos (
  id_producto INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  distribuidora VARCHAR(100) DEFAULT NULL,
  categoria VARCHAR(50) DEFAULT NULL,
  precio DECIMAL(10,2) NOT NULL,
  precio_descuento DECIMAL(10,2) DEFAULT NULL,
  stock INT(11) NOT NULL DEFAULT 0,
  descripcion TEXT DEFAULT NULL,
  num_jugadores_min INT(11) DEFAULT NULL,
  num_jugadores_max INT(11) DEFAULT NULL,
  duracion INT(11) DEFAULT NULL,
  edad INT(11) DEFAULT NULL,
  dificultad VARCHAR(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO productos (nombre, distribuidora, categoria, precio, precio_descuento, stock, descripcion, num_jugadores_min, num_jugadores_max, duracion, edad, dificultad) VALUES
('Catan', 'Devir', 'Estrategia', 39.95, NULL, 24, 'El clásico juego donde colonizas la isla de Catan. Gestiona recursos, construye carreteras y ciudades, comercia con tus rivales y conviértete en el colono más influyente. Una partida diferente cada vez gracias a su tablero modular.', 3, 4, 90, 10, 'Media'),
('Carcassonne', 'Devir', 'Familiar', 29.90, NULL, 15, 'Coloca losetas para construir ciudades, caminos, campos y monasterios en el sur de Francia medieval. Coloca tus seguidores estratégicamente y consigue la mayor puntuación posible.', 2, 5, 45, 7, 'Fácil'),
('Terraforming Mars', 'Maldito Games', 'Estrategia', 59.95, NULL, 3, 'Lidera una corporación dedicada a transformar Marte en un planeta habitable. Gestiona recursos, juega proyectos y construye tu legado en el planeta rojo.', 1, 5, 120, 12, 'Difícil'),
('Dixit', 'Libellud', 'Familiar', 32.50, NULL, 0, 'Un juego de cartas ilustradas, narración creativa y deducción. Da pistas sobre tu carta sin ser demasiado obvio ni demasiado críptico, y adivina las cartas de los demás.', 3, 6, 30, 8, 'Fácil'),
('Pandemic', 'Z-Man Games', 'Cooperativo', 42.00, NULL, 12, 'Trabaja en equipo para detener cuatro enfermedades mortales que amenazan al mundo. Juego cooperativo donde todos ganan o todos pierden.', 2, 4, 60, 10, 'Media'),
('7 Wonders', 'Repos Production', 'Estrategia', 49.95, NULL, 18, 'Lidera una de las siete civilizaciones antiguas, construye tu maravilla, desarrolla tu cultura, ciencia y ejército, y compite por dejar huella en la historia.', 3, 7, 30, 10, 'Media'),
('Ticket to Ride', 'Days of Wonder', 'Familiar', 44.90, 39.95, 9, 'Conecta ciudades con tus trenes y completa las rutas secretas que tienes en mano para conseguir más puntos que tus rivales.', 2, 5, 60, 8, 'Fácil'),
('Azul', 'Plan B Games', 'Familiar', 36.95, NULL, 22, 'Decora las paredes del palacio real con azulejos de colores. Un juego de patrones, abstracción y belleza visual donde cada partida es una pequeña obra de arte.', 2, 4, 45, 8, 'Media'),
('Wingspan', 'Stonemaier', 'Estrategia', 54.95, NULL, 7, 'Atrae aves a tus reservas naturales mediante un motor de cartas. Combina hábitats, alimentos y huevos para puntuar al máximo.', 1, 5, 70, 10, 'Media'),
('Bang!', 'Edge', 'Party', 17.95, NULL, 30, 'Juego de farol y deducción en el Salvaje Oeste. Sheriff, ayudantes, forajidos y un renegado se enfrentan en una partida cargada de tensión y traición.', 4, 7, 30, 8, 'Fácil');

-- ============================================================
-- Tabla Usuario (la usa GestorPDO en login/registro)
-- ============================================================
CREATE TABLE Usuario (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Usuario admin de prueba (password = "admin123" hasheado con password_hash de PHP)
INSERT INTO Usuario (email, password) VALUES
('admin@boardverse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('david@ejemplo.com',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ============================================================
-- Tabla clientes
-- ============================================================
CREATE TABLE clientes (
  id_cliente INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  dni VARCHAR(20) NOT NULL UNIQUE,
  telefono VARCHAR(20) DEFAULT NULL,
  correo VARCHAR(100) NOT NULL UNIQUE,
  direccion VARCHAR(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO clientes (nombre, dni, telefono, correo, direccion) VALUES
('Laura Martínez', '12345678A', '666111222', 'laura@ejemplo.com', 'Calle Mayor 1, Valencia'),
('Carlos López',  '23456789B', '666333444', 'carlos@ejemplo.com', 'Avda. del Puerto 10, Valencia'),
('Sara Gómez',    '34567890C', '666555666', 'sara@ejemplo.com', 'Calle Colón 5, Valencia');

-- ============================================================
-- Tabla ventas
-- ============================================================
CREATE TABLE ventas (
  id_venta INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT(11) NOT NULL,
  fecha_venta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabla detalle_venta
-- ============================================================
CREATE TABLE detalle_venta (
  id_detalle INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_venta INT(11) NOT NULL,
  id_producto INT(11) NOT NULL,
  cantidad INT(11) NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
  FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabla eventos (para futuras ampliaciones de la tienda)
-- ============================================================
CREATE TABLE eventos (
  id_evento INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  precio_descuento DECIMAL(10,2) DEFAULT NULL,
  fecha DATE NOT NULL,
  plazas INT(11) NOT NULL DEFAULT 0,
  descripcion TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Tabla inscripciones_evento
-- ============================================================
CREATE TABLE inscripciones_evento (
  id_inscripcion INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT(11) NOT NULL,
  id_evento INT(11) NOT NULL,
  fecha_inscripcion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
  FOREIGN KEY (id_evento) REFERENCES eventos(id_evento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

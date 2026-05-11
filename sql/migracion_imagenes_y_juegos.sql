-- Migración: añade soporte de imágenes y nuevos juegos al catálogo
USE trabajo_pi_tienda_cartas;

-- ============================================================
-- 1) Añadir columna `imagen` a productos
-- ============================================================
ALTER TABLE productos ADD COLUMN imagen VARCHAR(255) DEFAULT NULL AFTER descripcion;

-- ============================================================
-- 2) Asignar nombre de archivo "esperado" a los productos ya existentes
--    (Jonatan solo tiene que poner las fotos en /img con estos nombres)
-- ============================================================
UPDATE productos SET imagen = 'catan.jpg'             WHERE nombre = 'Catan';
UPDATE productos SET imagen = 'carcassonne.jpg'       WHERE nombre = 'Carcassonne';
UPDATE productos SET imagen = 'terraforming-mars.jpg' WHERE nombre = 'Terraforming Mars';
UPDATE productos SET imagen = 'dixit.jpg'             WHERE nombre = 'Dixit';
UPDATE productos SET imagen = 'pandemic.jpg'          WHERE nombre = 'Pandemic';
UPDATE productos SET imagen = '7-wonders.jpg'         WHERE nombre = '7 Wonders';
UPDATE productos SET imagen = 'ticket-to-ride.jpg'    WHERE nombre = 'Ticket to Ride';
UPDATE productos SET imagen = 'azul.jpg'              WHERE nombre = 'Azul';
UPDATE productos SET imagen = 'wingspan.jpg'          WHERE nombre = 'Wingspan';
UPDATE productos SET imagen = 'bang.jpg'              WHERE nombre = 'Bang!';

-- ============================================================
-- 3) Más juegos para tener un catálogo variado (16 en total)
-- ============================================================
INSERT INTO productos (nombre, distribuidora, categoria, precio, precio_descuento, stock, descripcion, imagen, num_jugadores_min, num_jugadores_max, duracion, edad, dificultad) VALUES
('Splendor', 'Space Cowboys', 'Estrategia', 34.95, NULL, 14, 'Recoge fichas de gemas, compra cartas de desarrollo y atrae a nobles para convertirte en el comerciante de joyas más renombrado del Renacimiento. Un juego de motor de cartas elegante y adictivo.', 'splendor.jpg', 2, 4, 30, 10, 'Fácil'),
('Sushi Go!', 'Devir', 'Familiar', 11.95, NULL, 28, 'Pasa cartas, combina platos y consigue la mejor selección de sushi. Un draft rápido, sencillo y muy divertido para toda la familia.', 'sushi-go.jpg', 2, 5, 15, 8, 'Fácil'),
('King of Tokyo', 'Iello', 'Party', 29.95, NULL, 11, 'Encarna a un monstruo gigante y arrasa Tokio a base de dados. Empuja a tus rivales fuera de la ciudad y conviértete en el rey definitivo.', 'king-of-tokyo.jpg', 2, 6, 30, 8, 'Fácil'),
('Codenames', 'Czech Games', 'Party', 19.95, NULL, 20, 'Dos espías maestros guían a sus agentes con pistas de una sola palabra. Juego de asociación de palabras y deducción para grupos grandes.', 'codenames.jpg', 4, 8, 15, 14, 'Fácil'),
('Munchkin', 'Edge', 'Party', 24.95, 19.95, 17, 'Mata monstruos, roba sus tesoros y traiciona a tus amigos. El clásico parody-RPG donde lo divertido es no llevarse bien con nadie.', 'munchkin.jpg', 3, 6, 90, 10, 'Fácil'),
('Spirit Island', 'Greater Than Games', 'Cooperativo', 69.95, NULL, 4, 'Encarna a espíritus de la naturaleza que defienden su isla de la colonización. Juego cooperativo profundo con muchísima rejugabilidad.', 'spirit-island.jpg', 1, 4, 120, 13, 'Difícil');

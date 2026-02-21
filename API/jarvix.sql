-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2026 a las 00:10:51
-- Versión del servidor: 8.4.0
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jarvix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trailers`
--

CREATE TABLE `trailers` (
  `id` int NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `youtube_link` text,
  `image` varchar(255) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `active` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `trailers`
--

INSERT INTO `trailers` (`id`, `title`, `description`, `youtube_link`, `image`, `genre`, `active`) VALUES
(1, 'El hombre araña', 'Un joven obtiene poderes tras la picadura de una araña y debe enfrentar su destino como héroe.', 'https://youtu.be/zWT32yFM8bU?si=Km8Fnc1GLvz7Ekh3', 'spiderman.jpg', 'Accion', 1),
(2, 'Interestelar', 'Un grupo de astronautas viaja por un agujero de gusano buscando un nuevo hogar para la humanidad.', 'https://www.youtube.com/watch?v=zSWdZVtXT7E', 'inter.jpg', 'Ciencia Ficcion', 1),
(3, 'The Batman (2022)', 'Batman investiga corrupción en Gotham mientras enfrenta a un asesino serial.', 'https://www.youtube.com/watch?v=mqqft2x_Aa4', 'batman.jpg', 'Accion', 1),
(4, 'Avengers: Endgame', 'Los Avengers intentan revertir el caos causado por Thanos.', 'https://www.youtube.com/watch?v=TcMBFSGVi1c', 'avengers.jpg', 'Accion', 1),
(5, 'Joker', 'Un comediante fallido cae en la locura y se convierte en el icónico villano.', 'https://www.youtube.com/watch?v=zAGVQLHvwOY', 'joker.jpg', 'Drama', 1),
(6, 'Inception (El Origen)', 'Un ladrón roba secretos entrando en sueños.', 'https://www.youtube.com/watch?v=YoHD9XEInc0', 'interception.jpg', 'Ciencia Ficcion', 1),
(7, 'Titanic', 'Romance épico durante el desastre del Titanic.', 'https://www.youtube.com/watch?v=2e-eXJ6HgkQ', 'titanic.jpg', 'Romance', 1),
(8, 'Rápidos y Furiosos 7', 'Dominic Toretto enfrenta una nueva amenaza.', 'https://www.youtube.com/watch?v=Skpu5HaVkOc', 'rapido.jpg', 'Accion', 1),
(9, 'The Matrix', 'Un hacker descubre la realidad simulada.', 'https://www.youtube.com/watch?v=vKQi3bBA1y8', 'matrix.png', 'Ciencia Ficcion', 1),
(10, 'Jurassic World', 'Dinosaurios desatan caos en un parque.', 'https://www.youtube.com/watch?v=RFinNxS5KN4', 'jurasic.jpg', 'Accion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `plan` varchar(50) DEFAULT 'Gratis',
  `active` tinyint DEFAULT '1',
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `plan`, `active`, `role`) VALUES
(1, 'admin@jarvix.com', '$2y$10$9OSFD1smf8zg84tX1M873ujOPreye3Eorg.I833TY/A1WF5FS8hvq', 'Gratis', 1, 'admin'),
(6, 'adrianriceeoll981@gmail.com', '$2y$10$i0IgIUlB5bem2zFDBYy6HuLx/lcFDuH73acA3HuH13c6sa38YXhPq', 'Basico', 1, 'user'),
(8, 'josueisaias2103@gmail.com', '$2y$10$WCMgaLRpR3okN6dNE6TyTOsVS1CQ4lP3NRN0oyVa5rzfpT1.jF0VW', 'Premium', 1, 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `trailers`
--
ALTER TABLE `trailers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `trailers`
--
ALTER TABLE `trailers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

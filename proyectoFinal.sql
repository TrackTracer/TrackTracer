-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2016 a las 11:09:38
-- Versión del servidor: 5.7.16-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoFinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordenada`
--

CREATE TABLE `coordenada` (
  `codigoCoordenada` int(15) NOT NULL,
  `codigoUsuario` varchar(15) NOT NULL,
  `longitud` varchar(100) NOT NULL,
  `latitud` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `contrasenia` varchar(15) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaAlta` date NOT NULL,
  `tipo` varchar(15) NOT NULL DEFAULT 'usuario',
  `acceso` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `nombre`, `apellidos`, `codigoPostal`, `usuario`, `contrasenia`, `fechaNacimiento`, `fechaAlta`, `tipo`, `acceso`) VALUES
('00001', 'Elena', 'Nito del Valle', 29005, 'usuario', 'usuario', '1980-11-03', '2016-11-21', 'usuario', 1),
('00003', 'Elena', 'Nito del Bosque', 29004, 'admin', 'admin', '1992-11-21', '2016-11-21', 'administrador', 1),
('0004', 'Prueba', 'Prueba Definitiva', 25055, 'pure', 'Prueba1', '2016-11-01', '2016-11-01', 'usuario', 1),
('00045', 'prueabn', 'asdfasdf', 333, 'pru', 'ebando', '2016-11-01', '2015-11-01', 'usuario', 1),
('00100', 'prueba1', 'Insert', 25555, 'prueba1', 'prueba2', '2016-11-01', '2016-11-01', 'usuario', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coordenada`
--
ALTER TABLE `coordenada`
  ADD PRIMARY KEY (`codigoCoordenada`),
  ADD KEY `codigoUsuario` (`codigoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `coordenada`
--
ALTER TABLE `coordenada`
  MODIFY `codigoCoordenada` int(15) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `coordenada`
--
ALTER TABLE `coordenada`
  ADD CONSTRAINT `enlaceCodUsuario` FOREIGN KEY (`codigoUsuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

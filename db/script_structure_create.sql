-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-11-2023 a las 14:33:56
-- Versión del servidor: 10.2.44-MariaDB
-- Versión de PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DELIMITER $$
--
-- Funciones
--
$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL COMMENT 'Id',
  `tipo` varchar(10) DEFAULT 'HOME' COMMENT 'Tipo',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre',
  `descripcion` varchar(255) DEFAULT NULL COMMENT 'Descripción',
  `imagen1` varchar(255) DEFAULT NULL COMMENT 'Imagen 1',
  `imagen2` varchar(255) DEFAULT NULL COMMENT 'Imagen 2',
  `url1` varchar(255) DEFAULT NULL COMMENT 'Url 1',
  `url2` varchar(255) DEFAULT NULL COMMENT 'Url 2',
  `orden` int(11) DEFAULT NULL COMMENT 'Orden',
  `activo` enum('S','N') DEFAULT 'S' COMMENT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla para configurar los direntes banners \n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `img_portada` varchar(100) DEFAULT NULL,
  `img_fondo` varchar(100) DEFAULT NULL,
  `color_txt` varchar(45) DEFAULT '#000000',
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `datos_personales` enum('S','N') DEFAULT 'S',
  `duplicidad` enum('S','N') DEFAULT 'S',
  `orden` int(11) DEFAULT NULL,
  `activo` enum('S','N') DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Configuracion de encuestas';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `encuestas_preguntas`
--

CREATE TABLE `encuestas_preguntas` (
  `id` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `pregunta` varchar(255) DEFAULT NULL,
  `tipo` enum('RADIO','CHECK','INPUT','SELECT') DEFAULT 'RADIO',
  `requerido` enum('S','N') DEFAULT 'S',
  `orden` int(11) DEFAULT NULL,
  `activo` enum('S','N') DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Configuracion de encuestas preguntas';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `encuestas_opciones`
--

CREATE TABLE `encuestas_opciones` (
  `id` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `opcion` varchar(255) DEFAULT NULL,
  `input` enum('S','N') DEFAULT 'N',
  `requerido` enum('S','N') DEFAULT 'S',
  `img_opcion` varchar(100) DEFAULT NULL,
  `img_alto` int(11) DEFAULT NULL,
  `img_ancho` int(11) DEFAULT NULL,  
  `orden` int(11) DEFAULT NULL,
  `activo` enum('S','N') DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Configuracion de encuestas preguntas / opciones';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `enviadas`
--

CREATE TABLE `enviadas` (
  `id` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `huella` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `cod_pais` varchar(25) DEFAULT NULL,
  `cod_region` varchar(25) DEFAULT NULL,
  `activo` enum('S','N') DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro de las encuestas enviadas';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `enviadas_respuestas`
--

CREATE TABLE `enviadas_respuestas` (
  `id` int(11) NOT NULL,
  `id_enviada` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_opcion` int(11) DEFAULT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Registro de las encuestas enviadas respuestas';


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL COMMENT 'Id',
  `id_accion` varchar(30) DEFAULT NULL COMMENT 'Usuario',
  `modulo` varchar(45) DEFAULT NULL COMMENT 'Módulo',
  `accion` varchar(45) DEFAULT NULL COMMENT 'Acción',
  `descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción',
  `ip` varchar(255) DEFAULT NULL COMMENT 'IP',
  `fecha_log` datetime DEFAULT NULL COMMENT 'Fecha Log',
  `usuario` varchar(200) DEFAULT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla para guardar los logs\n';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL COMMENT 'Id',
  `tipo` varchar(10) DEFAULT NULL COMMENT 'Tipo',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Nombre',
  `valor` varchar(255) DEFAULT NULL COMMENT 'Valor',
  `descripcion` varchar(255) DEFAULT NULL COMMENT 'Descripción'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla para guardar los settins (url, vigencia, activo, max imagenes por dia, max ganadores por periodo, correos cc, etc)			\n';

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuestas_opciones`
--
ALTER TABLE `encuestas_opciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1_encuesta_idx` (`id_encuesta`),
  ADD KEY `fk2_encuesta_pregunta_idx` (`id_pregunta`);

--
-- Indices de la tabla `encuestas_preguntas`
--
ALTER TABLE `encuestas_preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1_encuentas_idx` (`id_encuesta`);

--
-- Indices de la tabla `enviadas`
--
ALTER TABLE `enviadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1_encuesta_idx` (`id_encuesta`);

--
-- Indices de la tabla `enviadas_respuestas`
--
ALTER TABLE `enviadas_respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1_enviadas_idx` (`id_enviada`),
  ADD KEY `fk2_encuesta_idx` (`id_encuesta`),
  ADD KEY `fk3_preguntas_idx` (`id_pregunta`),
  ADD KEY `fk4_opciones_idx` (`id_opcion`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `encuestas_opciones`
--
ALTER TABLE `encuestas_opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `encuestas_preguntas`
--
ALTER TABLE `encuestas_preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `enviadas`
--
ALTER TABLE `enviadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `enviadas_respuestas`
--
ALTER TABLE `enviadas_respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

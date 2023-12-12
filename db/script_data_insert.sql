--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `tipo`, `nombre`, `descripcion`, `imagen1`, `imagen2`, `url1`, `url2`, `orden`, `activo`) VALUES
(2, 'HOME', 'Calorcito', 'Calorcito', '1_banner_img.jpeg', '', '', '', 1, 'S'),
(3, 'HOME', 'Calorcito 2', 'Calorcito 2', '1_banner_img.jpeg', '', '', '', 2, 'S');

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `nombre`, `descripcion`, `codigo`, `img_portada`, `img_fondo`, `color_txt`, `fecha_inicio`, `fecha_fin`, `datos_personales`, `duplicidad`, `orden`, `activo`) VALUES
(1, 'Encuesta Calorcito ', 'Encuesta de Calorcito', 'calorcito', '1_encuesta_portada.png', '', '', '2023-10-01 00:00:00', '2023-12-31 23:59:59', 'S', 'N', 1, 'S');

--
-- Volcado de datos para la tabla `encuestas_preguntas`
--

INSERT INTO `encuestas_preguntas` (`id`, `id_encuesta`, `pregunta`, `tipo`, `requerido`, `orden`, `activo`) VALUES
(1, 1, '¿Cuál sería el mejor momento para consumir Calorcito?', 'RADIO', 'S', 3, 'S'),
(2, 1, '¿Qué te gustó de Calorcito?', 'CHECK', 'S', 4, 'S'),
(3, 1, '¿Qué te disgustó de Calorcito? ', 'CHECK', 'S', 5, 'S'),
(4, 1, '¿Después de probar Calorcito, lo comprarías sabiendo que tiene un precio de $22.00?', 'RADIO', 'S', 7, 'S'),
(5, 1, '¿En qué tienda(s) te gustaría encontrar Calorcito?', 'RADIO', 'S', 10, 'S'),
(6, 1, '¿Cuántos años tienes?', 'RADIO', 'N', 12, 'S'),
(7, 1, '¿Con qué género te identificas?', 'RADIO', 'N', 13, 'S'),
(8, 1, '¿Qué producto consumistes?', 'RADIO', 'S', 1, 'S'),
(10, 2, '¿Pregunta prueba 1? ', 'RADIO', 'S', 1, 'S'),
(11, 2, '¿Pregunta prueba 2?', 'CHECK', 'S', 2, 'S'),
(14, 2, '¿Pregunta prueba 3?', 'CHECK', 'S', 3, 'N'),
(15, 2, '¿Pregunta prueba 4?', 'RADIO', 'S', 4, 'N'),
(20, 1, '¿Con qué frecuencia consumes sopa?', 'RADIO', 'S', 2, 'S'),
(21, 1, 'Platícanos con tus palabras lo que te disgustó. ', 'INPUT', 'N', 6, 'S'),
(22, 1, '¿Cómo calificarías el sabor de nuestra sopa en una escala del 1 al 10, siendo 1 \"muy malo\" y 10 \"excelente\"?', 'RADIO', 'S', 8, 'S'),
(23, 1, '¿Has probado otros productos de sopa similares? Si es así, ¿cómo compararías nuestro producto con los competidores en términos de sabor y calidad?', 'INPUT', 'N', 9, 'S'),
(24, 1, '¿Hay algo más que quieras compartir sobre tu experiencia con nuestra sopa?', 'INPUT', 'N', 11, 'S');


--
-- Volcado de datos para la tabla `encuestas_opciones`
--

INSERT INTO `encuestas_opciones` (`id`, `id_encuesta`, `id_pregunta`, `opcion`, `input`, `requerido`, `img_opcion`, `orden`, `activo`) VALUES
(23, 1, 1, 'Mañana', 'N', 'S', '', 1, 'S'),
(24, 1, 1, 'Medio día', 'N', 'S', NULL, 2, 'S'),
(25, 1, 1, 'Tarde', 'N', 'S', NULL, 3, 'S'),
(26, 1, 1, 'Noche', 'N', 'S', NULL, 4, 'S'),
(27, 1, 2, 'Su sabor rico y casero', 'N', 'S', NULL, 1, 'S'),
(28, 1, 2, 'La calidad de los ingredientes', 'N', 'S', NULL, 2, 'S'),
(29, 1, 2, 'Su empaque es atractivo', 'N', 'S', NULL, 3, 'S'),
(30, 1, 2, 'La facilidad de consumo', 'N', 'S', NULL, 4, 'S'),
(31, 1, 2, 'Me satisface la cantidad', 'N', 'S', NULL, 5, 'S'),
(32, 1, 2, 'Otro', 'S', 'S', NULL, 6, 'S'),
(33, 1, 3, 'El sabor', 'N', 'S', NULL, 1, 'S'),
(34, 1, 3, 'El empaque', 'N', 'S', NULL, 3, 'S'),
(35, 1, 3, 'La forma de consumirlo', 'N', 'S', NULL, 4, 'S'),
(36, 1, 3, 'La cantidad', 'N', 'S', NULL, 5, 'S'),
(37, 1, 3, 'La calidad de los ingredientes', 'N', 'S', NULL, 2, 'S'),
(38, 1, 4, 'Sí', 'N', 'S', NULL, 1, 'S'),
(39, 1, 4, 'No', 'N', 'S', NULL, 2, 'S'),
(40, 1, 5, 'Supermercados (Walmart, Soriana, Chedraui, etc.)', 'N', 'S', NULL, 1, 'S'),
(41, 1, 5, 'Tiendas de conveniencia (OXXO, 7 Eleven, GoMart, etc.)', 'N', 'S', NULL, 2, 'S'),
(42, 1, 5, 'Tienditas de abarrotes ', 'N', 'S', NULL, 3, 'S'),
(43, 1, 5, 'Otro', 'S', 'S', NULL, 4, 'S'),
(44, 1, 6, '18-24', 'N', 'S', NULL, 1, 'S'),
(45, 1, 6, '25-34', 'N', 'S', NULL, 2, 'S'),
(46, 1, 6, '35-44', 'N', 'S', NULL, 3, 'S'),
(47, 1, 6, '45-54', 'N', 'S', NULL, 4, 'S'),
(48, 1, 6, '55-64', 'N', 'S', NULL, 5, 'S'),
(49, 1, 6, '65+', 'N', 'S', NULL, 6, 'S'),
(50, 1, 7, 'Masculino', 'N', 'S', NULL, 1, 'S'),
(51, 1, 7, 'Femenino', 'N', 'S', NULL, 2, 'S'),
(52, 1, 7, 'Prefiero no decir', 'N', 'S', NULL, 3, 'S'),
(53, 1, 8, 'Sopa de Tortilla', 'N', 'S', '1_producto_calorciro_sopatortilla.png', 1, 'S'),
(54, 1, 8, 'Tortilla y Hongos', 'N', 'S', '1_producto_calorciro_tortillayhongos.png', 2, 'S'),
(60, 2, 11, 'Opción A', 'N', '', '', 1, 'S'),
(68, 2, 10, 'Opción A P1 x', 'N', 'S', '', 1, 'S'),
(63, 2, 11, 'Opción B', 'N', 'S', '', 3, 'S'),
(71, 1, 20, 'Diariamente', 'N', 'S', NULL, 1, 'S'),
(72, 1, 20, 'Semanalmente', 'N', 'S', NULL, 2, 'S'),
(73, 1, 20, 'Mensualmente', 'N', 'S', NULL, 3, 'S'),
(74, 1, 20, 'Rara vez', 'N', 'S', NULL, 4, 'S'),
(75, 1, 20, 'Nunca', 'N', 'S', NULL, 5, 'S'),
(76, 1, 22, '1 (muy malo)', 'N', 'S', NULL, 1, 'S'),
(77, 1, 22, '2', 'N', 'S', NULL, 2, 'S'),
(78, 1, 22, '3', 'N', 'S', NULL, 3, 'S'),
(79, 1, 22, '4', 'N', 'S', NULL, 4, 'S'),
(80, 1, 22, '5', 'N', 'S', NULL, 5, 'S'),
(81, 1, 22, '6', 'N', 'S', NULL, 5, 'S'),
(82, 1, 22, '7', 'N', 'S', NULL, 6, 'S'),
(83, 1, 22, '8', 'N', 'S', NULL, 7, 'S'),
(84, 1, 22, '9', 'N', 'S', NULL, 8, 'S'),
(85, 1, 22, '10 (Excelente)', 'N', 'S', NULL, 9, 'S');

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `tipo`, `nombre`, `valor`, `descripcion`) VALUES
(1, 'config', 'activo', '1', NULL),
(3, 'config', 'titulo', 'Pepsico - Encuestas', ''),
(4, 'config', 'descripcion', 'Encuestas de nuestros productos de innovación', NULL),
(5, 'config', 'traza', '0', NULL),
(6, 'config', 'pagesize', '10', ''),
(7, 'user', 'admin', '', '1'),
(8, 'user', 'adming64', '', '2');

commit;

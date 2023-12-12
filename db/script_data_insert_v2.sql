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
(8, 1, '¿Qué producto consumistes?', 'RADIO', 'S', 1, 'S'),
(20, 1, '¿Con qué frecuencia consumes sopas instantáneas?', 'RADIO', 'S', 2, 'S'),
(1, 1, '¿Cuál sería el mejor momento para consumir sopas instantáneas?', 'RADIO', 'S', 3, 'S'),
(2, 1, '¿Qué es lo mejor que tiene Calorcito?', 'CHECK', 'S', 4, 'S'),
(25, 1, '¿Cuál sería el mejor momento para consumir Calorcito?', 'RADIO', 'S', 5, 'S'),
(3, 1, '¿Qué le cambiarías a Calorcito?', 'CHECK', 'S', 6, 'S'),
(21, 1, 'Platícanos con tus palabras que le cambiarías a Calorcito', 'INPUT', 'N', 7, 'S'),
(4, 1, '¿Después de probar Calorcito, que pensarías si te dijera que tiene un precio de $25.00?', 'RADIO', 'S', 8, 'S'),
(26, 1, '¿Y por qué dices / crees esto?', 'INPUT', 'N', 9, 'S'),
(22, 1, '¿Cómo calificarías el sabor de nuestra sopa?', 'RADIO', 'S', 10, 'S'),
(23, 1, '¿Has probado otros productos de sopa similares? Si es así, ¿cómo compararías nuestro producto con los competidores en términos de sabor y calidad?', 'INPUT', 'N', 11, 'S'),
(5, 1, '¿En qué tienda(s) te gustaría encontrar Calorcito?', 'RADIO', 'S', 12, 'S'),
(24, 1, '¿Hay algo más que quieras compartir sobre tu experiencia con nuestra sopa?', 'INPUT', 'N', 13, 'S'),
(6, 1, '¿Cuántos años tienes?', 'RADIO', 'N', 14, 'S'),
(7, 1, '¿Con qué género te identificas?', 'RADIO', 'N', 15, 'S'),
(27, 1, '¿Cuál es tu codigo postal?', 'INPUT', 'N', 16, 'S');

--
-- Volcado de datos para la tabla `encuestas_opciones`
--

INSERT INTO `encuestas_opciones` (`id`, `id_encuesta`, `id_pregunta`, `opcion`, `input`, `requerido`, `img_opcion`, `orden`, `activo`) VALUES
(53, 1, 8, 'Sopa de Tortilla', 'N', 'S', '1_producto_calorciro_sopatortilla.png', 1, 'S'),
(54, 1, 8, 'Tortilla y Hongos', 'N', 'S', '1_producto_calorciro_tortillayhongos.png', 2, 'S'),
(71, 1, 20, 'Diariamente', 'N', 'S', NULL, 1, 'S'),
(72, 1, 20, 'Semanalmente', 'N', 'S', NULL, 2, 'S'),
(73, 1, 20, 'Mensualmente', 'N', 'S', NULL, 3, 'S'),
(74, 1, 20, 'Rara vez', 'N', 'S', NULL, 4, 'S'),
(75, 1, 20, 'Nunca', 'N', 'S', NULL, 5, 'S'),
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
(84, 1, 25, 'Mañana', 'N', 'S', '', 1, 'S'),
(85, 1, 25, 'Medio día', 'N', 'S', NULL, 2, 'S'),
(86, 1, 25, 'Tarde', 'N', 'S', NULL, 3, 'S'),
(87, 1, 25, 'Noche', 'N', 'S', NULL, 4, 'S'),
(33, 1, 3, 'El sabor', 'N', 'S', NULL, 1, 'S'),
(34, 1, 3, 'El empaque', 'N', 'S', NULL, 2, 'S'),
(35, 1, 3, 'La forma de consumirlo', 'N', 'S', NULL, 3, 'S'),
(36, 1, 3, 'La cantidad', 'N', 'S', NULL, 4, 'S'),
(37, 1, 3, 'Otro', 'S', 'S', NULL, 5, 'S'),
(38, 1, 4, 'Vale más de lo que cuesta', 'N', 'S', NULL, 1, 'S'),
(39, 1, 4, 'Tiene un precio justo', 'N', 'S', NULL, 2, 'S'),
(88, 1, 4, 'Vale menos de lo que cuesta', 'N', 'S', NULL, 3, 'S'),
(76, 1, 22, 'No me gusto', 'N', 'S', NULL, 1, 'S'),
(77, 1, 22, 'Regular', 'N', 'S', NULL, 2, 'S'),
(78, 1, 22, 'Bueno', 'N', 'S', NULL, 3, 'S'),
(79, 1, 22, 'Excelente', 'N', 'S', NULL, 4, 'S'),
(80, 1, 23, 'Es mejor en sabor y calidad que otras sopas instantáneas', 'N', 'S', NULL, 1, 'S'),
(81, 1, 23, 'Es igual en sabor y calidad que otras sopas instantáneas', 'N', 'S', NULL, 2, 'S'),
(82, 1, 23, 'Es igual en sabor y calidad que otras sopas instantáneas', 'N', 'S', NULL, 3, 'S'),
(83, 1, 23, 'No he probado otros productos similares', 'N', 'S', NULL, 4, 'S'),
(40, 1, 5, 'Supermercados (Walmart, Soriana, Chedraui, etc.)', 'N', 'S', NULL, 1, 'S'),
(41, 1, 5, 'Tiendas de conveniencia (OXXO, 7 Eleven, GoMart, etc.)', 'N', 'S', NULL, 2, 'S'),
(42, 1, 5, 'Tienditas de abarrotes', 'N', 'S', NULL, 3, 'S'),
(89, 1, 5, 'Bodegas', 'N', 'S', NULL, 4, 'S'),
(43, 1, 5, 'Otro', 'S', 'S', NULL, 5, 'S'),
(44, 1, 6, '18-24', 'N', 'S', NULL, 1, 'S'),
(45, 1, 6, '25-34', 'N', 'S', NULL, 2, 'S'),
(46, 1, 6, '35-44', 'N', 'S', NULL, 3, 'S'),
(47, 1, 6, '45-54', 'N', 'S', NULL, 4, 'S'),
(48, 1, 6, '55-64', 'N', 'S', NULL, 5, 'S'),
(49, 1, 6, '65+', 'N', 'S', NULL, 6, 'S'),
(50, 1, 7, 'Masculino', 'N', 'S', NULL, 1, 'S'),
(51, 1, 7, 'Femenino', 'N', 'S', NULL, 2, 'S'),
(52, 1, 7, 'Prefiero no decir', 'N', 'S', NULL, 3, 'S');

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `tipo`, `nombre`, `valor`, `descripcion`) VALUES
(1, 'config', 'activo', '1', NULL),
(3, 'config', 'titulo', 'Pepsico - Labbi', ''),
(4, 'config', 'descripcion', 'Encuestas de nuestros productos de innovación', NULL),
(5, 'config', 'traza', '0', NULL),
(6, 'config', 'pagesize', '10', ''),
(7, 'user', 'admin', '', '1'),
(8, 'user', 'adming64', '', '2'),
(9, 'reserv', 'SCRIPT', '', ''),
(10, 'reserv', 'SELECT', '', ''),
(11, 'reserv', 'UPDATE', '', ''),
(12, 'reserv', 'INSERT', '', ''),
(13, 'reserv', 'SELECT', '', ''),
(14, 'reserv', 'DELETE', '', ''),
(15, 'reserv', 'GRANT', '', ''),
(16, 'reserv', 'SELECT', '', ''),
(17, 'reserv', 'REVOKE', '', ''),
(18, 'reserv', 'DROP', '', ''),
(19, 'reserv', 'CREATE', '', ''),
(20, 'reserv', 'SUBSTR', '', ''),
(21, 'reserv', 'ASCII', '', '');

commit;

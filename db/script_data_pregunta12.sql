-- update encuestas_opciones
update encuestas_opciones
  set img_opcion = 'tienda_blanco.png;tiendas'
where id = 99;

-- delete  encuestas_opciones
-- insert  encuestas_opciones
INSERT INTO `encuestas_opciones` (`id`, `id_encuesta`, `id_pregunta`, `opcion`, `input`, `requerido`, `img_opcion`, `orden`, `activo`) VALUES
(94, 1, 5, 'En casa', 'N', 'S', 'tienda_1.png;tiendas', 1, 'S'),
(95, 1, 5, 'En la oficina/ trabajo', 'N', 'S', 'tienda_2.png;tiendas', 2, 'S'),
(96, 1, 5, 'En casa de amigos/ familiares', 'N', 'S', 'tienda_3.png;tiendas', 3, 'S'),
(97, 1, 5, 'En la escuela/ universidad', 'N', 'S', 'tienda_4.png;tiendas', 4, 'S'),
(98, 1, 5, 'En la calle', 'N', 'S', 'tienda_5.png;tiendas', 4, 'S'),
(99, 1, 5, 'Otro', 'S', 'S', 'tienda_6.png;tiendas', 5, 'S');

commit;

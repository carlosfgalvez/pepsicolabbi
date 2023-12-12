-- update encuestas_opciones
update encuestas_opciones
  set img_opcion = 'tienda_blanco.png;tiendas'
where id = 99;

update encuestas_opciones
  set orden = 6
where id = 37;


-- delete  encuestas_opciones
-- insert  encuestas_opciones
INSERT INTO `encuestas_opciones` (`id`, `id_encuesta`, `id_pregunta`, `opcion`, `input`, `requerido`, `img_opcion`, `orden`, `activo`) VALUES
(101, 1, 3, 'Nada', 'N', 'S', '', 5, 'S');

commit;
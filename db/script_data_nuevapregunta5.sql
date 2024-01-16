-- insert ecnuestas_preguntas
INSERT INTO `encuestas_preguntas` (`id`, `id_encuesta`, `pregunta`, `tipo`, `requerido`, `orden`, `activo`) VALUES
(28, 1, '¿Te gusta el nombre Calorcito para este producto?', 'RADIO', 'N', 5, 'S');

-- update ecnuestas_preguntas
update `encuestas_preguntas`
  set orden = 6
where id = 22;

update `encuestas_preguntas`
  set orden = 7
where id = 25;

update `encuestas_preguntas`
  set orden = 8
where id = 3;

update `encuestas_preguntas`
  set orden = 9
where id = 21;

update `encuestas_preguntas`
  set orden = 10
where id = 4;

update `encuestas_preguntas`
  set orden = 11
where id = 26;

update `encuestas_preguntas`
  set orden = 12
where id = 23;

update `encuestas_preguntas`
  set orden = 13
where id = 5;

update `encuestas_preguntas`
  set orden = 14
where id = 24;

update `encuestas_preguntas`
  set orden = 15
where id = 6;

update `encuestas_preguntas`
  set orden = 16
where id = 7;

update `encuestas_preguntas`
  set orden = 17
where id = 27;

-- insert  encuestas_opciones
INSERT INTO `encuestas_opciones` (`id`, `id_encuesta`, `id_pregunta`, `opcion`, `input`, `requerido`,  `orden`, `activo`) VALUES
(102, 1, 28, 'Si ¿Por qué?', 'S', 'N', 1, 'S'),
(103, 1, 28, 'No ¿Por qué?', 'S', 'N', 2, 'S');

commit;

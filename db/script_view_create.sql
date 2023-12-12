-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-11-2023 a las 14:56:50
-- Versión del servidor: 10.2.44-MariaDB
-- Versión de PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Estructura para la vista `v_encuestas_enviadas`
--

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `v_encuestas_enviadas`  AS
SELECT
`T`.`id_encuesta` AS `id_encuesta`,
`T`.`fecha` AS `fecha`,
 `T`.`hora` AS `hora`,
 `T`.`ip` AS `ip`,
 `T`.`nombre` AS `nombre`,
 `T`.`correo` AS `correo`,
 `T`.`telefono` AS `telefono`,
 max(`T`.`Pregunta_1`) AS `Pregunta_1`,
 max(`T`.`Respuesta_1`) AS `Respuesta_1`,
 max(`T`.`Pregunta_2`) AS `Pregunta_2`,
 max(`T`.`Respuesta_2`) AS `Respuesta_2`,
 max(`T`.`Pregunta_3`) AS `Pregunta_3`,
 max(`T`.`Respuesta_3`) AS `Respuesta_3`,
 max(`T`.`Pregunta_4`) AS `Pregunta_4`,
 max(`T`.`Respuesta_4`) AS `Respuesta_4`,
 max(`T`.`Pregunta_5`) AS `Pregunta_5`,
 max(`T`.`Respuesta_5`) AS `Respuesta_5`,
 max(`T`.`Pregunta_6`) AS `Pregunta_6`,
 max(`T`.`Respuesta_6`) AS `Respuesta_6`,
 max(`T`.`Pregunta_7`) AS `Pregunta_7`,
 max(`T`.`Respuesta_7`) AS `Respuesta_7`,
 max(`T`.`Pregunta_8`) AS `Pregunta_8`,
 max(`T`.`Respuesta_8`) AS `Respuesta_8`,
 max(`T`.`Pregunta_9`) AS `Pregunta_9`,
 max(`T`.`Respuesta_9`) AS `Respuesta_9`,
 max(`T`.`Pregunta_10`) AS `Pregunta_10`,
 max(`T`.`Respuesta_10`) AS `Respuesta_10`,
max(`T`.`Pregunta_11`) AS `Pregunta_11`,
 max(`T`.`Respuesta_11`) AS `Respuesta_11`,
 max(`T`.`Pregunta_12`) AS `Pregunta_12`,
 max(`T`.`Respuesta_12`) AS `Respuesta_12`,
 max(`T`.`Pregunta_13`) AS `Pregunta_13`,
 max(`T`.`Respuesta_13`) AS `Respuesta_13`,
 max(`T`.`Pregunta_14`) AS `Pregunta_14`,
 max(`T`.`Respuesta_14`) AS `Respuesta_14`,
 max(`T`.`Pregunta_15`) AS `Pregunta_15`,
 max(`T`.`Respuesta_15`) AS `Respuesta_15`
 FROM (select `a`.`id_encuesta` AS `id_encuesta`,
 date_format(`a`.`fecha`,'%d/%m/%Y') AS `fecha`,
 date_format(`a`.`fecha`,'%H:%i') AS `hora`,
 `a`.`ip` AS `ip`,`a`.`nombre` AS `nombre`,
 `a`.`correo` AS `correo`,
 `a`.`telefono` AS `telefono`,
 case when `d`.`orden` = 1 then `d`.`pregunta` end AS `Pregunta_1`,
 case when `d`.`orden` = 1 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_1`,
 case when `d`.`orden` = 2 then `d`.`pregunta` end AS `Pregunta_2`,
 case when `d`.`orden` = 2 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_2`,
 case when `d`.`orden` = 3 then `d`.`pregunta` end AS `Pregunta_3`,
 case when `d`.`orden` = 3 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_3`,
 case when `d`.`orden` = 4 then `d`.`pregunta` end AS `Pregunta_4`,
 case when `d`.`orden` = 4 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_4`,
 case when `d`.`orden` = 5 then `d`.`pregunta` end AS `Pregunta_5`,
 case when `d`.`orden` = 5 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_5`,
 case when `d`.`orden` = 6 then `d`.`pregunta` end AS `Pregunta_6`,
 case when `d`.`orden` = 6 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_6`,
 case when `d`.`orden` = 7 then `d`.`pregunta` end AS `Pregunta_7`,
 case when `d`.`orden` = 7 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_7`,
 case when `d`.`orden` = 8 then `d`.`pregunta` end AS `Pregunta_8`,
 case when `d`.`orden` = 8 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_8`,
 case when `d`.`orden` = 9 then `d`.`pregunta` end AS `Pregunta_9`,
 case when `d`.`orden` = 9 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_9`,
 case when `d`.`orden` = 10 then `d`.`pregunta` end AS `Pregunta_10`,
 case when `d`.`orden` = 10 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_10`,
 case when `d`.`orden` = 11 then `d`.`pregunta` end AS `Pregunta_11`,
 case when `d`.`orden` = 11 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_11`,
 case when `d`.`orden` = 12 then `d`.`pregunta` end AS `Pregunta_12`,
 case when `d`.`orden` = 12 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_12`,
 case when `d`.`orden` = 13 then `d`.`pregunta` end AS `Pregunta_13`,
 case when `d`.`orden` = 13 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_13`,
 case when `d`.`orden` = 14 then `d`.`pregunta` end AS `Pregunta_14`,
 case when `d`.`orden` = 14 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_14`,
 case when `d`.`orden` = 15 then `d`.`pregunta` end AS `Pregunta_15`,
 case when `d`.`orden` = 15 then `get_pregunta_respuesta`(`a`.`id`,`a`.`id_encuesta`,`c`.`id_pregunta`) end AS `Respuesta_15`
 from (((`enviadas` `a` left join `encuestas` `b` on(`a`.`id_encuesta` = `b`.`id`))
 left join `enviadas_respuestas` `c` on(`c`.`id_enviada` = `a`.`id`))
 left join `encuestas_preguntas` `d` on(`d`.`id` = `c`.`id_pregunta` and `d`.`id_encuesta` = `c`.`id_encuesta`))
 group by `a`.`id_encuesta`,date_format(`a`.`fecha`,'%d/%m/%Y'),date_format(`a`.`fecha`,'%H:%i'),`a`.`ip`,`a`.`nombre`,`a`.`correo`,`a`.`telefono`,`c`.`id_pregunta`
 order by `a`.`id_encuesta`,`a`.`fecha`,`d`.`orden`)
 AS `T` GROUP BY `T`.`id_encuesta`, `T`.`fecha`, `T`.`hora`, `T`.`ip`, `T`.`nombre`, `T`.`correo`, `T`.`telefono` ;

--
-- VIEW `v_encuestas_enviadas`
-- Datos: Ninguna
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

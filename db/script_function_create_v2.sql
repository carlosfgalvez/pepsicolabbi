DELIMITER $$

CREATE FUNCTION `get_pregunta_respuesta` (var_id INT, var_id_encuesta INT, var_id_pregunta INT)
RETURNS VARCHAR(255)
BEGIN
	DECLARE var_respuestas VARCHAR(255) DEFAULT "";    
    DECLARE var_respuesta VARCHAR(255) DEFAULT "";   
    DECLARE var_cont INT DEFAULT 0;
    DECLARE finished INTEGER DEFAULT 0;    

	-- declare cursor 
	DEClARE curRespuestas
		CURSOR FOR 
			SELECT 
                 IF(respuesta is null, opcion, IF(opcion is null, respuesta, CONCAT(opcion,': ',respuesta))) respuesta
              FROM enviadas_respuestas a
            LEFT JOIN encuestas_opciones b ON b.id = a.id_opcion AND b.id_encuesta = a.id_encuesta AND b.id_pregunta = a.id_pregunta
            WHERE a.id_enviada = var_id
              AND a.id_encuesta = var_id_encuesta
              AND a.id_pregunta = var_id_pregunta;
              
	-- declare NOT FOUND handler
	DECLARE CONTINUE HANDLER 
	FOR NOT FOUND SET finished = 1;
    
    OPEN curRespuestas;
    
     ciclo: LOOP
		FETCH curRespuestas INTO var_respuesta;
		IF finished = 1 THEN 
			LEAVE ciclo;
		END IF;

        IF var_cont = 0 THEN 
           SET var_respuestas = var_respuesta;
		   SET var_cont = var_cont + 1;
		ELSE
		 SET var_respuestas = CONCAT(var_respuestas,"; ",var_respuesta);
         SET var_cont = var_cont + 1;
		END IF;
	END LOOP ciclo;
    
    CLOSE curRespuestas;

	RETURN var_respuestas;
END$$

DELIMITER ;
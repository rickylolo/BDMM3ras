USE BDMM_PROYECTO;

DROP FUNCTION IF EXISTS promedioCurso;
DELIMITER //
CREATE FUNCTION promedioCurso (p_idCurso INT )
RETURNS INT READS SQL DATA

BEGIN
   DECLARE miPromedio INT;
   SELECT AVG(nivelesCompletados) INTO miPromedio FROM usuarioCurso WHERE Curso_id = p_idCurso;
   SET miPromedio= IFNULL(miPromedio,0);
   RETURN miPromedio;
END; //
DELIMITER ;


DROP FUNCTION IF EXISTS ingresosCurso;
DELIMITER //
CREATE FUNCTION ingresosCurso (p_idCurso INT )
RETURNS INT READS SQL DATA

BEGIN
   DECLARE miSuma INT;
   DECLARE miSumaTotalUsuarioCurso INT;
   DECLARE miSumaTotalUsuarioNivel INT;
   SELECT SUM(costoCurso) INTO miSumaTotalUsuarioCurso FROM usuarioCurso WHERE Curso_id = p_idCurso;
   SET miSumaTotalUsuarioCurso= IFNULL(miSumaTotalUsuarioCurso,0);
   
   SELECT SUM(A.costoNivel) INTO miSumaTotalUsuarioNivel FROM nivelCurso A
   LEFT JOIN usuarioCurso B 
   ON A.usuarioCurso_id = B.usuarioCurso_id
   WHERE B.Curso_id = p_idCurso;
   SET miSumaTotalUsuarioNivel= IFNULL(miSumaTotalUsuarioNivel,0);
   
   SET miSuma = miSumaTotalUsuarioCurso + miSumaTotalUsuarioNivel;
   RETURN miSuma;
END; //
DELIMITER ;

DROP FUNCTION IF EXISTS contarAlumnos;
DELIMITER //
CREATE FUNCTION contarAlumnos (p_idCurso INT )
RETURNS INT READS SQL DATA

BEGIN
   DECLARE miNumeroAlumnos INT;
   SELECT COUNT(Usuario_id) INTO miNumeroAlumnos FROM usuarioCurso WHERE Curso_id = p_idCurso;
   SET miNumeroAlumnos= IFNULL(miNumeroAlumnos,0);
   RETURN miNumeroAlumnos;
END; //
DELIMITER ;


DROP FUNCTION IF EXISTS contarNiveles;
DELIMITER //
CREATE FUNCTION contarNiveles (p_idCurso INT )
RETURNS INT READS SQL DATA

BEGIN
   DECLARE miNumeroNiveles INT;
   SELECT COUNT(Nivel_id) INTO miNumeroNiveles FROM Nivel WHERE Curso_id = p_idCurso;
   SET miNumeroNiveles= IFNULL(miNumeroNiveles,0);
   RETURN miNumeroNiveles;
END; //
DELIMITER ;


USE BDMM_PROYECTO;


DROP TRIGGER IF EXISTS trigger_DeleteCategoria;
DELIMITER //

CREATE TRIGGER trigger_DeleteCategoria
    BEFORE DELETE
    ON Categoria FOR EACH ROW
BEGIN
   DELETE FROM CategoriaProducto
    WHERE CategoriaProducto.Categoria_id= OLD.Categoria_id;

END//    
DELIMITER ;


DROP TRIGGER IF EXISTS trigger_DeleteMetodoPago;
DELIMITER //

CREATE TRIGGER trigger_DeleteMetodoPago
    BEFORE DELETE
    ON MetodoPago FOR EACH ROW
BEGIN
   DELETE FROM nivelCurso
    WHERE nivelCurso.MetodoPago_id= OLD.MetodoPago_id;
     DELETE FROM usuarioCurso
    WHERE usuarioCurso.MetodoPago_id= OLD.MetodoPago_id;
    UPDATE Usuario SET MetodoPago_id = NULL WHERE Usuario.MetodoPago_id= OLD.MetodoPago_id;

END//    
DELIMITER ;


DROP TRIGGER IF EXISTS trigger_DeleteNivel;
DELIMITER //

CREATE TRIGGER trigger_DeleteNivel
    BEFORE DELETE
    ON Nivel FOR EACH ROW
BEGIN
	DELETE FROM Multimedia
	WHERE Multimedia.Nivel_id= OLD.Nivel_id;
END//    
DELIMITER ;


DROP TRIGGER IF EXISTS trigger_aumentarNivelesCurso;
DELIMITER //
CREATE TRIGGER trigger_aumentarNivelesCurso
    AFTER INSERT
    ON Nivel FOR EACH ROW
BEGIN
   UPDATE Curso 
   SET noNiveles = noNiveles + 1 
   WHERE Curso.Curso_id= NEW.Curso_id;
END//    
DELIMITER ;


DROP TRIGGER IF EXISTS trigger_reducirNivelesCurso;
DELIMITER //
CREATE TRIGGER trigger_reducirNivelesCurso
    AFTER DELETE
    ON Nivel FOR EACH ROW
BEGIN
   UPDATE Curso 
   SET noNiveles = (SELECT COUNT(Nivel_id) FROM Nivel WHERE Nivel.Curso_id = OLD.Curso_id)
   WHERE Curso.Curso_id= OLD.Curso_id;
END//    
DELIMITER ;


DROP TRIGGER IF EXISTS trigger_insertarNiveles;
DELIMITER //
CREATE TRIGGER trigger_insertarNiveles
    AFTER INSERT
    ON usuarioCurso FOR EACH ROW
BEGIN
	
	INSERT INTO nivelCurso (MetodoPago_id, usuarioCurso_id, Usuario_id, Nivel_id, tiempoRegistro, costoNivel)
	SELECT NEW.MetodoPago_id, NEW.usuarioCurso_id, NEW.Usuario_id, B.nivel_id, NOW(), 0
	FROM Nivel B
	WHERE B.curso_id = NEW.curso_id AND NEW.costoCurso <> 0
	AND NOT EXISTS (
    SELECT 1
    FROM nivelCurso A
    WHERE A.Usuario_id = NEW.Usuario_id
    AND A.Nivel_id = B.nivel_id
);
END//    
DELIMITER ;



DROP TRIGGER IF EXISTS trigger_aumentarNivelesCompletados;
DELIMITER //
CREATE TRIGGER trigger_aumentarNivelesCompletados
    AFTER UPDATE
    ON nivelCurso FOR EACH ROW
BEGIN
   UPDATE usuarioCurso 
   SET nivelesCompletados = nivelesCompletados + 1 
   WHERE usuarioCurso.usuarioCurso_id= OLD.usuarioCurso_id AND OLD.isFinalizado <> NEW.isFinalizado;
   
    UPDATE usuarioCurso 
   SET isFinalizado = 1, tiempoCompletado = NOW() 
   WHERE usuarioCurso.usuarioCurso_id = OLD.usuarioCurso_id 
     AND usuarioCurso.nivelesCompletados = (SELECT noNiveles FROM Curso WHERE Curso.Curso_id = usuarioCurso.Curso_id);
END//    
DELIMITER ;


SELECT * FROM ComentarioCurso;

DROP TRIGGER IF EXISTS trigger_aumentarComentarios;
DELIMITER //
CREATE TRIGGER trigger_aumentarComentarios
    AFTER INSERT
    ON ComentarioCurso FOR EACH ROW
BEGIN
   UPDATE Curso 
   SET noComentarios = noComentarios + 1 
   WHERE Curso.Curso_id = NEW.Curso_id;
   
   UPDATE Curso 
   SET noLikes = noLikes + 1 
   WHERE Curso.Curso_id = NEW.Curso_id AND NEW.isLike = 1;
   
   UPDATE Curso 
   SET noDislikes = noDislikes + 1 
   WHERE Curso.Curso_id = NEW.Curso_id AND NEW.isLike = 0;
END//    
DELIMITER ;

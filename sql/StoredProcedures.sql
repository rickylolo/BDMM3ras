USE BDMM_PROYECTO;



/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionUsuario;
DELIMITER //
CREATE PROCEDURE sp_GestionUsuario
(
	Operacion 			CHAR(1),
	sp_Usuario_id 		INT,
	sp_correo 			VARCHAR(40),
	sp_userPassword 	VARCHAR(30),
	sp_rolUsuario 		TINYINT,
	sp_fotoPerfil 		MEDIUMBLOB,
	sp_descripcion 		TEXT, 
	sp_nombre 			VARCHAR(50),
	sp_apellidoPaterno  VARCHAR(30),
	sp_apellidoMaterno  VARCHAR(30),
	sp_fechaNacimiento 	VARCHAR(30),
	sp_sexo 			VARCHAR(10),
	sp_esBloqueado 		BIT
)

BEGIN
	DECLARE sp_ultimoCambio DATETIME; 
   IF Operacion = 'I' /*INSERT USUARIO*/
   THEN  
		INSERT INTO Usuario(correo ,userPassword ,rolUsuario ,fotoPerfil ,nombre ,apellidoMaterno ,apellidoPaterno ,fechaNacimiento ,sexo,fechaRegistro, ultimoCambio) 
			VALUES (sp_correo,sp_userPassword,sp_rolUsuario,sp_fotoPerfil,sp_nombre ,sp_apellidoMaterno,sp_apellidoPaterno,sp_fechaNacimiento,sp_sexo,now(), now());
   END IF;
	IF Operacion = 'E'  /*EDIT USUARIO*/
    
    THEN 
		SET sp_ultimoCambio = now();
    	SET sp_correo=IF(sp_correo='',NULL,sp_correo),
			sp_userPassword=IF(sp_userPassword='',NULL,sp_userPassword),
			sp_rolUsuario=IF(sp_rolUsuario='',NULL,sp_rolUsuario),
            sp_fotoPerfil=IF(sp_fotoPerfil='',NULL,sp_fotoPerfil),
			sp_nombre=IF(sp_nombre='',NULL,sp_nombre),
            sp_sexo=IF(sp_sexo='',NULL,sp_sexo),
            sp_descripcion=IF(sp_descripcion='',NULL,sp_descripcion),
			sp_apellidoMaterno=IF(sp_apellidoMaterno='',NULL,sp_apellidoMaterno),
            sp_apellidoPaterno=IF(sp_apellidoPaterno='',NULL,sp_apellidoPaterno),
            sp_fechaNacimiento=IF(sp_fechaNacimiento='',NULL,sp_fechaNacimiento);
		UPDATE Usuario 
			SET correo = IFNULL(sp_correo,correo), 
				userPassword= IFNULL(sp_userPassword,userPassword), 
				descripcion=  IFNULL(sp_descripcion,descripcion), 
				rolUsuario= IFNULL(sp_rolUsuario,rolUsuario), 
				fotoPerfil= IFNULL(sp_fotoPerfil,fotoPerfil), 
				nombre= IFNULL(sp_nombre,nombre), 
				apellidoMaterno= IFNULL(sp_apellidoMaterno,apellidoMaterno),
				apellidoPaterno= IFNULL(sp_apellidoPaterno,apellidoPaterno),
				fechaNacimiento= IFNULL(sp_fechaNacimiento,fechaNacimiento),
                sexo= IFNULL(sp_sexo,sexo), 
				ultimoCambio= IFNULL(sp_ultimoCambio,ultimoCambio)
     
		WHERE Usuario_id=sp_Usuario_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE USUARIO*/
          DELETE FROM Usuario WHERE  Usuario_id = sp_Usuario_id;
   END IF;
      IF Operacion = 'P' THEN /*BLOQUEAR/DESBLOQUEAR USUARIO*/
          UPDATE Usuario SET esBloqueado = sp_esBloqueado WHERE Usuario_id = sp_Usuario_id;
   END IF;
    IF Operacion = 'L' THEN /*LOG IN USUARIO*/
		SELECT Usuario_id, rolUsuario
        FROM vUsuario
        WHERE 1=1 
			AND correo = sp_correo
            AND userPassword = sp_userPassword
            AND esBloqueado = 0;
   END IF;
      IF Operacion = 'B' THEN /*GET DATOS ALL USUARIOS BLOQUEADOS*/
		SELECT Usuario_id, correo, rolUsuario, fotoPerfil, descripcion, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, sexo, ultimoCambio
        FROM vUsuario
        WHERE esBloqueado = 1;
   END IF;
     IF Operacion = 'G' THEN /*GET DATOS USUARIO*/
		SELECT Usuario_id, correo, rolUsuario, fotoPerfil, descripcion, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, sexo
        FROM vUsuario
        WHERE Usuario_id = sp_Usuario_id;
   END IF;
        IF Operacion = 'X' THEN /*GET DATOS INSTRUCTOR*/
		SELECT Usuario_id,correo, fotoPerfil, descripcion, CONCAT(nombre,' ',apellidoMaterno,' ',apellidoPaterno) nombre
        FROM vUsuario
        WHERE Usuario_id = sp_Usuario_id AND rolUsuario = 2;
   END IF;
END //


/*--------------------------------------------------------------------------------METODOS DE PAGO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionMetodoPago;
DELIMITER //
CREATE PROCEDURE sp_GestionMetodoPago
(
	Operacion CHAR(1),
	sp_MetodoPago_id 		INT, 
	sp_nombreMetodo  		VARCHAR(30),		
	sp_imagenMetodo 		MEDIUMBLOB
)		

BEGIN
   IF Operacion = 'I' /*INSERT METODO PAGO*/
   THEN  
		INSERT INTO MetodoPago(nombreMetodo,imagenMetodo) 
			VALUES (sp_nombreMetodo,sp_imagenMetodo);
   END IF;
	IF Operacion = 'E'  /*EDIT METODO PAGO*/
    THEN 

    	SET sp_nombreMetodo=IF(sp_nombreMetodo='',NULL,sp_nombreMetodo),
			sp_imagenMetodo=IF(sp_imagenMetodo='',NULL,sp_imagenMetodo);
		UPDATE MetodoPago 
			SET nombreMetodo = IFNULL(sp_nombreMetodo,nombreMetodo), 
				imagenMetodo= IFNULL(sp_imagenMetodo,imagenMetodo)
     
		WHERE MetodoPago_id = sp_MetodoPago_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE METODO PAGO*/
          DELETE FROM MetodoPago WHERE  MetodoPago_id = sp_MetodoPago_id;
   END IF;
      IF Operacion = 'A' THEN /*GET ALL METODOS PAGO*/
		SELECT MetodoPago_id, nombreMetodo, imagenMetodo
        FROM vMetodoPago;
   END IF;
     IF Operacion = 'G' THEN /*GET METODO PAGO*/
		SELECT MetodoPago_id, nombreMetodo, imagenMetodo
        FROM vMetodoPago
        WHERE MetodoPago_id = sp_MetodoPago_id;
   END IF;
END //


/*--------------------------------------------------------------------------------CURSO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionCurso;
DELIMITER //
CREATE PROCEDURE sp_GestionCurso
(
	Operacion CHAR(1),
	sp_Curso_id 			INT, 
	sp_Usuario_id 			INT,			    			    
	sp_costoCurso  			DECIMAL(9,2),					    					    					    
	sp_imagenCurso			MEDIUMBLOB,
	sp_nombre 				VARCHAR(50), 			    
	sp_descripcion 			TEXT,		    
	sp_isBaja 				BIT			    
)		

BEGIN
	DECLARE u_costoCurso DECIMAL(9,2);
   IF Operacion = 'I' /*INSERT CURSO*/
   THEN  
		INSERT INTO Curso(Usuario_id,costoCurso,imagenCurso,nombre,descripcion) 
			VALUES (sp_Usuario_id,sp_costoCurso,sp_imagenCurso,sp_nombre,sp_descripcion);
           SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
        FROM vCurso WHERE Curso_id = last_insert_id();
   END IF;
	IF Operacion = 'E'  /*EDIT CURSO*/
    THEN 
    	SET u_costoCurso = CONVERT(sp_costoCurso,DECIMAL(9,2));
    	SET sp_imagenCurso=IF(sp_imagenCurso='',NULL,sp_imagenCurso),
            sp_nombre=IF(sp_nombre='',NULL,sp_nombre),
            sp_descripcion=IF(sp_descripcion='',NULL,sp_descripcion);
		UPDATE Curso 
			SET costoCurso = IFNULL(u_costoCurso,costoCurso), 
				imagenCurso= IFNULL(sp_imagenCurso,imagenCurso),
				nombre= IFNULL(sp_nombre,nombre),
                descripcion= IFNULL(sp_descripcion,descripcion)
                
		WHERE Curso_id = sp_Curso_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE CURSO*/
          DELETE FROM Curso WHERE  Curso_id = sp_Curso_id;
   END IF;
       IF Operacion = 'B' THEN /*DAR DE BAJA CURSO*/
          UPDATE Curso SET isBaja = 1 WHERE Curso_id = sp_Curso_id;
   END IF;
       IF Operacion = 'T' THEN /*APROBAR CURSO*/
          UPDATE Curso SET isBorrador  = 0 WHERE Curso_id = sp_Curso_id;
   END IF;
      IF Operacion = 'A' THEN /*GET ALL CURSO*/
		SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
        FROM vCurso;
   END IF;
     IF Operacion = 'G' THEN /*GET CURSO*/
	SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, cursoNombre, descripcion, isBaja, categoriaNombre
        FROM vCursoInstructor
        WHERE  Curso_id = sp_Curso_id;
   END IF;
	IF Operacion = 'R' THEN /*GET REPORTE INSTRUCTOR BORRADORES*/
		SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, cursoNombre, descripcion, isBaja, CursoCategoria_id, categoriaNombre, Ingresos, Promedio, noAlumnos
        FROM vCursoInstructor
        WHERE Usuario_id = sp_Usuario_id AND isBorrador = 1 AND isBaja <> 1;
   END IF;
   	IF Operacion = 'U' THEN /*GET REPORTE INSTRUCTOR APROBADOS*/
		SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, cursoNombre, descripcion, isBaja, CursoCategoria_id, categoriaNombre, Ingresos, Promedio, noAlumnos
        FROM vCursoInstructor
        WHERE Usuario_id = sp_Usuario_id AND isBorrador = 0 AND isBaja <> 1;
   END IF;
        IF Operacion = 'X' THEN /*GET CURSO MEJOR CALIFICADO */
		SELECT nombreCompleto, Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
		FROM vCursosMejorCalificado
		WHERE isBaja <> 1;
   END IF;
        IF Operacion = 'Y' THEN /*GET CURSOS MAS VENDIDOS*/
		SELECT nombreCompleto, Curso_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja, misCursosVendidos
        FROM vCursosMasVendido
		WHERE isBaja <> 1;
   END IF;
        IF Operacion = 'Z' THEN /*GET CURSOS MAS RECIENTES*/
		SELECT CONCAT(B.nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto, Curso_id, A.Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, A.nombre, A.descripcion, isBaja
        FROM vCurso A
        LEFT JOIN Usuario B
		ON A.Usuario_id= B.Usuario_id 
        WHERE isBaja <> 1;
   END IF;
	IF Operacion = 'S' THEN /*GET CURSOS SEARCH*/
		SELECT CONCAT(B.nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto, Curso_id, A.Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, A.nombre, A.descripcion, isBaja
        FROM vCurso A
        LEFT JOIN Usuario B
		ON A.Usuario_id= B.Usuario_id 
        WHERE isBaja <> 1 AND  (sp_nombre IS NULL OR A.nombre LIKE CONCAT("%",sp_nombre,"%"));
   END IF;
		IF Operacion = 'K' THEN /*GET KARDEX*/
		SELECT Usuario_id, Curso_id, isFinalizado, imagenCurso, nombreCurso, Progreso, DATE(ultimoNivel) ultimoNivel, nombreCategoria, DATE(tiempoCompletado) tiempoCompletado,DATE(tiempoRegistro) tiempoRegistro
        FROM vKardex
        WHERE Usuario_id = sp_Usuario_id;
   END IF;
END //

/*--------------------------------------------------------------------------------CATEGORIA--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionCategoria;
DELIMITER //
CREATE PROCEDURE sp_GestionCategoria
(
	Operacion CHAR(1),
	sp_Categoria_id 		INT,
	sp_Usuario_id 			INT, 				
	sp_nombre 				VARCHAR(30),	
	sp_descripcion  		TINYTEXT	
)		

BEGIN
   IF Operacion = 'I' /*INSERT CATEGORIA*/
   THEN  
		INSERT INTO Categoria(Usuario_id,nombre,descripcion,tiempoRegistro) 
			VALUES (sp_Usuario_id,sp_nombre,sp_descripcion,now());
   END IF;
	IF Operacion = 'E'  /*EDIT CATEGORIA*/
    THEN 
    	SET sp_nombre=IF(sp_nombre='',NULL,sp_nombre),
            sp_descripcion=IF(sp_descripcion='',NULL,sp_descripcion);
		UPDATE Categoria 
			SET nombre = IFNULL(sp_nombre,nombre), 
				descripcion= IFNULL(sp_descripcion,descripcion)
                
		WHERE Categoria_id = sp_Categoria_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE CATEGORIA*/
          DELETE FROM Categoria WHERE Categoria_id = sp_Categoria_id;
   END IF;
      IF Operacion = 'A' THEN /*GET ALL CATEGORIA*/
		SELECT Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro, noCursos
        FROM vCategoria;
   END IF;
     IF Operacion = 'G' THEN /*GET CURSO*/
		SELECT Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro, noCursos
        FROM vCategoria
		WHERE Categoria_id = sp_Categoria_id;
   END IF;
END //



/*--------------------------------------------------------------------------------COMENTARIO CURSO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionComentario;
DELIMITER //
CREATE PROCEDURE sp_GestionComentario
(
	Operacion CHAR(1),
	sp_ComentarioCurso_id 	INT, 
    sp_Usuario_id 			INT,			
    sp_Curso_id 			INT,				
    sp_isLike 				BIT,			
    sp_texto  				TEXT		
)		

BEGIN
   IF Operacion = 'I' /*INSERT COMENTARIO CURSO*/
   THEN  
		INSERT INTO ComentarioCurso(Usuario_id,Curso_id,isLike,texto,tiempoRegistro) 
			VALUES (sp_Usuario_id,sp_Curso_id,sp_isLike,sp_texto,now());
   END IF;
	IF Operacion = 'E'  /*EDIT COMENTARIO CURSO*/
    THEN 
    	SET sp_isLike=IF(sp_isLike='',NULL,sp_isLike),
			sp_texto=IF(sp_texto='',NULL,sp_texto);
		UPDATE ComentarioCurso 
			SET isLike = IFNULL(sp_isLike,isLike), 
				texto= IFNULL(sp_texto,texto)
                
		WHERE ComentarioCurso_id = sp_ComentarioCurso_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE COMENTARIO CURSO*/
          DELETE FROM ComentarioCurso WHERE ComentarioCurso_id = sp_ComentarioCurso_id;
   END IF;
      IF Operacion = 'A' THEN /*GET ALL COMENTARIO CURSO*/
		SELECT ComentarioCurso_id, Usuario_id, Curso_id, isLike, texto, tiempoRegistro
        FROM vComentarioCurso;
   END IF;
     IF Operacion = 'G' THEN /*GET COMENTARIO CURSO*/
	    SELECT ComentarioCurso_id, Usuario_id, Curso_id, isLike, texto, tiempoRegistro
        FROM vComentarioCurso
		WHERE ComentarioCurso_id = sp_ComentarioCurso_id;
   END IF;
END //


/*--------------------------------------------------------------------------------MENSAJE--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionMensaje;
DELIMITER //
CREATE PROCEDURE sp_GestionMensaje
(
	Operacion CHAR(1),
	sp_Mensaje_id 			 INT,
    sp_UsuarioInstructor_id  INT,			
    sp_UsuarioAlumno_id 	 INT,			
    sp_Curso_id 			 INT
)		

BEGIN
  DECLARE isExistenteMensaje INT;
   IF Operacion = 'I' /*INSERT MENSAJE*/
   THEN  
   
		SELECT COUNT(*) INTO isExistenteMensaje FROM Mensaje
		WHERE UsuarioInstructor_id = sp_UsuarioInstructor_id
		AND UsuarioAlumno_id = sp_UsuarioAlumno_id
		AND Curso_id = sp_Curso_id;
		IF isExistenteMensaje = 0 THEN
			
			INSERT INTO Mensaje(UsuarioInstructor_id,UsuarioAlumno_id,Curso_id, UltimoMensaje) 
			VALUES (sp_UsuarioInstructor_id,sp_UsuarioAlumno_id,sp_Curso_id, now());
        END IF;
		
   END IF;
   IF Operacion = 'D' THEN /*DELETE MENSAJE*/
          DELETE FROM Mensaje WHERE Mensaje_id = sp_Mensaje_id;
   END IF;
   IF Operacion = 'X' THEN /*GET ALL MENSAJE HEADER INSTRUCTOR*/
          SELECT Mensaje_id, Curso_id, UsuarioInstructor_id, UsuarioAlumno_id, imagenCurso, nombre, correo, nombreUsuario FROM vMensaje
          WHERE UsuarioInstructor_id = sp_UsuarioInstructor_id
          ORDER BY UltimoMensaje DESC;
   END IF;
	IF Operacion = 'Z' THEN /*GET ALL MENSAJE HEADER ALUMNO*/
          SELECT Mensaje_id, Curso_id, UsuarioInstructor_id, UsuarioAlumno_id, imagenCurso, nombre, correo, nombreUsuario FROM vMensaje
          WHERE UsuarioAlumno_id = sp_UsuarioAlumno_id
           ORDER BY UltimoMensaje DESC;
   END IF;
END //



/*--------------------------------------------------------------------------------MENSAJE DETALLE--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionMensajeDetalle;
DELIMITER //
CREATE PROCEDURE sp_GestionMensajeDetalle
(
	Operacion CHAR(1),
	sp_MensajeDetalle_id 	 INT,		
    sp_Mensaje_id 			 INT,	
	sp_Usuario_id            INT,	
    sp_texto  				 TINYTEXT
)		

BEGIN
   IF Operacion = 'I' /*INSERT MENSAJE DETALLE*/
   THEN  
		INSERT INTO MensajeDetalle(Mensaje_id,texto,Usuario_id,tiempoRegistro) 
			VALUES (sp_Mensaje_id,sp_texto,sp_Usuario_id,now());
		UPDATE Mensaje 
        SET UltimoMensaje = now() 
        WHERE Mensaje_id = sp_Mensaje_id;
   END IF;
   IF Operacion = 'G' THEN /*GET ALL MENSAJES*/
          SELECT MensajeDetalle_id,Curso_id, Usuario_id, Mensaje_id, texto, tiempoRegistro, fotoPerfil, nombreUsuario
          FROM vMensajeDetalle
          WHERE Mensaje_id = sp_Mensaje_id;
   END IF;
END //



/*--------------------------------------------------------------------------------CURSO CATEGORIA--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionCursoCategoria;
DELIMITER //
CREATE PROCEDURE sp_GestionCursoCategoria
(
	Operacion CHAR(1),
	sp_CursoCategoria_id 	INT,
    sp_Curso_id 			INT,				
    sp_Categoria_id 		INT 			
)		

BEGIN
   IF Operacion = 'I' /*INSERT CURSO CATEGORIA*/
   THEN  
		INSERT INTO CursoCategoria(Curso_id,Categoria_id) 
			VALUES (sp_Curso_id,sp_Categoria_id);
   END IF;
    IF Operacion = 'D' THEN /*DELETE CURSO CATEGORIA*/
          DELETE FROM CursoCategoria WHERE CursoCategoria_id = sp_CursoCategoria_id;
   END IF;
      IF Operacion = 'A' THEN /*GET ALL  CATEGORIAS CURSO*/
		SELECT CursoCategoria_id, Curso_id, Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro
        FROM vObtenerTodasCategoriaDeCurso
		WHERE Curso_id = sp_Curso_id;
   END IF;
     IF Operacion = 'C' THEN /*GET ALL  CURSOS DE UNA CATEGORIA*/
	    SELECT nombreCompleto, Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
        FROM vObtenerTodosLosCursosDeUnaCategoria
		WHERE Categoria_id = sp_Categoria_id AND isBaja <> 1;
   END IF;
END //



/*--------------------------------------------------------------------------------NIVEL--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionNivel;
DELIMITER //
CREATE PROCEDURE sp_GestionNivel
(
	Operacion CHAR(1),
	sp_Nivel_id 			INT,
    sp_Curso_id 			INT,				       			
    sp_nombre  				VARCHAR(50),		
    sp_costoNivel  			DECIMAL(9,2)
)

BEGIN
	DECLARE u_costoNivel DECIMAL(9,2);
    DECLARE u_MisNiveles INT;
	DECLARE u_MiCurso INT;
   IF Operacion = 'I' /*INSERT NIVEL*/
   THEN  
		SET u_MisNiveles = contarNiveles(sp_Curso_id) + 1;
		INSERT INTO Nivel(Curso_id,noNivel,nombre,costoNivel) 
			VALUES (sp_Curso_id,u_MisNiveles,sp_nombre,sp_costoNivel);
		SELECT Nivel_id,Curso_id
        FROM vNivel WHERE Nivel_id = last_insert_id();
	
   END IF;
   	IF Operacion = 'E'  /*EDIT NIVEL*/
    THEN 
		SET u_costoNivel = CONVERT(sp_costoNivel,DECIMAL(9,2));
    	SET sp_nombre=IF(sp_nombre='',NULL,sp_nombre);
		UPDATE Nivel 
			SET nombre = IFNULL(sp_nombre,nombre), 
                costoNivel = IFNULL(u_costoNivel,costoNivel)
                
		WHERE Nivel_id = sp_Nivel_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE NIVEL*/
          SELECT noNivel INTO u_MisNiveles FROM Nivel WHERE Nivel_id = sp_Nivel_id;
          SELECT Curso_id INTO u_MiCurso FROM Nivel WHERE Nivel_id = sp_Nivel_id;
		  UPDATE Nivel SET noNivel = noNivel - 1 WHERE noNivel > u_MisNiveles AND Curso_id = u_MiCurso;
          DELETE FROM Nivel WHERE Nivel_id = sp_Nivel_id;
   END IF;
    IF Operacion = 'A' THEN /*GET ALL NIVELES DEL CURSO*/
		SELECT Nivel_id, Curso_id, noNivel, nombre AS nombreNivel, costoNivel, (SELECT COUNT(*) FROM nivelCurso A 
        WHERE A.Nivel_id = B.Nivel_id AND A.Usuario_id = sp_Nivel_id) AS isComprado
        FROM vObtenerTodosLosNivelesDeUnCurso B
        WHERE Curso_id = sp_Curso_id;
   END IF;
       IF Operacion = 'G' THEN /*GET DATA NIVEL*/
		SELECT Nivel_id, Curso_id, noNivel, nombre, costoNivel
        FROM vNivel
        WHERE Nivel_id = sp_Nivel_id;
   END IF;
   
END //

/*--------------------------------------------------------------------------------MULTIMEDIA--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionMultimedia;
DELIMITER //
CREATE PROCEDURE sp_GestionMultimedia
(
	Operacion CHAR(1),
	sp_Multimedia_id 		INT,
    sp_Nivel_id 			INT,				
    sp_multimedia  			LONGBLOB, 					
    sp_texto 				TEXT, 						
    sp_tipoMultimedia 		TINYINT			
)		

BEGIN
   IF Operacion = 'I' /*INSERT MULTIMEDIA*/
   THEN  
		INSERT INTO Multimedia(Nivel_id,multimedia,texto,tipoMultimedia) 
			VALUES (sp_Nivel_id,sp_multimedia,sp_texto,sp_tipoMultimedia);
   END IF;
	IF Operacion = 'E' /*ACTUALIZAR MULTIMEDIA*/
   THEN  
		SET sp_multimedia=IF(sp_multimedia='',NULL,sp_multimedia),
            sp_texto=IF(sp_texto='',NULL,sp_texto),
            sp_tipoMultimedia=IF(sp_tipoMultimedia='',NULL,sp_tipoMultimedia);
		UPDATE Multimedia 
			SET multimedia = IFNULL(sp_multimedia,multimedia), 
                texto = IFNULL(sp_texto,texto),
                tipoMultimedia = IFNULL(sp_tipoMultimedia,tipoMultimedia)
		WHERE Multimedia_id = sp_Multimedia_id;
        SELECT Nivel_id FROM Multimedia WHERE Multimedia_id = sp_Multimedia_id;
        
   END IF;
    IF Operacion = 'D' THEN /*DELETE MULTIMEDIA*/
		  SELECT Nivel_id FROM Multimedia WHERE Multimedia_id = sp_Multimedia_id;
          DELETE FROM Multimedia WHERE Multimedia_id = sp_Multimedia_id;
        
   END IF;
   
      IF Operacion = 'A' THEN /*GET ALL MULTIMEDIA DEL NIVEL*/
		SELECT Multimedia_id, multimedia, texto, tipoMultimedia
        FROM vObtenerTodaMultimediaDeUnNivel
        WHERE Nivel_id = sp_Nivel_id;
   END IF;
   
	  IF Operacion = 'G' THEN /*GET DATA MULTIMEDIA*/
		SELECT Multimedia_id, Nivel_id, multimedia, texto, tipoMultimedia
        FROM vMultimedia
        WHERE Multimedia_id = sp_Multimedia_id;
   END IF;
END //

SET GLOBAL max_allowed_packet=1073741824;



/*--------------------------------------------------------------------------------USUARIO CURSO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionUsuarioCurso;
DELIMITER //
CREATE PROCEDURE sp_GestionUsuarioCurso
(
	Operacion CHAR(1),
	sp_usuarioCurso_id 			INT,
    sp_MetodoPago_id 			INT,				
    sp_Curso_id 				INT, 					
    sp_Usuario_id 				INT
)		

BEGIN
  DECLARE isExistenteUsuarioCurso INT;
  DECLARE cantidadNivelesComprados INT;
   IF Operacion = 'I' /*INSERT USUARIO CURSO*/
   THEN  
   
		SELECT COUNT(usuarioCurso_id) INTO isExistenteUsuarioCurso FROM usuarioCurso
        WHERE Curso_id = sp_Curso_id
		AND Usuario_id = sp_Usuario_id;
        	IF isExistenteUsuarioCurso = 0 THEN
		INSERT INTO usuarioCurso(MetodoPago_id,Curso_id,Usuario_id,tiempoRegistro,costoCurso) 
			VALUES (sp_MetodoPago_id,sp_Curso_id, sp_Usuario_id,now(),obtenerCostoCurso(sp_Curso_id));
            ELSE
				
			INSERT INTO nivelCurso (MetodoPago_id, usuarioCurso_id, Usuario_id, Nivel_id, tiempoRegistro, costoNivel)
			SELECT sp_MetodoPago_id, B.usuarioCurso_id, sp_Usuario_id, A.Nivel_id, NOW(), A.costoNivel
			FROM nivel A
			CROSS JOIN usuarioCurso B
			WHERE A.curso_id = sp_Curso_id
				AND B.Curso_id = sp_Curso_id
				AND B.Usuario_id = sp_Usuario_id
			AND NOT EXISTS (
				SELECT 1
				FROM nivelCurso A2
				WHERE A2.Usuario_id = sp_Usuario_id
				AND A2.Nivel_id = A.Nivel_id
				);
            END IF;
   END IF;
   IF Operacion = 'G' /*GET USUARIO CURSOS*/
   THEN  
		SELECT Usuario_id, nombreCompleto, usuarioCurso_id, Curso_id, isFinalizado, nivelesCompletados, tiempoCompletado, costoCurso, noNiveles, imagenCurso, nombre, descripcion
        FROM vObtenerTodosLosCursosDeUnUsuario
        WHERE Usuario_id = sp_Usuario_id;
   END IF;
END //

/*--------------------------------------------------------------------------------NIVEL CURSO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionNivelCurso;
DELIMITER //
CREATE PROCEDURE sp_GestionNivelCurso
(
	Operacion CHAR(1),
	sp_nivelCurso_id 			INT,
	sp_MetodoPago_id 			INT,
    sp_Usuario_id				INT,
    sp_Nivel_id 				INT
)		

BEGIN
	DECLARE isExistenteUsuarioNivel INT;
    DECLARE isExistenteUsuarioCurso INT;
    DECLARE idCurso_Nivel_id INT;
    DECLARE idUsuarioCurso INT;
   IF Operacion = 'I' /*INSERT USUARIO NIVEL*/
   THEN  
		SELECT A.Curso_id INTO idCurso_Nivel_id
				FROM Curso A
				JOIN Nivel B ON A.curso_id = B.Curso_id
                WHERE Nivel_id = sp_Nivel_id;
		SELECT COUNT(nivelCurso_id) INTO isExistenteUsuarioNivel FROM nivelCurso
        WHERE Nivel_id = sp_Nivel_id
		AND Usuario_id = sp_Usuario_id;
		SELECT COUNT(usuarioCurso_id) INTO isExistenteUsuarioCurso FROM usuarioCurso
         WHERE Curso_id = idCurso_Nivel_id
		AND Usuario_id = sp_Usuario_id;
        IF isExistenteUsuarioNivel = 0 THEN
			IF isExistenteUsuarioCurso = 0 THEN
            	INSERT INTO usuarioCurso(MetodoPago_id,Curso_id,Usuario_id,tiempoRegistro,costoCurso) 
					VALUES (sp_MetodoPago_id,idCurso_Nivel_id,sp_Usuario_id,NOW(),0);
                    
				INSERT INTO nivelCurso(MetodoPago_id, usuarioCurso_id,Usuario_id, Nivel_id, tiempoRegistro, costoNivel) 
					VALUES (sp_MetodoPago_id, LAST_INSERT_ID(),sp_Usuario_id, sp_Nivel_id, NOW(), obtenerCostoNivel(sp_Nivel_id));
			ELSEIF isExistenteUsuarioCurso >= 1 THEN
				SELECT A.usuarioCurso_id INTO idUsuarioCurso
				FROM usuarioCurso A
				JOIN Curso B ON A.Curso_id = B.Curso_id
                WHERE A.Curso_id = idCurso_Nivel_id 
                AND A.Usuario_id = sp_Usuario_id;
				INSERT INTO nivelCurso(MetodoPago_id, usuarioCurso_id,Usuario_id, Nivel_id, tiempoRegistro, costoNivel) 
					VALUES (sp_MetodoPago_id, idUsuarioCurso,sp_Usuario_id, sp_Nivel_id, NOW(), obtenerCostoNivel(sp_Nivel_id));
			END IF;
		END IF;
   END IF;
   IF Operacion = 'G' /*GET USUARIO NIVELES CURSO*/
   THEN  
		SELECT Usuario_id, nivelCurso_id, MetodoPago_id, usuarioCurso_id, Nivel_id, isFinalizado, costoNivel, noNivel, nombre
        FROM vObtenerTodosLosNivelesDeUnCursoDeUnUsuario
        WHERE usuarioCurso_id = sp_usuarioCurso_id;
   END IF;
      IF Operacion = 'E' /*GET USUARIO NIVELES CURSO*/
   THEN  
		UPDATE nivelCurso SET isFinalizado = 1
        WHERE Nivel_id = sp_Nivel_id AND Usuario_id = sp_Usuario_id AND isFinalizado = 0;
   END IF;
END //

SELECT * FROM UsuarioCurso;
SELECT * FROM nivelCurso;
DELETE FROM nivelCurso;
DELETE FROM UsuarioCurso;

CALL sp_GestionNivelCurso(
'E',             #Operacion
NULL, 		    #usuarioCurso Id
NULL,  #MetodoPago Id
9,      #Usuario Id
12       #Nivel Id
);
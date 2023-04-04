USE BDMM_PROYECTO;



/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionUsuario;
DELIMITER //
CREATE PROCEDURE sp_GestionUsuario
(
	Operacion 			CHAR(1),
	sp_Usuario_id 		INT,
	sp_MetodoPago_id 	INT, 
	sp_correo 			VARCHAR(40),
	sp_userPassword 	VARCHAR(30),
	sp_rolUsuario 		TINYINT,
	sp_fotoPerfil 		MEDIUMBLOB,
	sp_descripcion 		TINYTEXT, 
	sp_nombre 			VARCHAR(30),
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
            sp_descripcion=IF(sp_descripcion='',NULL,sp_descripcion),
			sp_apellidoMaterno=IF(sp_apellidoMaterno='',NULL,sp_apellidoMaterno),
            sp_apellidoPaterno=IF(sp_apellidoPaterno='',NULL,sp_apellidoPaterno),
            sp_fechaNacimiento=IF(sp_fechaNacimiento='',NULL,sp_fechaNacimiento),
            sp_ultimoCambio=IF(sp_ultimoCambio='',NULL,sp_ultimoCambio);
		UPDATE Usuario 
			SET correo = IFNULL(sp_correo,correo), 
				userPassword= IFNULL(sp_userPassword,userPassword), 
				descripcion=  IFNULL(sp_descripcion,descripcion), 
				rolUsuario= IFNULL(sp_rolUsuario,rolUsuario), 
				fotoPerfil= IFNULL(sp_fotoPerfil,fotoPerfil), 
				nombre= IFNULL(sp_nombreUsuario,nombre), 
				apellidoMaterno= IFNULL(sp_apellidoMaterno,apellidoMaterno),
				apellidoPaterno= IFNULL(sp_apellidoPaterno,apellidoPaterno),
				fechaNacimiento= IFNULL(sp_fechaNacimiento,fechaNacimiento),
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
        FROM Usuario
        WHERE 1=1 
			AND correo = sp_correo
            AND userPassword = sp_userPassword;
   END IF;
      IF Operacion = 'A' THEN /*GET DATOS ALL USUARIOS*/
		SELECT Usuario_id, MetodoPago_id, correo, userPassword, rolUsuario, fotoPerfil, descripcion, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, sexo, fechaRegistro, ultimoCambio, esBloqueado
        FROM Usuario;
   END IF;
     IF Operacion = 'G' THEN /*GET DATOS USUARIO*/
		SELECT Usuario_id, MetodoPago_id, correo, userPassword, rolUsuario, fotoPerfil, descripcion, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, sexo, fechaRegistro, ultimoCambio, esBloqueado
        FROM Usuario
        WHERE Usuario_id = sp_Usuario_id;
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
	sp_Curso_id 			INT, 
	sp_Usuario_id 			INT,			    			    
	sp_costoCurso  			DECIMAL(9,2),					    					    					    
	sp_imagenCurso			MEDIUMBLOB,
	sp_nombre 				VARCHAR(50), 			    
	sp_descripcion 			TEXT,		    
	sp_isBaja 				BIT			    
)		

BEGIN
   IF Operacion = 'I' /*INSERT CURSO*/
   THEN  
		INSERT INTO Curso(Usuario_id,costoCurso,imagenCurso,nombre,descripcion) 
			VALUES (sp_Usuario_id,sp_costoCurso,sp_imagenCurso,sp_nombre,sp_descripcion);
   END IF;
	IF Operacion = 'E'  /*EDIT CURSO*/
    THEN 
    	SET sp_costoCurso=IF(sp_costoCurso='',NULL,sp_costoCurso),
			sp_imagenCurso=IF(sp_imagenCurso='',NULL,sp_imagenCurso),
            sp_nombre=IF(sp_nombre='',NULL,sp_nombre),
            sp_descripcion=IF(sp_descripcion='',NULL,sp_descripcion);
		UPDATE Curso 
			SET costoCurso = IFNULL(sp_costoCurso,costoCurso), 
				imagenCurso= IFNULL(sp_imagenCurso,imagenCurso),
				nombre= IFNULL(sp_nombre,nombre),
                descripcion= IFNULL(sp_descripcion,descripcion)
                
		WHERE Curso_id = sp_Curso_id;
   END IF;
    IF Operacion = 'D' THEN /*DELETE CURSO*/
          DELETE FROM Curso WHERE  Curso_id = sp_Curso_id;
   END IF;
      IF Operacion = 'A' THEN /*GET ALL CURSO*/
		SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
        FROM vCurso;
   END IF;
     IF Operacion = 'G' THEN /*GET CURSO*/
	SELECT Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
        FROM vCurso
        WHERE  Curso_id = sp_Curso_id;
   END IF;
END //

/*--------------------------------------------------------------------------------CATEGORIA--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionCategoria;
DELIMITER //
CREATE PROCEDURE sp_GestionCategoria
(
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
		SELECT Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro
        FROM vCategoria;
   END IF;
     IF Operacion = 'G' THEN /*GET CURSO*/
		SELECT Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro
        FROM vCategoria
		WHERE Categoria_id = sp_Categoria_id;
   END IF;
END //



/*--------------------------------------------------------------------------------COMENTARIO CURSO--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionComentarioCurso;
DELIMITER //
CREATE PROCEDURE sp_GestionComentarioCurso
(
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
	Mensaje_id 			 INT,
    UsuarioInstructor_id INT,			
    UsuarioAlumno_id 	 INT,			
    Curso_id 			 INT,		
    texto  				 TEXT,
    tiempoRegistro 		 DATETIME		
)		

BEGIN
   IF Operacion = 'I' /*INSERT MENSAJE*/
   THEN  
		INSERT INTO Mensaje(UsuarioInstructor_id,UsuarioAlumno_id,Curso_id,texto,tiempoRegistro) 
			VALUES (sp_UsuarioInstructor_id,sp_UsuarioAlumno_id,sp_Curso_id,sp_texto,now());
   END IF;
    IF Operacion = 'D' THEN /*DELETE MENSAJE*/
          DELETE FROM ComentarioCurso WHERE ComentarioCurso_id = sp_ComentarioCurso_id;
   END IF;
      IF Operacion = 'I' THEN /*GET ALL MENSAJES INSTRUCTOR*/
		SELECT Mensaje_id, UsuarioInstructor_id, UsuarioAlumno_id, Curso_id, texto, tiempoRegistro
        FROM Mensaje
		WHERE UsuarioInstructor_id = sp_UsuarioInstructor_id;
   END IF;
     IF Operacion = 'E' THEN /*GET ALL MENSAJES ESTUDIANTE*/
	    SELECT Mensaje_id, UsuarioInstructor_id, UsuarioAlumno_id, Curso_id, texto, tiempoRegistro
        FROM Mensaje
		WHERE UsuarioAlumno_id = sp_UsuarioAlumno_id;
   END IF;
END //



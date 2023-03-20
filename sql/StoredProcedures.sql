USE BDMM_PROYECTO;
/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
DROP PROCEDURE IF EXISTS sp_GestionUsuario;
DELIMITER //
CREATE PROCEDURE sp_GestionUsuario
(
Operacion CHAR(1),
sp_Usuario_id INT,
sp_MetodoPago_id INT, 
sp_correo VARCHAR(40),
sp_userPassword VARCHAR(30),
sp_rolUsuario TINYINT,
sp_fotoPerfil MEDIUMBLOB,
sp_descripcion TINYTEXT, 
sp_nombre VARCHAR(30),
sp_apellidoPaterno  VARCHAR(30),
sp_apellidoMaterno  VARCHAR(30),
sp_fechaNacimiento VARCHAR(30),
sp_sexo VARCHAR(10),
sp_esBloqueado BIT
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

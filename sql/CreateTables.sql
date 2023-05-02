DROP DATABASE BDMM_PROYECTO;
CREATE DATABASE BDMM_PROYECTO;



USE BDMM_PROYECTO;

-- 												TABLA DE METODOS DE PAGO --
DROP TABLE IF EXISTS MetodoPago;
CREATE TABLE MetodoPago(
	MetodoPago_id 		INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de los Metodos de pago',
	nombreMetodo  		VARCHAR(30) NOT NULL 			COMMENT'Nombre del metodo de pago',
    imagenMetodo 		MEDIUMBLOB NOT NULL 			COMMENT'Imagen del metodo de pago',
 CONSTRAINT PK_MetodoPago
	PRIMARY KEY (MetodoPago_id)
);

-- 												TABLA DE USUARIOS										 --
DROP TABLE IF EXISTS Usuario;
CREATE TABLE Usuario(
	Usuario_id 			INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria Tabla Usuario',
    MetodoPago_id 		INT								COMMENT'Clave Foránea de los Metodos de pago',
	correo 				VARCHAR(40) NOT NULL UNIQUE 	COMMENT'Correo electrónico del usuario',
	userPassword 		VARCHAR(30) NOT NULL 			COMMENT'Contraseña del usuario',
	rolUsuario 			TINYINT NOT NULL 				COMMENT'No. que identifica el rol del usuario 1:Admin, 2:Instructor, 3:Alumno',
	fotoPerfil			MEDIUMBLOB 						COMMENT'Foto de perfil tipo avatar',
	descripcion 		TINYTEXT        				COMMENT'descripcion del usuario',
	nombre 				VARCHAR(30) NOT NULL 			COMMENT'Nombre completo del usuario',
	apellidoMaterno 	VARCHAR(30) NOT NULL 			COMMENT'Apellido materno del usuario',
	apellidoPaterno 	VARCHAR(30) NOT NULL 			COMMENT'Apellido paterno del usuario',
	fechaNacimiento 	DATE NOT NULL 					COMMENT'Fecha de nacimiento del usuario',
	sexo 				VARCHAR(10) NOT NULL 			COMMENT'Género del usuario',
	fechaRegistro 		DATETIME NOT NULL 				COMMENT'Fecha en la que se dio de alta el usuario',
	ultimoCambio 		DATETIME NOT NULL 				COMMENT'Fecha ultima de modificacion del usuario',
	esBloqueado 		BIT DEFAULT 0 					COMMENT'Bandera que indica si esta bloqueado',
 CONSTRAINT PK_Usuario
	PRIMARY KEY (Usuario_id),
 CONSTRAINT FK_Usuario_MetodoPago
	FOREIGN KEY (MetodoPago_id) REFERENCES MetodoPago(MetodoPago_id)
);






-- 												TABLA DE CURSO --
DROP TABLE IF EXISTS Curso;
CREATE TABLE Curso(
	Curso_id 			INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de los cursos',
    Usuario_id 			INT NOT NULL 					COMMENT'Clave Foránea del usuario que registro el curso',
    noNiveles 			INT NOT NULL DEFAULT 0			COMMENT'número de niveles del curso',
	costoCurso  		DECIMAL(9,2) UNSIGNED NOT NULL 	COMMENT'Costo del curso',
    noComentarios 		INT NOT NULL DEFAULT 0			COMMENT'numero de comentarios del curso',
    noLikes 			INT NOT NULL DEFAULT 0			COMMENT'numero de reseñas buenas del curso',
    noDislikes 			INT NOT NULL DEFAULT 0			COMMENT'numero de reseñas malas del curso',
    imagenCurso			MEDIUMBLOB NOT NULL 			COMMENT'Imagen del curso',
	nombre 				VARCHAR(50) NOT NULL 			COMMENT'Nombre del curso',
	descripcion 		TEXT NOT NULL 					COMMENT'Nombre de usuario',
    isBaja 				BIT DEFAULT 0 					COMMENT'Bandera que indica si esta bloqueado',
 CONSTRAINT PK_Curso
	PRIMARY KEY (Curso_id),
CONSTRAINT FK_Curso_Usuario
	FOREIGN KEY (Usuario_id) REFERENCES Usuario(Usuario_id)
);


-- 												TABLA DE CATEGORIA --
DROP TABLE IF EXISTS Categoria;
CREATE TABLE Categoria(
	Categoria_id 		INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de las categorias',
    Usuario_id 			INT NOT NULL 					COMMENT'Clave Foránea del usuario que registro la categoria',
    nombre 				VARCHAR(30) NOT NULL 			COMMENT'Nombre de la categoria',
	descripcion  		TINYTEXT NOT NULL 				COMMENT'Descripcion de la categoria',
    tiempoRegistro 		DATETIME NOT NULL 				COMMENT'Tiempo de registro de la categoria',
 CONSTRAINT PK_Categoria
	PRIMARY KEY (Categoria_id),
 CONSTRAINT FK_Categoria_Usuario
	FOREIGN KEY (Usuario_id) REFERENCES Usuario(Usuario_id)
);



-- 												TABLA DE COMENTARIO CURSO (LIKE Y DISLIKE)--
DROP TABLE IF EXISTS ComentarioCurso;
CREATE TABLE ComentarioCurso(
	ComentarioCurso_id 	INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de los comentarios del curso(reseñas)',
    Usuario_id 			INT NOT NULL 					COMMENT'Clave Foránea del usuario que registro el comentario del curso',
    Curso_id 			INT NOT NULL 					COMMENT'Clave Foránea del curso que registro el comentario del curso',
	isLike 				BIT NOT NULL 					COMMENT'Bandera que indica si es una reseña positiva o negativa',
    texto  				TEXT NOT NULL 					COMMENT'Texto sobre la reseña del curso',
    tiempoRegistro 		DATETIME NOT NULL 				COMMENT'Tiempo de registro de la reseña',
 CONSTRAINT PK_ComentarioCurso
	PRIMARY KEY (ComentarioCurso_id),
 CONSTRAINT FK_ComentarioCurso_Usuario
	FOREIGN KEY (Usuario_id) REFERENCES Usuario(Usuario_id),
 CONSTRAINT FK_ComentarioCurso_Curso
	FOREIGN KEY (Curso_id) REFERENCES Curso(Curso_id)
);


-- 													TABLA DE MENSAJES--
DROP TABLE IF EXISTS Mensaje;
CREATE TABLE Mensaje(
	Mensaje_id 			 INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de los mensajes',
    UsuarioInstructor_id INT NOT NULL 					COMMENT'Clave Foránea del usuario instructor del mensaje',
    UsuarioAlumno_id 	 INT NOT NULL 					COMMENT'Clave Foránea del usuario alumno del mensaje',
	Curso_id 			 INT NOT NULL 					COMMENT'Clave Foránea del curso del mensaje',
    texto  				 TEXT NOT NULL 					COMMENT'Texto sobre la reseña del curso',
    tiempoRegistro 		 DATETIME NOT NULL 				COMMENT'Tiempo de registro del mensaje',
 CONSTRAINT PK_Mensaje
	PRIMARY KEY (Mensaje_id),
 CONSTRAINT FK_Mensaje_UsuarioInstructor
	FOREIGN KEY (UsuarioInstructor_id) REFERENCES Usuario(Usuario_id),
 CONSTRAINT FK_Mensaje_UsuarioAlumno
	FOREIGN KEY (UsuarioAlumno_id) REFERENCES Usuario(Usuario_id),
CONSTRAINT FK_Mensaje_Curso
	FOREIGN KEY (Curso_id) REFERENCES Curso(Curso_id)
);



-- 												TABLA DE CURSO CATEGORIA--
DROP TABLE IF EXISTS CursoCategoria;
CREATE TABLE CursoCategoria(
	CursoCategoria_id 	INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de las categorias de los cursos',
    Curso_id 			INT NOT NULL 					COMMENT'Clave Foránea del curso',
    Categoria_id 		INT NOT NULL 					COMMENT'Clave Foránea de la categoria',
 CONSTRAINT PK_CursoCategoria
	PRIMARY KEY (CursoCategoria_id),
 CONSTRAINT FK_CursoCategoria_Categoria
	FOREIGN KEY (Categoria_id) REFERENCES Categoria(Categoria_id),
 CONSTRAINT FK_CursoCategoria_Curso
	FOREIGN KEY (Curso_id) REFERENCES Curso(Curso_id)
);


-- 												TABLA DE NIVEL--
DROP TABLE IF EXISTS Nivel;
CREATE TABLE Nivel(
	Nivel_id 			INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de los niveles',
    Curso_id 			INT NOT NULL 					COMMENT'Clave Foránea del curso',
    noNivel             INT NOT NULL           			COMMENT'Numero del nivel',
    nombre  			VARCHAR(50) NOT NULL 			COMMENT'Nombre del nivel',
    costoNivel  		DECIMAL(9,2) UNSIGNED NOT NULL 	COMMENT'Costo del nivel',
 CONSTRAINT PK_Nivel
	PRIMARY KEY (Nivel_id),
 CONSTRAINT FK_Nivel_Curso
	FOREIGN KEY (Curso_id) REFERENCES Curso(Curso_id)
);


-- 												TABLA DE MULTIMEDIA--
DROP TABLE IF EXISTS Multimedia;
CREATE TABLE Multimedia(
	Multimedia_id 		INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de la multimedia',
    Nivel_id 			INT NOT NULL 					COMMENT'Clave Foránea del nivel',
    multimedia  		LONGBLOB 						COMMENT'Multimedia',
    texto 				TEXT 							COMMENT'Texto',
    tipoMultimedia 		TINYINT NOT NULL 				COMMENT'No. que identifica el tipo de multimedia del nivel 1:imagen, 2:video, 3:PDF',
 CONSTRAINT PK_Multimedia
	PRIMARY KEY (Multimedia_id),
 CONSTRAINT FK_Multimedia_Nivel
	FOREIGN KEY (Nivel_id) REFERENCES Nivel(Nivel_id)
);



-- 												TABLA DE usuarioCurso--
DROP TABLE IF EXISTS usuarioCurso;
CREATE TABLE usuarioCurso(
	usuarioCurso_id 		INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de usuarioCurso',
    MetodoPago_id 			INT NOT NULL 					COMMENT'Clave Foránea del metodo de pago del usuario',
    Curso_id 				INT NOT NULL 					COMMENT'Clave Foránea del curso',
	Usuario_id 				INT NOT NULL 					COMMENT'Clave Foránea del usuario',
    tiempoRegistro 			DATETIME NOT NULL 				COMMENT'Tiempo de registro del usuario al curso',
	isFinalizado			BIT NOT NULL DEFAULT 0			COMMENT'Bandera que indica si el usuario termino el curso',
    nivelesCompletados 		TINYINT DEFAULT 0               COMMENT'Cantidad de niveles completados del curso por el estudiante',
	tiempoCompletado 		DATETIME 						COMMENT'Tiempo de finalización del usuario al curso',
	costoCurso  			DECIMAL(9,2) UNSIGNED       	COMMENT'Costo del curso en ese momento',
 CONSTRAINT PK_usuarioCurso
	PRIMARY KEY (usuarioCurso_id),
 CONSTRAINT FK_usuarioCurso_MetodoPago
	FOREIGN KEY (MetodoPago_id) REFERENCES MetodoPago(MetodoPago_id),
 CONSTRAINT FK_usuarioCurso_Curso
	FOREIGN KEY (Curso_id) REFERENCES Curso(Curso_id),
 CONSTRAINT FK_usuarioCurso_Usuario
	FOREIGN KEY (Usuario_id) REFERENCES Usuario(Usuario_id)
);


-- 												TABLA DE usuarioNivel--
DROP TABLE IF EXISTS nivelCurso;
CREATE TABLE nivelCurso(
	nivelCurso_id 			INT AUTO_INCREMENT NOT NULL 	COMMENT'Clave Primaria de usuarioNivel',
    MetodoPago_id 			INT NOT NULL 					COMMENT'Clave Foránea del metodo de pago del usuario',
    usuarioCurso_id			INT NOT NULL 					COMMENT'Clave Foránea del usuarioCurso',
	Nivel_id 				INT NOT NULL 					COMMENT'Clave Foránea del nivel',
    tiempoRegistro 			DATETIME NOT NULL 				COMMENT'Tiempo de registro del usuario al curso',
	isFinalizado			BIT NOT NULL DEFAULT 0			COMMENT'Bandera que indica si el usuario termino el nivel',
	tiempoCompletado 		DATETIME						COMMENT'Tiempo de finalización del usuario al nivel',
	costoNivel  			DECIMAL(9,2) UNSIGNED  			COMMENT'Costo del nivel en ese momento',
 CONSTRAINT PK_nivelCurso
	PRIMARY KEY (nivelCurso_id),
 CONSTRAINT FK_PK_nivelCurso_MetodoPago
	FOREIGN KEY (MetodoPago_id) REFERENCES MetodoPago(MetodoPago_id),
 CONSTRAINT FK_PK_nivelCurso_Nivel
	FOREIGN KEY (Nivel_id) REFERENCES Nivel(Nivel_id),
 CONSTRAINT FK_nivelCurso_usuarioCurso
	FOREIGN KEY (usuarioCurso_id) REFERENCES usuarioCurso(usuarioCurso_id)
);

/*
DROP TABLE IF EXISTS nivelCurso;
DROP TABLE IF EXISTS usuarioCurso;
DROP TABLE IF EXISTS Multimedia;
DROP TABLE IF EXISTS Nivel;
DROP TABLE IF EXISTS CursoCategoria;
DROP TABLE IF EXISTS Mensaje;
DROP TABLE IF EXISTS ComentarioCurso;
DROP TABLE IF EXISTS Categoria;
DROP TABLE IF EXISTS Curso;
DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS MetodoPago;
*/

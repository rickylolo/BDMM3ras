USE BDMM_PROYECTO;

/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------------METODOS DE PAGO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vMetodoPago;

CREATE VIEW vMetodoPago AS
SELECT  MetodoPago_id, nombreMetodo, imagenMetodo
FROM MetodoPago;

/*--------------------------------------------------------------------------------CURSO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vCurso;

CREATE VIEW vCurso AS
SELECT  Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
FROM Curso;

/*--------------------------------------------------------------------------------CATEGORIA--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vCategoria;

CREATE VIEW vCategoria AS
SELECT Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro
FROM Categoria;


/*--------------------------------------------------------------------------------COMENTARIO CURSO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vComentarioCurso;

CREATE VIEW vComentarioCurso AS
SELECT ComentarioCurso_id, Usuario_id, Curso_id, isLike, texto, tiempoRegistro
FROM ComentarioCurso;

/*--------------------------------------------------------------------------------COMENTARIO CURSO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vMensaje;

CREATE VIEW vMensaje AS
SELECT Mensaje_id, UsuarioInstructor_id, UsuarioAlumno_id, Curso_id, texto, tiempoRegistro
FROM Mensaje;



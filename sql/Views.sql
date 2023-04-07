USE BDMM_PROYECTO;

/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vUsuario;

CREATE VIEW vUsuario AS
SELECT Usuario_id, MetodoPago_id, correo, userPassword, rolUsuario, fotoPerfil, descripcion, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, sexo, fechaRegistro, ultimoCambio, esBloqueado
FROM Usuario;


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

/*--------------------------------------------------------------------------------MENSAJE-------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vMensaje;

CREATE VIEW vMensaje AS
SELECT Mensaje_id, UsuarioInstructor_id, UsuarioAlumno_id, Curso_id, texto, tiempoRegistro
FROM Mensaje;


/*--------------------------------------------------------------------------------CURSO CATEGORIA-------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vObtenerTodasCategoriaDeCurso;

CREATE VIEW vObtenerTodasCategoriaDeCurso AS
SELECT CursoCategoria_id, Curso_id, A.Categoria_id, Usuario_id, nombre, descripcion, tiempoRegistro
FROM CursoCategoria A
LEFT JOIN Categoria B
ON A.Categoria_id = B.Categoria_id;


DROP VIEW IF EXISTS vObtenerTodosLosCursosDeUnaCategoria;

CREATE VIEW vObtenerTodosLosCursosDeUnaCategoria AS
SELECT CursoCategoria_id, Categoria_id, A.Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja
FROM CursoCategoria A
LEFT JOIN Curso B
ON A.Curso_id = B.Curso_id;



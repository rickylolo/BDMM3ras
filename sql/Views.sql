USE BDMM_PROYECTO;

/*--------------------------------------------------------------------------------USUARIOS--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vUsuario;
CREATE VIEW vUsuario AS
SELECT Usuario_id, correo, userPassword, rolUsuario, fotoPerfil, descripcion, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, sexo, fechaRegistro, ultimoCambio, esBloqueado
FROM Usuario;


/*--------------------------------------------------------------------------------METODOS DE PAGO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vMetodoPago;
CREATE VIEW vMetodoPago AS
SELECT  MetodoPago_id, nombreMetodo, imagenMetodo
FROM MetodoPago;

/*--------------------------------------------------------------------------------CURSO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vCursoNoBorrador;
CREATE VIEW vCursoNoBorrador AS
SELECT  Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja, isBorrador
FROM Curso
WHERE isBorrador <> 1
ORDER BY Curso_id DESC;

DROP VIEW IF EXISTS vCurso;
CREATE VIEW vCurso AS
SELECT  Curso_id, Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, nombre, descripcion, isBaja, isBorrador
FROM Curso;

DROP VIEW IF EXISTS vCursoInstructor;
CREATE VIEW vCursoInstructor AS
SELECT  A.Curso_id,A.isBorrador, A.Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, A.nombre cursoNombre, A.descripcion, isBaja, CursoCategoria_id, C.nombre categoriaNombre, ingresosCurso(A.Curso_id) Ingresos, promedioCurso(A.Curso_id) Promedio, contarAlumnos(A.Curso_id) noAlumnos
FROM Curso A
LEFT JOIN (
    SELECT Curso_id, MAX(CursoCategoria_id) AS maxCategoriaId
    FROM CursoCategoria
    GROUP BY Curso_id
) AS ultimaCategoria
ON A.Curso_id = ultimaCategoria.Curso_id
LEFT JOIN CursoCategoria B 
ON ultimaCategoria.maxCategoriaId = B.CursoCategoria_id
LEFT JOIN Categoria C 
ON B.Categoria_id = C.Categoria_id
GROUP BY A.Curso_id;

DROP VIEW IF EXISTS vCursosMejorCalificado;
CREATE VIEW vCursosMejorCalificado AS
SELECT CONCAT(B.nombre,' ',apellidoPaterno,' ',apellidoMaterno) nombreCompleto, Curso_id, A.Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, A.nombre, A.descripcion, isBaja 
FROM vCurso A
LEFT JOIN Usuario B ON A.Usuario_id= B.Usuario_id 
WHERE noLikes >= noDislikes AND A.isBorrador <> 1
ORDER BY noLikes DESC;


DROP VIEW IF EXISTS vCursosMasVendido;
CREATE VIEW vCursosMasVendido AS
SELECT CONCAT(C.nombre,' ',apellidoPaterno,' ',apellidoMaterno) nombreCompleto,A.Curso_id, noNiveles, A.costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, A.nombre, A.descripcion, isBaja, COUNT(B.Curso_id) misCursosVendidos
FROM Curso A
LEFT JOIN usuarioCurso B
ON A.Curso_id = B.Curso_id
LEFT JOIN Usuario C
ON A.Usuario_id= C.Usuario_id 
WHERE A.isBorrador <> 1
GROUP BY A.Curso_id
ORDER BY misCursosVendidos DESC;

/*--------------------------------------------------------------------------------CATEGORIA--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vCategoria;
CREATE VIEW vCategoria AS
SELECT A.Categoria_id, A.Usuario_id, A.nombre, A.descripcion, A.tiempoRegistro,COUNT(B.Curso_id) as noCursos
FROM Categoria A
LEFT JOIN CursoCategoria B 
ON A.Categoria_id = B.Categoria_id
GROUP BY A.Categoria_id;


/*--------------------------------------------------------------------------------COMENTARIO CURSO--------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vComentarioCurso;
CREATE VIEW vComentarioCurso AS
SELECT CONCAT(B.nombre,' ',apellidoPaterno,' ',apellidoMaterno) nombreUsuario, B.fotoPerfil, ComentarioCurso_id, A.Usuario_id, Curso_id, isLike, texto, tiempoRegistro
FROM ComentarioCurso A
LEFT JOIN Usuario B ON B.Usuario_id = A.Usuario_id;

/*--------------------------------------------------------------------------------MENSAJE-------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vMensaje;
CREATE VIEW vMensaje AS
SELECT Mensaje_id, A.Curso_id, A.UsuarioInstructor_id,  A.UsuarioAlumno_id, imagenCurso, B.nombre, correo, CONCAT(C.nombre,' ', apellidoPaterno,' ',  apellidoMaterno) nombreUsuario, UltimoMensaje
FROM Mensaje A
LEFT JOIN Curso B ON A.Curso_id = B.Curso_id
LEFT JOIN Usuario C ON C.Usuario_id= A.UsuarioInstructor_id;

DROP VIEW IF EXISTS vMensajeDetalle;
CREATE VIEW vMensajeDetalle AS
SELECT MensajeDetalle_id, B.Curso_id, C.Usuario_id, A.Mensaje_id, texto, tiempoRegistro, fotoPerfil,  CONCAT(C.nombre,' ', apellidoPaterno,' ',  apellidoMaterno) nombreUsuario
FROM MensajeDetalle A
LEFT JOIN Usuario C ON C.Usuario_id= A.Usuario_id
LEFT JOIN Mensaje B ON B.Mensaje_id= A.Mensaje_id
ORDER BY tiempoRegistro DESC;

/*--------------------------------------------------------------------------------CURSO CATEGORIA-------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vObtenerTodasCategoriaDeCurso;
CREATE VIEW vObtenerTodasCategoriaDeCurso AS
SELECT CursoCategoria_id, Curso_id, A.Categoria_id, Usuario_id, B.nombre, descripcion, tiempoRegistro
FROM CursoCategoria A
LEFT JOIN Categoria B
ON A.Categoria_id = B.Categoria_id;


DROP VIEW IF EXISTS vObtenerTodosLosCursosDeUnaCategoria;
CREATE VIEW vObtenerTodosLosCursosDeUnaCategoria AS
SELECT CONCAT(C.nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto, Categoria_id, B.Curso_id, B.Usuario_id, noNiveles, costoCurso, noComentarios, noLikes, noDislikes, imagenCurso, B.nombre, B.descripcion, isBaja
FROM CursoCategoria A
LEFT JOIN Curso B ON A.Curso_id = B.Curso_id
LEFT JOIN Usuario C ON C.Usuario_id = B.Usuario_id;


/*--------------------------------------------------------------------------------NIVEL-------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vNivel;
CREATE VIEW vNivel AS
SELECT Nivel_id, Curso_id, noNivel, nombre, costoNivel
FROM Nivel;


DROP VIEW IF EXISTS vObtenerTodosLosNivelesDeUnCurso;
CREATE VIEW vObtenerTodosLosNivelesDeUnCurso AS
SELECT Nivel_id, Curso_id, noNivel, nombre, costoNivel
FROM Nivel;


/*-------------------------------------------------------------------------------- MULTIMEDIA -------------------------------------------------------------------------*/

DROP VIEW IF EXISTS vMultimedia;
CREATE VIEW vMultimedia AS
SELECT Multimedia_id, Nivel_id, multimedia, texto, tipoMultimedia
FROM Multimedia;


DROP VIEW IF EXISTS vObtenerTodaMultimediaDeUnNivel;
CREATE VIEW vObtenerTodaMultimediaDeUnNivel AS
SELECT A.Nivel_id, Multimedia_id, multimedia, texto, tipoMultimedia
FROM Nivel A
LEFT JOIN Multimedia B
ON A.Nivel_id = B.Nivel_id;

/*-------------------------------------------------------------------------------- USUARIO CURSO -------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vObtenerTodosLosCursosDeUnUsuario;
CREATE VIEW vObtenerTodosLosCursosDeUnUsuario AS
SELECT B.Usuario_id, CONCAT(A.nombre,' ',apellidoPaterno,' ',apellidoMaterno) AS nombreCompleto,usuarioCurso_id, B.Curso_id, isFinalizado, nivelesCompletados, tiempoCompletado, B.costoCurso, noNiveles, imagenCurso, C.nombre, C.descripcion
FROM Usuario A
INNER JOIN usuarioCurso B ON A.Usuario_id = B.Usuario_id
INNER JOIN Curso C ON B.Curso_id = C.Curso_id
GROUP BY B.Curso_id;


/*-------------------------------------------------------------------------------- USUARIO NIVEL CURSO-------------------------------------------------------------------------*/
DROP VIEW IF EXISTS vObtenerTodosLosNivelesDeUnCursoDeUnUsuario;
CREATE VIEW vObtenerTodosLosNivelesDeUnCursoDeUnUsuario AS
SELECT A.Usuario_id, C.nivelCurso_id, C.MetodoPago_id, C.usuarioCurso_id, C.Nivel_id, C.isFinalizado, C.costoNivel, noNivel, D.nombre
FROM Usuario A
LEFT JOIN usuarioCurso B
ON A.Usuario_id = B.Usuario_id
LEFT JOIN nivelCurso C
ON B.usuarioCurso_id = C.usuarioCurso_id
LEFT JOIN Nivel D
ON C.Nivel_id = D.Nivel_id
GROUP BY nivelCurso_id;


DROP VIEW IF EXISTS vObtenerTotalGananciasReporteInstructor;
CREATE VIEW vObtenerTotalGananciasReporteInstructor AS
SELECT A.Usuario_id,nombreMetodo, imagenMetodo, ((SELECT SUM(costoCurso) FROM usuarioCurso WHERE usuarioCurso.MetodoPago_id = E.MetodoPago_id) + (SELECT SUM(costoNivel) FROM nivelCurso WHERE nivelCurso.MetodoPago_id = E.MetodoPago_id)) totalIngresos
FROM Usuario A
INNER JOIN Curso B
ON A.Usuario_id = B.Usuario_id
LEFT JOIN usuarioCurso C
ON C.Curso_id= B.Curso_id
LEFT JOIN nivelCurso D
ON D.usuarioCurso_id = C.usuarioCurso_id
INNER JOIN MetodoPago E
ON E.MetodoPago_id = D.MetodoPago_id
GROUP BY  E.MetodoPago_id;


DROP VIEW IF EXISTS vKardex;
CREATE VIEW vKardex AS
SELECT A.Usuario_id, B.Curso_id, B.isFinalizado, C.isBaja, imagenCurso,C.isBorrador, C.nombre nombreCurso, CONCAT(nivelesCompletados,'/',noNiveles) Progreso, D.tiempoRegistro ultimoNivel, F.nombre nombreCategoria, B.tiempoCompletado, B.tiempoRegistro
FROM Usuario A
 JOIN usuarioCurso B ON A.Usuario_id= B.Usuario_id
 JOIN Curso C ON B.Curso_id = C.Curso_id
 JOIN nivelCurso D ON B.usuarioCurso_id = D.usuarioCurso_id
 JOIN CursoCategoria E ON E.Curso_id = C.Curso_id
 JOIN Categoria F ON E.Categoria_id = F.Categoria_id
GROUP BY A.Usuario_id,B.Curso_id;


DROP VIEW IF EXISTS vDiploma;
CREATE VIEW vDiploma AS
SELECT B.Usuario_id, B.Curso_id,CONCAT(A.nombre,' ',A.apellidoPaterno,' ',A.apellidoMaterno) Alumno, B.tiempoCompletado, CONCAT(D.nombre,' ',D.apellidoPaterno,' ',D.apellidoMaterno) Instructor, C.nombre nombreCurso
FROM Usuario A
LEFT JOIN usuarioCurso B ON A.Usuario_id= B.Usuario_id
 JOIN Curso C ON B.Curso_id = C.Curso_id
LEFT JOIN Usuario D ON C.Usuario_id = D.Usuario_id
 WHERE C.isBorrador <> 1 AND B.isFinalizado = 1;

DROP VIEW IF EXISTS vObtenerDetalleCursoInstructor;
CREATE VIEW vObtenerDetalleCursoInstructor AS
SELECT C.Curso_id,C.nombre,C.imagenCurso, CONCAT(A.nombre, ' ', A.apellidoPaterno, ' ', A.apellidoMaterno) AS Alumno, A.fotoPerfil, CONCAT(nivelesCompletados, '/', noNiveles) AS Progreso, ((SELECT SUM(costoCurso) FROM usuarioCurso WHERE usuarioCurso.Usuario_id = A.Usuario_id AND usuarioCurso.Curso_id = C.Curso_id) + (SELECT SUM(costoNivel) FROM nivelCurso WHERE nivelCurso.Usuario_id = A.Usuario_id AND NivelCurso.usuarioCurso_id = UC.usuarioCurso_id)) AS totalPagado,M.nombreMetodo, UC.tiempoRegistro
FROM Usuario A
INNER JOIN usuarioCurso UC ON A.Usuario_id = UC.Usuario_id
INNER JOIN Curso C ON UC.Curso_id = C.Curso_id
INNER JOIN nivelCurso N ON UC.usuarioCurso_id = N.usuarioCurso_id
INNER JOIN MetodoPago M ON M.MetodoPago_id = N.MetodoPago_id
GROUP BY C.Curso_id, UC.Usuario_id
ORDER BY COUNT(N.MetodoPago_id) DESC;




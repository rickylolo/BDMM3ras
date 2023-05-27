<?php
include_once 'CursoQuery.php';


class cursoAPI
{
    function getCursoData($Curso_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursoData($Curso_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "costoCurso" => $row['costoCurso'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "cursoNombre" => $row['cursoNombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja'],
                    "categoriaNombre" => $row['categoriaNombre'],
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getAllCursoData()
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getAllCursoData();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
    function getCursosMejoresCalificados()
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursosMejoresCalificados();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "nombreCompleto" => $row['nombreCompleto'],
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getCursosMasVendidos()
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursosMasVendidos();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "nombreCompleto" => $row['nombreCompleto'],
                    "Curso_id" => $row['Curso_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getCursosMasRecientes()
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursosMasRecientes();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "nombreCompleto" => $row['nombreCompleto'],
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getCursosSearch($nombre)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursosSearch($nombre);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "nombreCompleto" => $row['nombreCompleto'],
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarCurso($Usuario_id, $costoCurso, $imagenCurso, $nombreCurso, $descripcionCurso)
    {
        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->insertarCurso($Usuario_id, $costoCurso, $imagenCurso, $nombreCurso, $descripcionCurso);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "costoCurso" => $row['costoCurso'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function actualizarCurso($Curso_id, $costoCurso, $imagenCurso, $nombreCurso, $descripcionCurso)
    {
        $Curso = new Curso();
        $Curso->actualizarCurso($Curso_id, $costoCurso, $imagenCurso, $nombreCurso, $descripcionCurso);
    }

    function bajaCurso($Curso_id)
    {
        $Curso = new Curso();
        $Curso->bajaCurso($Curso_id);
    }

    function getDiploma($Usuario_id,$Curso_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getDiploma($Usuario_id,$Curso_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Alumno" => $row['Alumno'],
                    "tiempoCompletado" => $row['tiempoCompletado'],
                    "Instructor" => $row['Instructor'],
                    "nombreCurso" => $row['nombreCurso']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getReporteIngresosMetodos($Usuario_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getReporteIngresosMetodo($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Usuario_id" => $row['Usuario_id'],
                    "nombreMetodo" => $row['nombreMetodo'],
                     "imagenMetodo" => base64_encode(($row['imagenMetodo'])),
                    "totalIngresos" => $row['totalIngresos']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
   function aprobarCurso($Curso_id)
    {
        $Curso = new Curso();
        $Curso->aprobarCurso($Curso_id);
    }
    // ----------------------------------------------------------------- CURSO - CATEGORIA -----------------------------------------------------------------

    function getCategoriasDeUnCurso($Curso_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCategoriasDeUnCurso($Curso_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "CursoCategoria_id" => $row['CursoCategoria_id'],
                    "Curso_id" => $row['Curso_id'],
                    "Categoria_id" => $row['Categoria_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getCursosDeUnaCategoria($Categoria_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursosDeUnaCategoria($Categoria_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "nombreCompleto" => $row['nombreCompleto'],
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getReporteInstructor($Usuario_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getReporteInstructor($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "costoCurso" => $row['costoCurso'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "cursoNombre" => $row['cursoNombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja'],
                    "CursoCategoria_id" => $row['CursoCategoria_id'],
                    "categoriaNombre" => $row['categoriaNombre'],
                    "Ingresos" => $row['Ingresos'],
                    "Promedio" => $row['Promedio'],
                    "noAlumnos" => $row['noAlumnos']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getReporteInstructorAprobados($Usuario_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getReporteInstructorAprobados($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "costoCurso" => $row['costoCurso'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "cursoNombre" => $row['cursoNombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja'],
                    "CursoCategoria_id" => $row['CursoCategoria_id'],
                    "categoriaNombre" => $row['categoriaNombre'],
                    "Ingresos" => $row['Ingresos'],
                    "Promedio" => $row['Promedio'],
                    "noAlumnos" => $row['noAlumnos']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getReporteInstructorBaja($Usuario_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getReporteInstructorBaja($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "costoCurso" => $row['costoCurso'],
                    "noComentarios" => $row['noComentarios'],
                    "noLikes" => $row['noLikes'],
                    "noDislikes" => $row['noDislikes'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "cursoNombre" => $row['cursoNombre'],
                    "descripcion" => $row['descripcion'],
                    "isBaja" => $row['isBaja'],
                    "CursoCategoria_id" => $row['CursoCategoria_id'],
                    "categoriaNombre" => $row['categoriaNombre'],
                    "Ingresos" => $row['Ingresos'],
                    "Promedio" => $row['Promedio'],
                    "noAlumnos" => $row['noAlumnos']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
    function insertarCursoCategoria($Curso_id, $Categoria_id)
    {
        $Curso = new Curso();
        $Curso->insertarCursoCategoria($Curso_id, $Categoria_id);
    }

    function eliminarCursoCategoria($CursoCategoria_id)
    {
        $Curso = new Curso();
        $Curso->eliminarCursoCategoria($CursoCategoria_id);
    }

    // ----------------------------------------------------------------- CURSO - USUARIO -----------------------------------------------------------------

    function getCursosDeUnUsuario($Usuario_id)
    {

        $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getCursosDeUnUsuario($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Usuario_id" => $row['Usuario_id'],
                    "usuarioCurso_id" => $row['usuarioCurso_id'],
                    "Curso_id" => $row['Curso_id'],
                    "isFinalizado" => $row['isFinalizado'],
                    "nivelesCompletados" => $row['nivelesCompletados'],
                    "nombreCompleto" => $row['nombreCompleto'],
                    "tiempoCompletado" => $row['tiempoCompletado'],
                    "costoCurso" => $row['costoCurso'],
                    "noNiveles" => $row['noNiveles'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarCursoAUsuario($MetodoPago_id, $Curso_id, $Usuario_id)
    {
        $Curso = new Curso();
        $Curso->insertarCursoAUsuario($MetodoPago_id, $Curso_id, $Usuario_id);
    }

    function getKardex($Usuario_id)
    {
         $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getKardex($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( // nombreCategoria, tiempoCompletado
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "isFinalizado" => $row['isFinalizado'],
                    "nombreCurso" => $row['nombreCurso'],
                    "Progreso" => $row['Progreso'],
                    "ultimoNivel" => $row['ultimoNivel'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombreCategoria" => $row['nombreCategoria'],
                    "tiempoCompletado" => $row['tiempoCompletado'],
                     "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getKardexTerminados($Usuario_id)
    {
         $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getKardexTerminados($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( // nombreCategoria, tiempoCompletado
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "isFinalizado" => $row['isFinalizado'],
                    "nombreCurso" => $row['nombreCurso'],
                    "Progreso" => $row['Progreso'],
                    "ultimoNivel" => $row['ultimoNivel'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombreCategoria" => $row['nombreCategoria'],
                    "tiempoCompletado" => $row['tiempoCompletado'],
                     "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getKardexActivos($Usuario_id)
    {
         $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getKardexActivos($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( // nombreCategoria, tiempoCompletado
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "isFinalizado" => $row['isFinalizado'],
                    "nombreCurso" => $row['nombreCurso'],
                    "Progreso" => $row['Progreso'],
                    "ultimoNivel" => $row['ultimoNivel'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombreCategoria" => $row['nombreCategoria'],
                    "tiempoCompletado" => $row['tiempoCompletado'],
                     "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getKardexSearch($Usuario_id, $Texto)
    {
         $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getKardexSearch($Usuario_id,$Texto);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( // nombreCategoria, tiempoCompletado
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "isFinalizado" => $row['isFinalizado'],
                    "nombreCurso" => $row['nombreCurso'],
                    "Progreso" => $row['Progreso'],
                    "ultimoNivel" => $row['ultimoNivel'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombreCategoria" => $row['nombreCategoria'],
                    "tiempoCompletado" => $row['tiempoCompletado'],
                     "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    function getReporteCursoDetalleInstructor($Curso_id)
    {
         $Curso = new Curso();
        $arrCursos = array();
        $arrCursos["Datos"] = array();

        $res = $Curso->getReporteCursoDetalle($Curso_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Curso_id" => $row['Curso_id'],
                    "nombre" => $row['nombre'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "Alumno" => $row['Alumno'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "Progreso" => $row['Progreso'],
                    "totalPagado" => $row['totalPagado'],
                    "nombreMetodo" => $row['nombreMetodo'],
                    "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCursos["Datos"], $obj);
            }
            echo json_encode($arrCursos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarCurso":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $tipoArchivo = $_FILES['file']['type'];
            $nombreArchivo = $_FILES['file']['name'];
            $tamanoArchivo = $_FILES['file']['size'];
            $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            $var = new cursoAPI();
            $var->insertarCurso($id, $_POST['costoCurso'], $binariosImagen, $_POST['nombreCurso'], $_POST['descripcionCurso']);
            break;
        case "actualizarCurso":
             $binariosImagen = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            }
            $var = new cursoAPI();
            $var->actualizarCurso($_POST['Curso_id'], $_POST['costoCurso'], $binariosImagen, $_POST['nombreCurso'], $_POST['descripcionCurso']);
            break;
        case "bajaCurso":
            $var = new cursoAPI();
            $var->bajaCurso($_POST['Curso_id']);
            break;
        case "aprobarCurso":
            $var = new cursoAPI();
            $var->aprobarCurso($_POST['Curso_id']);
            break;
        case "obtenerCurso":
            $var = new cursoAPI();
            $var->getCursoData($_POST['Curso_id']);
            break;
        case "obtenerTodosLosCursos":
            $var = new cursoAPI();
            $var->getAllCursoData();
            break;
            // ----------------------------------------------------------------- CURSO - CATEGORIA -----------------------------------------------------------------
        case "obtenerCategoriasDeUnCurso":
            $var = new cursoAPI();
            $var->getCategoriasDeUnCurso($_POST['Curso_id']);
            break;
        case "obtenerCursosDeUnaCategoria":
            $var = new cursoAPI();
            $var->getCursosDeUnaCategoria($_POST['Categoria_id']);
            break;
        case "obtenerCursosSearch":
            $var = new cursoAPI();
            $var->getCursosSearch($_POST['texto']);
            break;
        case "insertarCursoCategoria":
            $var = new cursoAPI();
            $var->insertarCursoCategoria($_POST['Curso_id'], $_POST['Categoria_id']);
            break;
        case "eliminarCursoCategoria":
            $var = new cursoAPI();
            $var->eliminarCursoCategoria($_POST['CursoCategoria_id']);
            break;
            // ----------------------------------------------------------------- CURSO - USUARIO -----------------------------------------------------------------
        // -----------------------
        case "insertarCursoUsuario":   
            session_start();
            $id = $_SESSION['Usuario_id'];
            if($_SESSION['rolUsuario'] == 2 || $_SESSION['rolUsuario'] == 1)
            {
                echo 'Solo los estudiantes pueden comprar cursos';
                break;
            }
            $var = new cursoAPI();
            $var->insertarCursoAUsuario($_POST['MetodoPago_id'], $_POST['Curso_id'], $id);
            echo 'Curso registrado exitosamente';
            break;
        case "obtenerCursosDeUnUsuario":
            $var = new cursoAPI();
               session_start();
            $id = $_SESSION['Usuario_id'];
            $var->getCursosDeUnUsuario($id);
            break;
        case "getReporteInstructor":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getReporteInstructor($id);
            break;
        case "getReporteInstructorAprobados":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getReporteInstructorAprobados($id);
            break;
        case "getReporteInstructorBaja":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getReporteInstructorBaja($id);
            break;
        case "getKardex": // TODOS
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getKardex($id);
            break;
        case "getKardexSearch": // BUSQUEDA
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getKardexSearch($id,$_POST['texto']);
            break;
        case "getKardexTerminados": // TERMINADOS
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getKardexTerminados($id);
            break;
        case "getKardexActivos": // ACTIVOS
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getKardexActivos($id);
            break;
        case "getDiploma":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getDiploma($id, $_POST['Curso_id']);
            break;
        case "getReporteIngresosMetodo":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getReporteIngresosMetodos($id);
            break;
        case "getReporteDetalleCursoInstructor":
            $var = new cursoAPI();
            $var->getReporteCursoDetalleInstructor($_POST['Curso_id']);
            break;
        // -----------------------

        case "getCursosMejoresCalificados":
            $var = new cursoAPI();
            $var->getCursosMejoresCalificados();
            break;
        case "getCursosMasVendidos":
            $var = new cursoAPI();
            $var->getCursosMasVendidos();
            break;
        case "getCursosMasRecientes":
            $var = new cursoAPI();
            $var->getCursosMasRecientes();
            break;
    }
}

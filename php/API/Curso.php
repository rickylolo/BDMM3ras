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
                    "CursoCategoria_id" => $row['CursoCategoria_id'],
                    "Categoria_id" => $row['Categoria_id'],
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "noNiveles" => $row['noNiveles'],
                    "costoCurso" => $row['costoCurso'],
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

    function insertarCursoAUsuario($MetodoPago_id, $Curso_id, $Usuario_id, $costoCurso)
    {
        $Curso = new Curso();
        $Curso->insertarCursoAUsuario($MetodoPago_id, $Curso_id, $Usuario_id, $costoCurso);
    }
    
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarCurso":
            $tipoArchivo = $_FILES['file']['type'];
            $nombreArchivo = $_FILES['file']['name'];
            $tamanoArchivo = $_FILES['file']['size'];
            $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            session_start();
            $id = $_SESSION['Usuario_id'];
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
        case "insertarCursoCategoria":
            $var = new cursoAPI();
            $var->insertarCursoCategoria($_POST['Curso_id'], $_POST['Categoria_id']);
            break;
        case "eliminarCursoCategoria":
            $var = new cursoAPI();
            $var->eliminarCursoCategoria($_POST['CursoCategoria_id']);
            break;
            // ----------------------------------------------------------------- CURSO - USUARIO -----------------------------------------------------------------
        case "obtenerCursosDeUnUsuario":
            $var = new cursoAPI();
            $var->getCursosDeUnUsuario($_POST['Usuario_id']);
            break;
        case "insertarCursoAUsuario":
            $var = new cursoAPI();
            $var->insertarCursoAUsuario($_POST['MetodoPago_id'], $_POST['Curso_id'], $_POST['Usuario_id'], $_POST['costoCurso']);
            break;
        case "getReporteInstructor":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new cursoAPI();
            $var->getReporteInstructor($id);
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

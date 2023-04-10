<?php
include_once '../Query/Comentario.php';





class comentarioAPI
{


    function getComentarioData($Comentario_id)
    {

        $Comentario = new Comentario();
        $arrComentarios = array();
        $arrComentarios["Datos"] = array();

        $res = $Comentario->getComentarioData($Comentario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "ComentarioCurso_id" => $row['ComentarioCurso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "Curso_id" => $row['Curso_id'],
                    "isLike" => $row['isLike'],
                    "texto" => $row['texto'],
                    "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrComentarios["Datos"], $obj);
            }
            echo json_encode($arrComentarios["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
    function getAllComentariosData()
    {

        $Comentario = new Comentario();
        $arrComentarios = array();
        $arrComentarios["Datos"] = array();

        $res = $Comentario->getAllComentariosData();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "ComentarioCurso_id" => $row['ComentarioCurso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "Curso_id" => $row['Curso_id'],
                    "isLike" => $row['isLike'],
                    "texto" => $row['texto'],
                    "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrComentarios["Datos"], $obj);
            }
            echo json_encode($arrComentarios["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarComentario($Usuario_id, $Curso_id, $isLike, $textoComentario)
    {
        $Comentario = new Comentario();
        $Comentario->insertarComentario($Usuario_id, $Curso_id, $isLike, $textoComentario);
    }


    function actualizarComentario($Comentario_id,$isLike, $textoComentario)
    {
        $Comentario = new Comentario();
        $Comentario->actualizarComentario($Comentario_id,$isLike, $textoComentario);
    }

    function eliminarComentario($Comentario_id)
    {
        $Comentario = new Comentario();
        $Comentario->eliminarComentario($Comentario_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarComentario":
            $var = new comentarioAPI();
            $var->insertarComentario($_POST['Usuario_id'],$_POST['Curso_id'],$_POST['isLike'],$_POST['textoComentario']);
            break;
        case "actualizarComentario":
            $var = new comentarioAPI();
            $var->actualizarComentario($_POST['Comentario_id'],$_POST['isLike'],$_POST['textoComentario']);
            break;
        case "eliminarComentario":
            $var = new comentarioAPI();
            $var->eliminarComentario($_POST['Comentario_id']);
            break;
        case "obtenerDataComentario":
            $var = new comentarioAPI();
            $var->getComentarioData($_POST['Comentario_id']);
            break;
        case "obtenerDataTodosComentario":
            $var = new comentarioAPI();
            $var->getAllComentariosData();
            break;
    }
}


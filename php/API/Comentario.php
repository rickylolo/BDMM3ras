<?php
include_once 'ComentarioQuery.php';





class comentarioAPI
{


    
    function getComentarioData($Usuario_id, $Curso_id)
    {

        $Comentario = new Comentario();
        $arrComentarios = array();
        $arrComentarios["Datos"] = array();

        $res = $Comentario->getComentarioData($Usuario_id, $Curso_id);
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


}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarComentario":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new comentarioAPI();
            $var->insertarComentario($id,$_POST['Curso_id'],$_POST['isLike'],$_POST['textoComentario']);
            break;
        case "obtenerDataTodosComentario":
            $var = new comentarioAPI();
            $var->getAllComentariosData();
            break;
        case "obtenerDataComentario":
            session_start();
            $id = $_SESSION['Usuario_id'];
            $var = new comentarioAPI();
            $var->getComentarioData($id,$_POST['Curso_id']);
            break;
    }
}


<?php
include_once 'MultimediaQuery.php';


class multimediaAPI
{


    function getMultimediaNivelData($Nivel_id)
    {

        $Multimedia = new Multimedia();
        $arrMultimedias = array();
        $arrMultimedias["Datos"] = array();

        $res = $Multimedia->getMultimediaNivelData($Nivel_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Multimedia_id" => $row['Multimedia_id'],
                    "multimedia" => base64_encode(($row['multimedia'])),
                    "texto" => $row['texto'],
                    "tipoMultimedia" => $row['tipoMultimedia']

                );
                array_push($arrMultimedias["Datos"], $obj);
            }
            echo json_encode($arrMultimedias["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
        function getMultimediaData($Multimedia_id)
    {

        $Multimedia = new Multimedia();
        $arrMultimedias = array();
        $arrMultimedias["Datos"] = array();

        $res = $Multimedia->getMultimediaData($Multimedia_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Multimedia_id" => $row['Multimedia_id'],
                    "Nivel_id" => $row['Nivel_id'],
                    "multimedia" => base64_encode(($row['multimedia'])),
                    "texto" => $row['texto'],
                    "tipoMultimedia" => $row['tipoMultimedia']

                );
                array_push($arrMultimedias["Datos"], $obj);
            }
            echo json_encode($arrMultimedias["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    

    function insertarMultimedia($Nivel_id,$MultimediaEscapeString, $Texto, $tipoMultimedia)
    {
        $Multimedia = new Multimedia();
        $Multimedia->insertarMultimedia($Nivel_id,$MultimediaEscapeString, $Texto, $tipoMultimedia);
    }

    
    function actualizarMultimedia($Multimedia_id,$MultimediaEscapeString, $Texto, $tipoMultimedia)
    {
        $Multimedia = new Multimedia();
        $arrMultimedias = array();
        $arrMultimedias["Datos"] = array();

        $res =   $Multimedia->actualizarMultimedia($Multimedia_id,$MultimediaEscapeString, $Texto, $tipoMultimedia);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Nivel_id" => $row['Nivel_id']
                );
                array_push($arrMultimedias["Datos"], $obj);
            }
            echo json_encode($arrMultimedias["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function eliminarMultimedia($Multimedia_id)
    {
        $Multimedia = new Multimedia();
        $arrMultimedias = array();
        $arrMultimedias["Datos"] = array();
        $res =   $Multimedia->eliminarMultimedia($Multimedia_id);

        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Nivel_id" => $row['Nivel_id']
                );
                array_push($arrMultimedias["Datos"], $obj);
            }
            echo json_encode($arrMultimedias["Datos"]);
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
        case "registrarMultimedia":
           $binarios = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binarios = fread($imagenSubida, $tamanoArchivo);
                $tipoMultimedia = $_POST['tipoMultimedia'];
            }
            else{
                 $tipoMultimedia = 1;
            }
            $var = new multimediaAPI();
            $var->insertarMultimedia($_POST['Nivel_id'], $binarios,$_POST['Texto'],$tipoMultimedia);
            break;
        case "actualizarMultimedia":
           $binarios = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binarios = fread($imagenSubida, $tamanoArchivo);
            }
            $var = new multimediaAPI();
            $var->actualizarMultimedia($_POST['Multimedia_id'],$binarios,$_POST['Texto'],$_POST['tipoMultimedia']);
            break;
        case "eliminarMultimedia":
            $var = new multimediaAPI();
            $var->eliminarMultimedia($_POST['Multimedia_id']);
            break;
        case "obtenerDataMultimediaNivel":
            $var = new multimediaAPI();
            $var->getMultimediaNivelData($_POST['Nivel_id']);
            break;
        case "obtenerDataMultimedia":
            $var = new multimediaAPI();
            $var->getMultimediaData($_POST['Multimedia_id']);
            break;
    }
}


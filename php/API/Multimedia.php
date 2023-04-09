<?php
include_once '../Query/Multimedia.php';


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
    

    function insertarMultimedia($Nivel_id,$Multimedia, $Texto, $tipoMultimedia)
    {
        $Multimedia = new Multimedia();
        $Multimedia->insertarMultimedia($Nivel_id,$Multimedia, $Texto, $tipoMultimedia);
    }


    function eliminarMultimedia($Multimedia_id)
    {
        $Multimedia = new Multimedia();
        $Multimedia->eliminarMultimedia($Multimedia_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarMultimedia":
            $tipoArchivo = $_FILES['file']['type'];
            $nombreArchivo = $_FILES['file']['name'];
            $tamanoArchivo = $_FILES['file']['size'];
            $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
            $binarios = fread($imagenSubida, $tamanoArchivo);
            $var = new multimediaAPI();
            $var->insertarMultimedia($_POST['Nivel_id'], $binarios,$_POST['Texto'],$_POST['tipoMultimedia']);
            break;
        case "eliminarMultimedia":
            $var = new multimediaAPI();
            $var->eliminarMultimedia($_POST['Multimedia_id']);
            break;
        case "obtenerDataMultimediaNivel":
            $var = new multimediaAPI();
            $var->getMultimediaNivelData($_POST['Nivel_id']);
            break;

    }
}


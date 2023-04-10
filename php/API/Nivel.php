<?php
include_once '../Query/Nivel.php';


class nivelAPI
{


    function getNivelData($Curso_id)
    {

        $Nivel = new Nivel();
        $arrNivels = array();
        $arrNivels["Datos"] = array();

        $res = $Nivel->getNivelData($Curso_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Nivel_id" => $row['Nivel_id'],
                    "noNivel" => $row['noNivel'],
                    "nombreNivel" => $row['nombreNivel'],
                    "costoNivel" => $row['costoNivel'],
                    "Curso_id" => $row['Curso_id'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombreCurso" => $row['nombreCurso']
                );
                array_push($arrNivels["Datos"], $obj);
            }
            echo json_encode($arrNivels["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    

    function insertarNivel($Curso_id,$noNivel, $nombreNivel, $costoNivel)
    {
        $Nivel = new Nivel();
        $Nivel->insertarNivel($Curso_id,$noNivel, $nombreNivel, $costoNivel);
    }

    
    function actualizarNivel($Nivel_id,$noNivel, $nombreNivel, $costoNivel)
    {
        $Nivel = new Nivel();
        $Nivel->insertarNivel($Nivel_id,$noNivel, $nombreNivel, $costoNivel);
    }


    function eliminarNivel($Nivel_id)
    {
        $Nivel = new Nivel();
        $Nivel->eliminarNivel($Nivel_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarNivel":
            $var = new nivelAPI();
            $var->insertarNivel($_POST['Curso_id'], $_POST['noNivel'],$_POST['nombreNivel'],$_POST['costoNivel']);
            break;
        case "actualizarNivel":
            $var = new nivelAPI();
            $var->actualizarNivel($_POST['Nivel_id'], $_POST['noNivel'],$_POST['nombreNivel'],$_POST['costoNivel']);
            break;
        case "eliminarNivel":
            $var = new nivelAPI();
            $var->eliminarNivel($_POST['Nivel_id']);
            break;
        case "obtenerDataNivelesDeUnCurso":
            $var = new nivelAPI();
            $var->getNivelData($_POST['Curso_id']);
            break;

    }
}


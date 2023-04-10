<?php
include_once '../Query/Mensaje.php';


class mensajeAPI
{


    function getMensajeData($Curso_id)
    {

        $Mensaje = new Mensaje();
        $arrMensajes = array();
        $arrMensajes["Datos"] = array();

        $res = $Mensaje->getMensajeData($Curso_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Mensaje_id" => $row['Mensaje_id'],
                    "noMensaje" => $row['noMensaje'],
                    "nombreMensaje" => $row['nombreMensaje'],
                    "costoMensaje" => $row['costoMensaje'],
                    "Curso_id" => $row['Curso_id'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombreCurso" => $row['nombreCurso']
                );
                array_push($arrMensajes["Datos"], $obj);
            }
            echo json_encode($arrMensajes["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    

    function insertarMensaje($Curso_id,$noMensaje, $nombreMensaje, $costoMensaje)
    {
        $Mensaje = new Mensaje();
        $Mensaje->insertarMensaje($Curso_id,$noMensaje, $nombreMensaje, $costoMensaje);
    }

    
    function actualizarMensaje($Mensaje_id,$noMensaje, $nombreMensaje, $costoMensaje)
    {
        $Mensaje = new Mensaje();
        $Mensaje->insertarMensaje($Mensaje_id,$noMensaje, $nombreMensaje, $costoMensaje);
    }


    function eliminarMensaje($Mensaje_id)
    {
        $Mensaje = new Mensaje();
        $Mensaje->eliminarMensaje($Mensaje_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarMensaje":
            $var = new mensajeAPI();
            $var->insertarMensaje($_POST['Curso_id'], $_POST['noMensaje'],$_POST['nombreMensaje'],$_POST['costoMensaje']);
            break;
        case "actualizarMensaje":
            $var = new mensajeAPI();
            $var->actualizarMensaje($_POST['Mensaje_id'], $_POST['noMensaje'],$_POST['nombreMensaje'],$_POST['costoMensaje']);
            break;
        case "eliminarMensaje":
            $var = new mensajeAPI();
            $var->eliminarMensaje($_POST['Mensaje_id']);
            break;
        case "obtenerDataMensajeesDeUnCurso":
            $var = new mensajeAPI();
            $var->getMensajeData($_POST['Curso_id']);
            break;

    }
}


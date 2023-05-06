<?php
include_once 'MensajeQuery.php';


class mensajeAPI
{


    function getMensajesInstructor($Instructor_id)
    {

        $Mensaje = new Mensaje();
        $arrMensajes = array();
        $arrMensajes["Datos"] = array();

        $res = $Mensaje->getMensajesInstructorData($Instructor_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Mensaje_id" => $row['Mensaje_id'],
                    "Curso_id" => $row['Curso_id'],
                    "UsuarioInstructor_id" => $row['UsuarioInstructor_id'],
                    "UsuarioAlumno_id" => $row['UsuarioAlumno_id'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "correo" => $row['correo'],
                    "nombreUsuario" => $row['nombreUsuario']
                );
                array_push($arrMensajes["Datos"], $obj);
            }
            echo json_encode($arrMensajes["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getMensajesEstudiante($Alumno_id)
    {

        $Mensaje = new Mensaje();
        $arrMensajes = array();
        $arrMensajes["Datos"] = array();

        $res = $Mensaje->getMensajesEstudianteData($Alumno_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Mensaje_id" => $row['Mensaje_id'],
                    "Curso_id" => $row['Curso_id'],
                    "UsuarioInstructor_id" => $row['UsuarioInstructor_id'],
                    "UsuarioAlumno_id" => $row['UsuarioAlumno_id'],
                    "imagenCurso" => base64_encode(($row['imagenCurso'])),
                    "nombre" => $row['nombre'],
                    "correo" => $row['correo'],
                    "nombreUsuario" => $row['nombreUsuario']
                );
                array_push($arrMensajes["Datos"], $obj);
            }
            echo json_encode($arrMensajes["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    

    function getMensajesDetalle($Mensaje_id)
    {

        $Mensaje = new Mensaje();
        $arrMensajes = array();
        $arrMensajes["Datos"] = array();

        $res = $Mensaje->getTodosMensajes($Mensaje_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "MensajeDetalle_id" => $row['MensajeDetalle_id'],
                    "Curso_id" => $row['Curso_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "Mensaje_id" => $row['Mensaje_id'],
                    "texto" => $row['texto'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "tiempoRegistro" => $row['tiempoRegistro'],
                    "nombreUsuario" => $row['nombreUsuario']
                );
                array_push($arrMensajes["Datos"], $obj);
            }
            echo json_encode($arrMensajes["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarMensaje($UsuarioInstructor,$UsuarioAlumno, $Curso_id)
    {
        $Mensaje = new Mensaje();
        $Mensaje->insertarMensaje($UsuarioInstructor,$UsuarioAlumno, $Curso_id);
    }

    function insertarMensajeDetalle($Mensaje_id,$Usuario_id, $Texto)
    {
        $Mensaje = new Mensaje();
        $Mensaje->insertarMensajeDetalle($Mensaje_id,$Usuario_id, $Texto);
    }

}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarMensaje":
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['rolUsuario'] == 3) {
                    $id = $_SESSION['Usuario_id'];
                    $var = new mensajeAPI();
                    $var->insertarMensaje($_POST['Instructor_id'], $id  ,$_POST['Curso_id']);
                     echo '3'; // Se hizo de manera satisfactoria
                }
                else{
                    echo '1'; // No se puede registrar mensaje que no sea de alumno
                }
            }
            else{
                echo '0'; // No hay Sesión
            }
         
        break;

        case "obtenerMensajes":
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['rolUsuario'] == 2) {
                    $Usuario_id = $_SESSION['Usuario_id'];
                    $var = new mensajeAPI();
                    $var->getMensajesInstructor($Usuario_id);
                }
                 if($_SESSION['rolUsuario'] == 3){
                    $Usuario_id = $_SESSION['Usuario_id'];
                    $var = new mensajeAPI();
                    $var->getMensajesEstudiante($Usuario_id);
                 }
            }else{
                  echo '0'; // No hay Sesión
            }
        break;
        case "obtenerMensajesHeader";
            $var = new mensajeAPI();
            $var->getMensajesDetalle($_POST['Mensaje_id']);
        break;

        case "insertarMensajeDetalle":

            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['rolUsuario'] == 3 || $_SESSION['rolUsuario'] == 2) {
                    $id = $_SESSION['Usuario_id'];
                    $var = new mensajeAPI();
                    $var->insertarMensajeDetalle($_POST['Mensaje_id'],$id,$_POST['Texto']);
                     echo '3'; // Se hizo de manera satisfactoria
                }
            }
            else{
                echo '0'; // No hay Sesión
            }
        break;



    }
}


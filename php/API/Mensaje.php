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
    

    function insertarMensaje($UsuarioInstructor,$UsuarioAlumno, $Curso_id)
    {
        $Mensaje = new Mensaje();
        $Mensaje->insertarMensaje($UsuarioInstructor,$UsuarioAlumno, $Curso_id);
    }

}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "insertarMensaje":
            $var = new mensajeAPI();
            $var->insertarMensaje($_POST['Instructor_id'], $_POST['Alumno_id'],$_POST['Curso_id']);
            break;
        case "obtenerMensajesInstructor":
            $var = new mensajeAPI();
            $var->getMensajesInstructor($_POST['Instructor_id']);
            break;
        case "obtenerMensajesEstudiante":
            $var = new mensajeAPI();
            $var->getMensajesEstudiante($_POST['Alumno_id']);
            break;

    }
}


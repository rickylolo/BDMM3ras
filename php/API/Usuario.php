<?php
include_once 'UsuarioQuery.php';





class usuarioAPI
{
    function seleccionLoggeo($email, $password)
    {

        $user = new User();
        $arrUsers = array();
        $arrUsers["Datos"] = array();

        $res = $user->IniciarSesion($email, $password);

        if ($res) { // Entra si hay información
            session_start();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $obj = array(
                    "Usuario_id" => $row['Usuario_id'],
                    "rolUsuario" => $row['rolUsuario']
                );
                $_SESSION['Usuario_id'] = $obj["Usuario_id"];
                $_SESSION['rolUsuario'] = $obj["rolUsuario"];
                array_push($arrUsers["Datos"], $obj);
            }
            echo json_encode($arrUsers["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getUserData($Usuario_id)
    {
        
        $user = new User();
        $arrUsers = array();
        $arrUsers["Datos"] = array();

        $res = $user->getUserData($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $obj = array(
                    "Usuario_id" => $row['Usuario_id'],
                    "correo" => $row['correo'],
                    "rolUsuario" => $row['rolUsuario'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "descripcion" => $row['descripcion'],
                    "nombre" => $row['nombre'],
                    "apellidoMaterno" => $row['apellidoMaterno'],
                    "apellidoPaterno" => $row['apellidoPaterno'],
                    "fechaNacimiento" => $row['fechaNacimiento'],
                    "sexo" => $row['sexo']
                );
                array_push($arrUsers["Datos"], $obj);
            }
            echo json_encode($arrUsers["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }


    function getUserDataInstructor($Usuario_id)
    {
        
        $user = new User();
        $arrUsers = array();
        $arrUsers["Datos"] = array();

        $res = $user->getUserDataInstructor($Usuario_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $obj = array( 
                    "Usuario_id" => $row['Usuario_id'],
                    "correo" => $row['correo'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "descripcion" => $row['descripcion'],
                    "nombre" => $row['nombre']
                );
                array_push($arrUsers["Datos"], $obj);
            }
            echo json_encode($arrUsers["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function getUserBloqueadosData()
    {

        $user = new User();
        $arrUsers = array();
        $arrUsers["Datos"] = array();

        $res = $user->getBlockedUserData();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

                $obj = array(
                    "Usuario_id" => $row['Usuario_id'],
                    "correo" => $row['correo'],
                    "rolUsuario" => $row['rolUsuario'],
                    "fotoPerfil" => base64_encode(($row['fotoPerfil'])),
                    "descripcion" => $row['descripcion'],
                    "nombre" => $row['nombre'],
                    "apellidoMaterno" => $row['apellidoMaterno'],
                    "apellidoPaterno" => $row['apellidoPaterno'],
                    "fechaNacimiento" => $row['fechaNacimiento'],
                    "ultimoCambio" => $row['ultimoCambio'],
                    "sexo" => $row['sexo']
                );
                array_push($arrUsers["Datos"], $obj);
            }
            echo json_encode($arrUsers["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarUser($email, $password, $user_Type, $user_IMG, $names, $lastNameP, $lastNameM, $fechaNac,  $genero)
    {
        $user = new User();
        $user->insertarUsuario($email, $password, $user_Type, $user_IMG, $names, $lastNameP, $lastNameM, $fechaNac,  $genero);
    }


    function actualizarUser($Usuario_id, $correo, $contraseña, $rol, $user_IMG, $descripcion, $names, $lastNameP, $lastNameM, $fechaNac,  $genero)
    {
        $user = new User();
        $user->actualizarUser($Usuario_id, $correo, $contraseña, $rol, $user_IMG, $descripcion, $names, $lastNameP, $lastNameM, $fechaNac,  $genero);
    }

    function BloqueoUsuario($correo)
    {
        $user = new User();
        $user->bloqueoUsuario($correo);
    }
    function actualizarBloqueo($Usuario_id)
    {
        $user = new User();
        $user->actualizarBloqueo($Usuario_id);
    }
    function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location:index.php");
        exit();
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "iniciarSesion":
            $var = new usuarioAPI();
            $var->seleccionLoggeo($_POST['username'], $_POST['password']);
            break;
        case "registrarUsuario":
            $tipoArchivo = $_FILES['file']['type'];
            $nombreArchivo = $_FILES['file']['name'];
            $tamanoArchivo = $_FILES['file']['size'];
            $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            $var = new usuarioAPI();
            $var->insertarUser($_POST['email'], $_POST['password'], $_POST['user_Type'], $binariosImagen, $_POST['names'], $_POST['lastNameP'], $_POST['lastNameM'], $_POST['fechaNac'], $_POST['genero']);
            break;
        case "actualizarUser":
            $binariosImagen = '';
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != NULL) {
                $tipoArchivo = $_FILES['file']['type'];
                $nombreArchivo = $_FILES['file']['name'];
                $tamanoArchivo = $_FILES['file']['size'];
                $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            }
            session_start();
            $id = $_SESSION['Usuario_id'];
            $rol = $_SESSION['rolUsuario'];
            $var = new usuarioAPI();
            $var->actualizarUser($id, $_POST['email'], $_POST['password'], $rol, $binariosImagen, $_POST['descripcion'], $_POST['names'], $_POST['lastNameP'], $_POST['lastNameM'], $_POST['fechaNac'], $_POST['genero']);
            break;
        case "obtenerDataUsuario":

            session_start();
            if (!empty($_SESSION)) {
            $id = $_SESSION['Usuario_id'];
            $var = new usuarioAPI();
            $var->getUserData($id);
            }
            else{
                echo '0';
            }
            break;
        case "obtenerDataUsuarioInstructor":
            $var = new usuarioAPI();
            $var->getUserDataInstructor($_POST['Usuario_id']);
            break;
        case "obtenerDataUsuariosBloqueados":
            $var = new usuarioAPI();
            $var->getUserBloqueadosData();
            break;

        case "bloquearUsuario":
            $var = new usuarioAPI();
            $var->BloqueoUsuario($_POST['correo']);
            break;
        case "actualizarBloqueo":
            $var = new usuarioAPI();
            $var->actualizarBloqueo($_POST['Usuario_id']);
            break;
    }
}

//Cerrar Sesión
if (isset($_GET['logout'])) {
    $var = new usuarioAPI();
    $var->cerrarSesion();
}

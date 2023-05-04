
<?php
include_once 'db.php';

class User extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------
    // QUERY Iniciar Sesion Usuario 

    function IniciarSesion($emailUsername, $password)
    {
        $get = "CALL sp_GestionUsuario(
            'L', #Operacion
            NULL, #Id Usuario
            NULL, #Id Metodo Pago
            '$emailUsername', #Correo
            '$password', #Contraseña
            NULL, #Rol de usuario
            NULL, #PFP
            NULL, #Descripción
            NULL, # Nombre(s)
            NULL, # Apellido Paterno
            NULL, # Apellido Materno
            NULL, # Fecha de nacimiento
            NULL, # Genero
            NULL  # Flag Perfil Bloqueado
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // QUERY Get Datos Usuario

    function getUserData($Usuario_id)
    {
        $get = "CALL sp_GestionUsuario(
            'G', #Operacion
            $Usuario_id, #Id Usuario
            NULL, #Correo
            NULL, #Nickname
            NULL, #Contraseña
            NULL, #Rol de usuario
            NULL, #PFP
            NULL, #Descripcion
            NULL, # Nombre(s)
            NULL, # Apellido Paterno
            NULL, # Apellido Materno
            NULL, # Fecha de nacimiento
            NULL, # Genero
            NULL  # Flag Perfil Bloqueado          
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Datos Usuario Instructor
    function getUserDataInstructor($Usuario_id)
    {
        $get = "CALL sp_GestionUsuario(
            'X', #Operacion
            $Usuario_id, #Id Usuario
            NULL, #Correo
            NULL, #Nickname
            NULL, #Contraseña
            NULL, #Rol de usuario
            NULL, #PFP
            NULL, #Descripcion
            NULL, # Nombre(s)
            NULL, # Apellido Paterno
            NULL, # Apellido Materno
            NULL, # Fecha de nacimiento
            NULL, # Genero
            NULL  # Flag Perfil Bloqueado          
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // QUERY Get Datos Usuarios Bloqueados

    function getBlockedUserData()
    {
        $get = "CALL sp_GestionUsuario(
            'B', #Operacion
            NULL, #Id Usuario
            NULL, #Correo
            NULL, #Nickname
            NULL, #Contraseña
            NULL, #Rol de usuario
            NULL, #PFP
            NULL, #Descripcion
            NULL, # Nombre(s)
            NULL, # Apellido Paterno
            NULL, # Apellido Materno
            NULL, # Fecha de nacimiento
            NULL, # Genero
            NULL  # Flag Perfil Bloqueado          
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Usuario

    function insertarUsuario($email, $password, $user_Type, $user_IMG, $names, $lastNameP, $lastNameM, $fechaNac,  $genero)
    {
        $user_IMG = mysqli_escape_string($this->myCon(), $user_IMG); //IMAGEN
        $insert = "CALL sp_GestionUsuario(
            'I', #Operacion
            NULL, #Id Usuario
            NULL, #Id Metodo Pago
            '$email', #Correo
            '$password', #Contraseña
            $user_Type, #Rol de usuario
            '$user_IMG', #PFP
            NULL, #Descripción
            '$names', # Nombre(s)
            '$lastNameP', # Apellido Paterno
            '$lastNameM', # Apellido Materno
            '$fechaNac', # Fecha de nacimiento
            '$genero', # Genero
            NULL # Flag Perfil Bloqueado    
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

    // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
    // QUERY Actualizar Usuario

    function actualizarUser($Usuario_id, $MetodoPago_id, $correo, $contraseña, $rol, $user_IMG, $descripcion, $names, $lastNameP, $lastNameM, $fechaNac,  $genero)
    {
        $user_IMG = mysqli_escape_string($this->myCon(), $user_IMG); //IMAGEN
        $update = "CALL sp_GestionUsuario(
            'E', #Operacion
            $Usuario_id, #Id Usuario
            $MetodoPago_id, #Id Metodo Pago
            '$correo', #Correo
            '$contraseña', #Contraseña
            $rol, #Rol de usuario
            '$user_IMG', #PFP
            '$descripcion', #Descripción
            '$names', # Nombre(s)
            '$lastNameP', # Apellido Paterno
            '$lastNameM', # Apellido Materno
            '$fechaNac', # Fecha de nacimiento
            '$genero', # Genero
            NULL # Flag Perfil Bloqueado    
        );";
        $query = $this->connect()->query($update);
        return $query;
    }



    // QUERY Actualizar Bloqueo

    function actualizarBloqueo($Usuario_id, $isBloqueado)
    {
        $update = "CALL sp_GestionUsuario(
            'P', #Operacion
            $Usuario_id, #Id Usuario
            NULL, #Id Metodo Pago
            NULL, #Correo
            NULL, #Contraseña
            NULL, #Rol de usuario
            NULL, #PFP
            NULL, #Descripción
            NULL, # Nombre(s)
            NULL, # Apellido Paterno
            NULL, # Apellido Materno
            NULL, # Fecha de nacimiento
            NULL, # Genero
            $isBloqueado # Flag Perfil Bloqueado    

        ); ";
        $query = $this->connect()->query($update);
        return $query;
    }

    // ---------------------------------------ELIMINAR INFORMACION------------------------------------------


}

?>

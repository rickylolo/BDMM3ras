
<?php
include_once 'db.php';

class Mensaje extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Mensajes Alumno

    function getMensajeData($Alumno_id)
    {
        $get = "CALL sp_GestionMensaje(
                    'G',  		    #Operacion
                    NULL, 		    # Id
                    NULL,	# Instructor Id
                    $Alumno_id, 	        # Alumno Id
                    NULL, 		    # Curso Id
                    NULL            # Texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Todos Mensajes Instructor

    function getAllMensajesInstructorData($Instructor_id)
    {
        $get = "CALL sp_GestionMensaje(
                    'A',  		    #Operacion
                    NULL, 		    # Id
                    $Instructor_id,	# Instructor Id
                    NULL, 	        # Alumno Id
                    NULL, 		    # Curso Id
                    NULL            # Texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Mensaje

    function insertarMensaje($Instructor_id,$Alumno_id, $Curso_id, $textoMensaje)
    {
        $insert = "CALL sp_GestionMensaje(
                    'I',  		#Operacion
                    NULL, 		# Id
                    $Instructor_id,	# Instructor Id
                    $Alumno_id, 	# Alumno Id
                    $Curso_id, 		# Curso Id
                    '$textoMensaje' # Texto
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------



   // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Mensaje

    function eliminarMensaje($Mensaje_id)
    {
        $delete = "CALL sp_GestionMensaje(
                'D', # Operacion
                $Mensaje_id, # Id
                NULL, # User Id
                NULL, #Curso Id
                NULL, # is Like
                NULL  # texto
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>

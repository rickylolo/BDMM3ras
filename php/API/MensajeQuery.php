
<?php
include_once 'db.php';

class Mensaje extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Todos Mensajes Header Instructor

    function getMensajesInstructorData($Instructor_id)
    {
        $get = "CALL sp_GestionMensaje(
                    'X',  		    #Operacion
                    NULL, 		    # Id
                    $Instructor_id,	# Instructor Id
                    NULL, 	        # Alumno Id
                    NULL 		    # Curso Id
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Todos Mensajes Instructor

    function getMensajesEstudianteData($Alumno_id)
    {
        $get = "CALL sp_GestionMensaje(
                    'Z',  		    #Operacion
                    NULL, 		    # Id
                    NULL,	        # Instructor Id
                    $Alumno_id,     # Alumno Id
                    NULL 		    # Curso Id
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // QUERY Get Todos Mensajes Head 

    function getTodosMensajes($Mensaje_id)
    {
        $get = "CALL sp_GestionMensajeDetalle(
                    'G',  		    #Operacion
                    NULL, 		    # Id
                    $Mensaje_id,	# Mensaje Id
                    NULL,           # Usuario Id
                    NULL            # Texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Mensaje

    function insertarMensaje($Instructor_id,$Alumno_id, $Curso_id)
    {
        $insert = "CALL sp_GestionMensaje(
                    'I',  		#Operacion
                    NULL, 		# Id
                    $Instructor_id,	# Instructor Id
                    $Alumno_id, 	# Alumno Id
                    $Curso_id 		# Curso Id
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

    // QUERY Insertar Mensaje Detalle
    function insertarMensajeDetalle($Mensaje_id,$Usuario_id,$Texto)
    {
        $insert = "CALL sp_GestionMensajeDetalle(
                    'I',  		    #Operacion
                    NULL, 		    # Id
                    $Mensaje_id,	# Mensaje Id
                    $Usuario_id,    # Usuario Id
                    '$Texto'        # Texto
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

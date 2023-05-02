
<?php
include_once 'db.php';

class Nivel extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Niveles de un Curso

    function getNivelesData($Curso_id)
    {
        $get = "CALL sp_GestionNivel(
	            'A',  # Operacion
	            NULL,    # Nivel Id	
                $Curso_id, 		# Curso Id	
                NULL,  			# nombre
                NULL  		# costoNivel
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // QUERY Get Niveles de un Curso

    function getNivelData($Nivel_id)
    {
        $get = "CALL sp_GestionNivel(
	            'G',  # Operacion
	            $Nivel_id,    # Nivel Id	
                NULL, 		# Curso Id	
                NULL,  			# nombre
                NULL  		# costoNivel
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Nivel

    function insertarNivel($Curso_id,$nombreNivel, $costoNivel)
    {
        $insert = "CALL sp_GestionNivel(
	                'I',                # Operacion
	                NULL,               # Nivel Id	
                    $Curso_id, 		    # Curso Id	
                    '$nombreNivel',  	# nombre
                    $costoNivel  	    # costoNivel
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
   // QUERY Actualizar Nivel

    function actualizarNivel($Nivel_id,$nombreNivel, $costoNivel)
    {
        $update = "CALL sp_GestionNivel(
	                'E',                # Operacion
	                $Nivel_id,          # Nivel Id	
                    NULL, 		        # Curso Id	
                    '$nombreNivel',  	# nombre
                    $costoNivel  		# costoNivel
        );";
        $query = $this->connect()->query($update);
        return $query;
    }


   // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Nivel

    function eliminarNivel($Nivel_id)
    {
        $delete = "CALL sp_GestionNivel(
	                'D',  # Operacion
	                $Nivel_id,    # Nivel Id	
                    NULL, 		# Curso Id	
                    NULL,  			# nombre
                    NULL  		# costoNivel
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }



      // ---------------------------------------                                     <--   NIVEL - CURSO  -->                                    ------------------------------------------

      
    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos de los Niveles de un Curso de un Usuario
    function getNivelesCursoUsuarioData($usuarioCurso_id)
    {
        $get = "CALL sp_GestionNivelCurso(
                'G', 		#Operacion
                NULL, 		#niveCurso Id
                NULL, 		#MetodoPago Id
                $usuarioCurso_id, 		#usuarioCurso Id
                NULL,       #Usuario Id
                NULL		#costoNivel
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Nivel Curso Usuario

    function insertarNivelUsuarioCurso($MetodoPago_id,$usuarioCurso_id, $Nivel_id, $costoNivel)
    {
        $insert = "CALL sp_GestionNivelCurso(
                   'I',             #Operacion
                   NULL, 		    #niveCurso Id
                   $MetodoPago_id,  #MetodoPago Id
                   $usuarioCurso_id, #usuarioCurso Id
                   $Nivel_id,       #Usuario Id
                   $costoNivel      #costoNivel
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }
}

?>

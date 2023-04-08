
<?php
include_once '../DB/db.php';

class Nivel extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Niveles de un Curso

    function getNivelData($Curso_id)
    {
        $get = "CALL sp_GestionNivel(
	            'G',  # Operacion
	            NULL,    # Nivel Id	
                $Curso_id, 		# Curso Id	
                NULL,          # noNivel
                NULL,  			# nombre
                NULL  		# costoNivel
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Nivel

    function insertarNivel($Curso_id,$noNivel, $nombreNivel, $costoNivel)
    {
        $insert = "CALL sp_GestionNivel(
	                'I',                # Operacion
	                NULL,               # Nivel Id	
                    $Curso_id, 		    # Curso Id	
                    $noNivel,           # noNivel
                    '$nombreNivel',  	# nombre
                    $costoNivel  	    # costoNivel
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
   // QUERY Actualizar Nivel

    function actualizarNivel($Nivel_id,$noNivel, $nombreNivel, $costoNivel)
    {
        $update = "CALL sp_GestionComentario(
	                'E',                # Operacion
	                $Nivel_id,          # Nivel Id	
                    NULL, 		        # Curso Id	
                    $noNivel,           # noNivel
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
                    NULL,          # noNivel
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

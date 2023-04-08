
<?php
include_once '../DB/db.php';

class Multimedia extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Multimedia de un Nivel

    function getMultimediaNivelData($Nivel_id)
    {
        $get = "CALL sp_GestionMultimedia(
                'G',  		# Operacion
                NULL,    		# Id
                $Nivel_id, 	    # Nivel Id
                NULL,  		# Multimedia
                NULL, 		# Texto
                NULL 		# Tipo Multimedia
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Multimedia

    function insertarMultimedia($Nivel_id,$Multimedia, $Texto, $tipoMultimedia)
    {
        $Multimedia = mysqli_escape_string($this->myCon(), $Multimedia); //MI BLOB
        $insert = "CALL sp_GestionMultimedia(
                    'I',  # Operacion
                    NULL,    # Id
                    $Nivel_id, 	    # Nivel Id
                    $Multimedia,  		# Multimedia
                    '$Texto', 			# Texto
                    $tipoMultimedia 	# Tipo Multimedia
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }


   // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Multimedia

    function eliminarMultimedia($Multimedia_id)
    {
        $delete = "CALL sp_GestionMultimedia(
                    'D',  		# Operacion
                    $Multimedia_id,    		# Id
                    NULL, 	    # Nivel Id
                    NULL,  		# Multimedia
                    NULL, 		# Texto
                    NULL 		# Tipo Multimedia
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>

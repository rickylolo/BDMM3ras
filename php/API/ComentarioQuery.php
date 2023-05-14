
<?php
include_once 'db.php';

class Comentario extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Comentario

    function getComentarioData($Curso_id)
    {
        $get = "CALL sp_GestionComentario(
                'G', # Operacion
                NULL, # Id
                NULL, # User Id
                $Curso_id, #Curso Id
                NULL, # is Like
                NULL # texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Datos Todos Comentario 

    function getAllComentariosEstudianteData($Usuario_id,$Curso_id)
    {
        $get = "CALL sp_GestionComentario(
                'E', # Operacion
                NULL, # Id
                $Usuario_id, # User Id
                $Curso_id, #Curso Id
                NULL, # is Like
                NULL # texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Comentario

    function insertarComentario($Usuario_id, $Curso_id, $isLike, $textoComentario)
    {
        $insert = "CALL sp_GestionComentario(
                    'I', # Operacion
                    NULL, # Id
                    $Usuario_id, # User Id
                    $Curso_id, # Curso Id
                    $isLike, # is Like
                    '$textoComentario' # texto
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }
     
}

?>


<?php
include_once 'db.php';

class Comentario extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Comentario

    function getComentarioData($Comentario_id)
    {
        $get = "CALL sp_GestionComentario(
                'G', # Operacion
                $Comentario_id, # Id
                NULL, # User Id
                NULL, #Curso Id
                NULL, # is Like
                NULL # texto
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Datos Todos Comentario 

    function getAllComentariosData()
    {
        $get = "CALL sp_GestionComentario(
                'A', # Operacion
                NULL, # Id
                NULL, # User Id
                NULL, #Curso Id
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

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
   // QUERY Actualizar Comentario

    function actualizarComentario($Comentario_id,$isLike, $textoComentario)
    {
        $update = "CALL sp_GestionComentario(
                    'E', # Operacion
                    $Comentario_id, # Id
                    NULL, # User Id
                    NULL, # Curso Id
                    $isLike, # is Like
                    '$textoComentario' # texto
        );";
        $query = $this->connect()->query($update);
        return $query;
    }


     // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Comentario

    function eliminarComentario($Comentario_id)
    {
        $delete = "CALL sp_GestionComentario(
                'D', # Operacion
                $Comentario_id, # Id
                NULL, # User Id
                NULL, #Curso Id
                NULL, # is Like
                NULL # texto
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>

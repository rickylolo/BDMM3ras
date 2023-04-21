
<?php
include_once 'db.php';

class Categoria extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Categoria

    function getCategoriaData($Categoria_id)
    {
        $get = "CALL sp_GestionCategoria(
            'G', # Operacion
            $Categoria_id, # Id
            NULL, # Usuario Id
            NULL, # Nombre
            NULL #Descripcion
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Datos Todos Categoria 

    function getAllCategoriasData()
    {
        $get = "CALL sp_GestionCategoria(
            'A', # Operacion
            NULL, # Id
            NULL, # Usuario Id
            NULL, # Nombre
            NULL #Descripcion
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Categoria

    function insertarCategoria($Usuario_id, $nombreCategoria, $descripcionCategoria)
    {
        $insert = "CALL sp_GestionCategoria(
            'I',                        # Operacion
            NULL,                       # Id
            $Usuario_id,                # Usuario Id
            '$nombreCategoria', 		# Nombre
            '$descripcionCategoria'  	# Descripcion
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
   // QUERY Actualizar Categoria

    function actualizarCategoria($Categoria_id,$nombreCategoria, $descripcionCategoria)
    {
        $update = "CALL sp_GestionCategoria(
            'E',                        # Operacion
            $Categoria_id,                       # Id
            NULL,                # Usuario Id
            '$nombreCategoria', 		# Nombre
            '$descripcionCategoria'  	# Descripcion
        );";
        $query = $this->connect()->query($update);
        return $query;
    }


     // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar Categoria

    function eliminarCategoria($Categoria_id)
    {
        $delete = "CALL sp_GestionCategoria(
            'D', # Operacion
            $Categoria_id, # Id
            NULL, # Usuario Id
            NULL, # Nombre
            NULL #Descripcion
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>

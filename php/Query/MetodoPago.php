
<?php
include_once '../DB/db.php';

class MetodoPago extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos MetodoPago

    function getMetodoPagoData($MetodoPago_id)
    {
        $get = "CALL sp_GestionMetodoPago(
           'G', #Operacion
            $MetodoPago_id, #MetodoPago_Id	 
            NULL,  #Nombre Metodo	
            NULL   #Imagen Metodo
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Datos Todos MetodoPago 

    function getAllMetodoPagoData()
    {
        $get = "CALL sp_GestionMetodoPago(
            'A', #Operacion
            NULL, #MetodoPago_Id	 
            NULL,  #Nombre Metodo	
            NULL   #Imagen Metodo
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar MetodoPago

    function insertarMetodoPago($NombreMetodo, $ImagenMetodo)
    {
        $ImagenMetodo = mysqli_escape_string($this->myCon(), $ImagenMetodo); //IMAGEN
        $insert = "CALL sp_GestionMetodoPago(
           'I', #Operacion
            NULL, #MetodoPago_Id	 
            '$NombreMetodo',  #Nombre Metodo	
            $ImagenMetodo   #Imagen Metodo
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
   // QUERY Actualizar MetodoPago

    function actualizarMetodoPago($MetodoPago_id,$NombreMetodo, $ImagenMetodo)
    {
        $ImagenMetodo = mysqli_escape_string($this->myCon(), $ImagenMetodo); //IMAGEN
        $update = "CALL sp_GestionMetodoPago(
            'E', #Operacion
            $MetodoPago_id, #MetodoPago_Id	 
            '$NombreMetodo',  #Nombre Metodo	
            $ImagenMetodo   #Imagen Metodo
        );";
        $query = $this->connect()->query($update);
        return $query;
    }


     // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
      // QUERY Eliminar MetodoPago

    function eliminarMetodoPago($MetodoPago_id)
    {
        $delete = "CALL sp_GestionMetodoPago(
            'D', #Operacion
            $MetodoPago_id, #MetodoPago_Id	 
            NULL,  #Nombre Metodo	
            NULL   #Imagen Metodo
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     
}

?>

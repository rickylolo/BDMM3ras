
<?php
include_once '../DB/db.php';

class Curso extends DB
{

    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Curso

    function getCursoData($Curso_id)
    {
        $get = "CALL sp_GestionCurso(
            'G', 	#Operacion
            $Curso_id, 	# Curso Id
            NULL, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     // QUERY Get Datos Todos Curso 

    function getAllCursoData()
    {
        $get = "CALL sp_GestionCurso(
            'A', 	#Operacion
            NULL, 	# Curso Id
            NULL, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Curso

    function insertarCurso($Usuario_id, $costoCurso, $imagenCurso, $nombreCurso, $descripcionCurso)
    {
        $imagenCurso = mysqli_escape_string($this->myCon(), $imagenCurso); //IMAGEN
        $insert = "CALL sp_GestionCurso(
           'I', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            $costoCurso,  	# Curso Costo
            $imagenCurso,	# Curso Imagen
            '$nombreCurso',	# Curso Nombre
            '$descripcionCurso', 	# Curso Descripcion
            NULL 		# Curso isBaja
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

   // ---------------------------------------ACTUALIZAR INFORMACION------------------------------------------
   // QUERY Actualizar Curso

    function actualizarCurso($Curso_id, $costoCurso, $imagenCurso, $nombreCurso, $descripcionCurso)
    {
        $imagenCurso = mysqli_escape_string($this->myCon(), $imagenCurso); //IMAGEN
        $update = "CALL sp_GestionCurso(
            'E', 	#Operacion
            $Curso_id, 	# Curso Id
            NULL, 	# Usuario Id
            $costoCurso,  	# Curso Costo
            $imagenCurso,	# Curso Imagen
            '$nombreCurso',	# Curso Nombre
            '$descripcionCurso', 	# Curso Descripcion
            NULL 		# Curso isBaja
        );";
        $query = $this->connect()->query($update);
        return $query;
    }

       // QUERY Baja Curso

    function bajaCurso($Curso_id)
    {
        $update = "CALL sp_GestionCurso(
            'B', 	#Operacion
            $Curso_id, 	# Curso Id
            NULL, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        );";
        $query = $this->connect()->query($update);
        return $query;
    }
     
    // ---------------------------------------                                     <--   CURSO - CATEGORIA  -->                                    ------------------------------------------

      
    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Cursos de una Categoria

    function getCursosDeUnaCategoria($Categoria_id)
    {
        $get = "CALL sp_GestionCurso(
                'A',    #Operacion 
                NULL ,  # CursoCategoria id
                NULL  	,	# Curso id
                $Categoria_id # Categoria id 
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    // QUERY Get Datos Categorias de un curso

    function getCategoriasDeUnCurso($Curso_id)
    {
        $get = "CALL sp_GestionCurso(
                'C',    #Operacion 
                NULL ,  # CursoCategoria id
                $Curso_id  	,	# Curso id
                NULL # Categoria id 
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


       // ---------------------------------------INSERTAR INFORMACION------------------------------------------
    // QUERY Insertar Curso

    function insertarCursoCategoria($Curso_id, $Categoria_id)
    {
        $insert = "CALL sp_GestionCurso(
                'I',            # Operacion
                NULL ,          # CursoCategoria id
                $Curso_id  	,	# Curso id
                $Categoria_id   # Categoria id
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

     // ---------------------------------------ELIMINAR INFORMACION------------------------------------------

    function eliminarCursoCategoria($CursoCategoria_id)
    {
        $delete = "CALL sp_GestionMensaje(
                'D',    #Operacion 
                $CursoCategoria_id ,  # CursoCategoria id
                NULL  	,	# Curso id
                NULL       # Categoria id 
        );";
        $query = $this->connect()->query($delete);
        return $query;
    }
     

     // ---------------------------------------                                     <--   USUARIO - CURSO  -->                                    ------------------------------------------

      
    // ---------------------------------------CONSULTA DE INFORMACION------------------------------------------

    // QUERY Get Datos Cursos de un Usuario
    function getCursosDeUnUsuario($Usuario_id)
    {
        $get = "CALL sp_GestionUsuarioCurso(
                'G', 		#Operacion
                NULL, 		#usuarioCurso Id
                NULL, 		#MetodoPago Id
                NULL, 		#Curso Id
                $Usuario_id,#Usuario Id
                NULL		#costoCurso
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    function insertarCursoAUsuario($MetodoPago_id, $Curso_id,$Usuario_id,$costoCurso)
    {
        $insert = "CALL sp_GestionCurso(
                  'I',  #Operacion
                  NULL, #usuarioCurso Id
                  $MetodoPago_id,    #MetodoPago Id
                  $Curso_id,    #Curso Id
                  $Usuario_id,    #Usuario Id
                  $costoCurso #costoCurso
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }



}

?>

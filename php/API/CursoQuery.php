
<?php
include_once 'db.php';

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

    // QUERY Get Datos Cursos Mejores Calificados

    function getCursosMejoresCalificados()
    {
        $get = "CALL sp_GestionCurso(
            'X', 	#Operacion
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

    // QUERY Get Datos Cursos Mas Vendidos

    function getCursosMasVendidos()
    {
        $get = "CALL sp_GestionCurso(
            'Y', 	#Operacion
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

    // QUERY Get Datos Cursos Mas Recientes

    function getCursosMasRecientes()
    {
        $get = "CALL sp_GestionCurso(
            'Z', 	#Operacion
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

        // QUERY Get Datos Cursos Search
    function getCursosSearch($nombre)
    {
        $get = "CALL sp_GestionCurso(
            'S', 	#Operacion
            NULL, 	# Curso Id
            NULL, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            '$nombre',	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    // QUERY REPORTE INSTRUCTOR

    function getReporteInstructor($Usuario_id)
    {
        $get = "CALL sp_GestionCurso(
            'R', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }
    
    // QUERY REPORTE INSTRUCTOR APROBADOS

    function getReporteInstructorAprobados($Usuario_id)
    {
        $get = "CALL sp_GestionCurso(
            'U', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    function getReporteInstructorBaja($Usuario_id)
    {
        $get = "CALL sp_GestionCurso(
            'F', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

       // QUERY GET DIPLOMA

    function getDiploma($Usuario_id, $Curso_id)
    {
        $get = "CALL sp_GestionCurso(
            'C', 	#Operacion
            $Curso_id, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

           // QUERY GET INGRESOS METODO

    function getReporteIngresosMetodo($Usuario_id,)
    {
        $get = "CALL sp_GestionCurso(
            'Q', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
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
        $imagenCurso2 = mysqli_escape_string($this->myCon(), $imagenCurso); //IMAGEN
        $insert = "CALL sp_GestionCurso(
           'I', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            $costoCurso,  	# Curso Costo
            '$imagenCurso2',	# Curso Imagen
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
            '$imagenCurso',	# Curso Imagen
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

        // QUERY Aprobar Curso

    function aprobarCurso($Curso_id)
    {
        $update = "CALL sp_GestionCurso(
            'T', 	#Operacion
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
        $get = "CALL sp_GestionCursoCategoria(
                'C',    #Operacion 
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
        $get = "CALL sp_GestionCursoCategoria(
                'A',    #Operacion 
                NULL ,  # CursoCategoria id
                $Curso_id,	# Curso id
                NULL # Categoria id 
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }


    function getKardex($Usuario_id)
    {
        $get = "CALL sp_GestionCurso(
            'K', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    function getKardexSearch($Usuario_id, $Texto)
    {
        $get = "CALL sp_GestionCurso(
            'O', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            '$Texto',	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    function getKardexTerminados($Usuario_id)
    {
        $get = "CALL sp_GestionCurso(
            'H', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
            NULL,  	# Curso Costo
            NULL,	# Curso Imagen
            NULL,	# Curso Nombre
            NULL, 	# Curso Descripcion
            NULL 	# Curso isBaja
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

     
    function getKardexActivos($Usuario_id)
    {
        $get = "CALL sp_GestionCurso(
            'N', 	#Operacion
            NULL, 	# Curso Id
            $Usuario_id, 	# Usuario Id
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
    // QUERY Insertar Curso Categoria

    function insertarCursoCategoria($Curso_id, $Categoria_id)
    {
        $insert = "CALL sp_GestionCursoCategoria(
                'I',            # Operacion
                NULL ,          # CursoCategoria id
                $Curso_id  	,	# Curso id
                $Categoria_id   # Categoria id
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }

    // ---------------------------------------ELIMINAR INFORMACION------------------------------------------
    // QUERY Eliminar Curso Categoria
    function eliminarCursoCategoria($CursoCategoria_id)
    {
        $delete = "CALL sp_GestionCursoCategoria(
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
                $Usuario_id #Usuario Id
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    
        // QUERY Get ReporteCursoDetalle
    function getReporteCursoDetalle($Curso_id)
    {
        $get = "CALL sp_GestionUsuarioCurso(
            'T', 		#Operacion
                NULL, 		#usuarioCurso Id
                NULL, 		#MetodoPago Id
                $Curso_id, 		#Curso Id
                NULL #Usuario Id
        ); ";
        $query = $this->connect()->query($get);
        return $query;
    }

    function insertarCursoAUsuario($MetodoPago_id, $Curso_id, $Usuario_id)
    {
        $insert = "CALL sp_GestionUsuarioCurso(
                  'I',  #Operacion
                  NULL, #usuarioCurso Id
                  $MetodoPago_id,    #MetodoPago Id
                  $Curso_id,    #Curso Id
                  $Usuario_id    #Usuario Id
        ); ";
        $query = $this->connect()->query($insert);
        return $query;
    }
}

?>

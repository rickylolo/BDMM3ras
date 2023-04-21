<?php
include_once 'CategoriaQuery.php';





class categoriaAPI
{


    function getCategoriaData($Categoria_id)
    {

        $Categoria = new Categoria();
        $arrCategorias = array();
        $arrCategorias["Datos"] = array();

        $res = $Categoria->getCategoriaData($Categoria_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array( 
                    "Categoria_id" => $row['Categoria_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCategorias["Datos"], $obj);
            }
            echo json_encode($arrCategorias["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
    function getAllCategoriasData()
    {

        $Categoria = new Categoria();
        $arrCategorias = array();
        $arrCategorias["Datos"] = array();

        $res = $Categoria->getAllCategoriasData();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "Categoria_id" => $row['Categoria_id'],
                    "Usuario_id" => $row['Usuario_id'],
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "tiempoRegistro" => $row['tiempoRegistro']
                );
                array_push($arrCategorias["Datos"], $obj);
            }
            echo json_encode($arrCategorias["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarCategoria($Usuario_id, $nombreCategoria, $descripcionCategoria)
    {
        $Categoria = new Categoria();
        $Categoria->insertarCategoria($Usuario_id, $nombreCategoria, $descripcionCategoria);
    }


    function actualizarCategoria($Categoria_id,$nombreCategoria, $descripcionCategoria)
    {
        $Categoria = new Categoria();
        $Categoria->actualizarCategoria($Categoria_id,$nombreCategoria, $descripcionCategoria);
    }

    function eliminarCategoria($Categoria_id)
    {
        $Categoria = new Categoria();
        $Categoria->eliminarCategoria($Categoria_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarCategoria":
            $var = new categoriaAPI();
            $var->insertarCategoria($_POST['Usuario_id'],$_POST['nombreCategoria'],$_POST['descripcionCategoria']);
            break;
        case "actualizarCategoria":
            $var = new categoriaAPI();
            $var->actualizarCategoria($_POST['Categoria_id'],$_POST['nombreCategoria'],$_POST['descripcionCategoria']);
            break;
        case "eliminarCategoria":
            $var = new categoriaAPI();
            $var->eliminarCategoria($_POST['Categoria_id']);
            break;
        case "obtenerDataCategoria":
            $var = new categoriaAPI();
            $var->getCategoriaData($_POST['Categoria_id']);
            break;
        case "obtenerDataTodosCategoria":
            $var = new categoriaAPI();
            $var->getAllCategoriasData();
            break;
    }
}


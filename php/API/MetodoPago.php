<?php
include_once 'MetodoPagoQuery.php';





class metodoPagoAPI
{


    function getMetodoPagoData($MetodoPago_id)
    {

        $MetodoPago = new MetodoPago();
        $arrMetodoPagos = array();
        $arrMetodoPagos["Datos"] = array();

        $res = $MetodoPago->getMetodoPagoData($MetodoPago_id);
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "MetodoPago_id" => $row['MetodoPago_id'],
                    "nombreMetodo" => $row['nombreMetodo'],
                    "imagenMetodo" => base64_encode(($row['imagenMetodo']))
                );
                array_push($arrMetodoPagos["Datos"], $obj);
            }
            echo json_encode($arrMetodoPagos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }
    
    function getAllMetodoPagoData()
    {

        $MetodoPago = new MetodoPago();
        $arrMetodoPagos = array();
        $arrMetodoPagos["Datos"] = array();

        $res = $MetodoPago->getAllMetodoPagoData();
        if ($res) { // Entra si hay información
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $obj = array(
                    "MetodoPago_id" => $row['MetodoPago_id'],
                    "nombreMetodo" => $row['nombreMetodo'],
                    "imagenMetodo" => base64_encode(($row['imagenMetodo']))
                );
                array_push($arrMetodoPagos["Datos"], $obj);
            }
            echo json_encode($arrMetodoPagos["Datos"]);
        } else {
            header("Location:../index.php");
            exit();
        }
    }

    function insertarMetodoPago($NombreMetodo, $ImagenMetodo)
    {
        $MetodoPago = new MetodoPago();
        $MetodoPago->insertarMetodoPago($NombreMetodo, $ImagenMetodo);
    }


    function actualizarMetodoPago($MetodoPago_id,$NombreMetodo, $ImagenMetodo)
    {
        $MetodoPago = new MetodoPago();
        $MetodoPago->actualizarMetodoPago($MetodoPago_id,$NombreMetodo, $ImagenMetodo);
    }

    function eliminarMetodoPago($MetodoPago_id)
    {
        $MetodoPago = new MetodoPago();
        $MetodoPago->eliminarMetodoPago($MetodoPago_id);
    }
}

//AJAX
if (isset($_POST['funcion'])) {
    $funcion = $_POST['funcion'];
    switch ($funcion) {
        case "registrarMetodoPago":
            $tipoArchivo = $_FILES['file']['type'];
            $nombreArchivo = $_FILES['file']['name'];
            $tamanoArchivo = $_FILES['file']['size'];
            $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            $var = new metodoPagoAPI();
            $var->insertarMetodoPago($_POST['NombreMetodo'], $binariosImagen);
            break;
        case "actualizarMetodoPago":
            $tipoArchivo = $_FILES['file']['type'];
            $nombreArchivo = $_FILES['file']['name'];
            $tamanoArchivo = $_FILES['file']['size'];
            $imagenSubida = fopen($_FILES['file']['tmp_name'], 'r');
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            $var = new metodoPagoAPI();
            $var->actualizarMetodoPago($_POST['MetodoPago_id'],$_POST['NombreMetodo'], $binariosImagen);
            break;
        case "eliminarMetodoPago":
            $var = new metodoPagoAPI();
            $var->eliminarMetodoPago($_POST['MetodoPago_id']);
            break;
        case "obtenerDataMetodoPago":
            $var = new metodoPagoAPI();
            $var->getMetodoPagoData($_POST['MetodoPago_id']);
            break;
        case "obtenerDataTodosMetodoPago":
            $var = new metodoPagoAPI();
            $var->getAllMetodoPagoData();
            break;
    }
}


<?php
require_once "../conexion/conexion.php";
require_once "../conexion/productos.php";

    $obj= new productos();

    $idart=$_POST['idart'];
    echo json_encode($obj->obtenerdatosproducto($idart));
 ?>

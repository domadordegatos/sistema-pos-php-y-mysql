<?php
    require_once "../conexion/conexion.php";
    $conexion=conexion();
    require_once "../conexion/ventas.php";

    $obj= new ventas();

    echo json_encode($obj->obtenerproducto($_POST['idproducto']))
 ?>

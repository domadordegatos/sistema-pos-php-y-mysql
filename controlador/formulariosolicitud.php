<?php
    require_once "../conexion/conexion.php";
    $conexion=conexion();
    require_once "../conexion/solicitudes.php";

    $obj= new ventas();

    echo json_encode($obj->obtenerproducto($_POST['idproducto']))
 ?>

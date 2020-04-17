<?php
require_once "../conexion/conexion.php";
require_once "../conexion/productos.php";
  $idart=$_POST['idarticulo'];
    $obj= new productos();

    echo $obj->eliminarproducto($idart);
?>

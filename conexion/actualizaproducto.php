<?php
require_once "conexion.php";
require_once "productos.php";
$obj= new productos();

$datos=array(
  $_POST['idarticulo'],
  $_POST['nombreA'],
  $_POST['categoriaA'],
  $_POST['cantidadA'],
  $_POST['precioA']
            );
        echo $obj->actualizarproducto($datos);
 ?>

<?php
require_once "conexion.php";
require_once "productos.php";
$conexion=conexion();

 $obj= new productos();

$datos=array();

$datos[0]=$_POST['nombre'];
$datos[1]=$_POST['categoria'];
$datos[2]=$_POST['cantidad'];
$datos[3]=$_POST['precio'];
echo $obj->insertarproducto($datos);
 ?>

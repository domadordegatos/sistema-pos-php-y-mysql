<?php
session_start();
require_once "../conexion/conexion.php";
require_once "../conexion/ventas.php";
$conexion=conexion();

$obj= new ventas();

if (count($_SESSION['tablacomprastemp'])==0) {
  echo 0;
}else{
  $result=$obj->crearventa();
  unset($_SESSION['tablacomprastemp']);
  echo $result;
}
 ?>

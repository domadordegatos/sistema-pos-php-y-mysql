<?php
	session_start();
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];

    require_once "conexion.php";
    $conexion=conexion();
        //recuperar las variables html
    $Cedula=$_POST['cedula'];
    $Nombre=$_POST['nombre'];
    $Apellido=$_POST['apellido'];
    $Telefono=$_POST['telefono'];
    $Id='';

    $sqll = "SELECT * from clientes where cedula='$Cedula'";
    $result = mysqli_query($conexion,$sqll);

    if(mysqli_num_rows($result)>0){
      echo 2;//cliente existe
    }else{
         $sql="INSERT INTO clientes VALUES ('$Id','$Nombre','$Apellido','$Cedula','$Telefono')";
				 echo 1;//ciente no existe se agrega
         }
    //ejecutamos la centencia de sql
    $ejecutar=mysqli_query($conexion, $sql);
    //verificacion de la ejecucioon
    if(!$ejecutar){
        echo"hubo algun error";
    }
    } else {
    	header("location:../interfaz/login/iniciologin2.php");
    	}
?>﻿

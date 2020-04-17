
<?php

    require_once "conexion.php";
    $conexion=conexion();
        //recuperar las variables html
    $Cedula=$_POST['cedula'];

    $sqll = "SELECT * from clientes where cedula='$Cedula'";
    $result = mysqli_query($conexion, $sqll);

    if(mysqli_num_rows($result)>0){
    echo "<script>";
    echo "window.location = '../interfaz/factu/facturacionregistrado/facturacion.php?cedula=$Cedula';";
    echo "</script>";
    }else{
    echo "<script>";
    echo "window.location = '../interfaz/factu/facturacionregistrado/facturacion.php?cedula=$Cedula';";
    echo "</script>";
    }

?>﻿

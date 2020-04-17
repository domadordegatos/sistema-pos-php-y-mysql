<?php

	require_once "conexion.php";

	$conexion=conexion();

		$Usuario=$_POST['usuario'];
    $Pregunta1=$_POST['pregunta1'];
    $Pregunta2=$_POST['pregunta2'];
		$Contrasena =$_POST['contrasena'];

    $busquedaid="SELECT idusers from users where usuario='$Usuario'";
    $result=mysqli_query($conexion,$busquedaid);
    while($mostrar=mysqli_fetch_array($result)){
    $mostrar['idusers'];
    $iddelusuario=$mostrar['idusers'];
    }
    // tenemos el id del usuario a buscar las preguntas

		$sql1="SELECT * from preguntaseguridad where pre1='$Pregunta1' and pre2='$Pregunta2' and usuario='$iddelusuario'";
		$result1=mysqli_query($conexion,$sql1);

		if(mysqli_num_rows($result1) > 0){
      $update="UPDATE users SET contrasena='$Contrasena' WHERE idusers='$iddelusuario'";
	  	$resultadodelupdate=mysqli_query($conexion,$update);
			echo 1;
         $mensaje = "Cambio de contraseña exitoso";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../interfaz/login/iniciologin2.php';";
          echo "</script>";
	  	}else{

			echo 0;
      $mensaje = "Esta cuenta no existe, registre los datos bien o contacte a soporte";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../interfaz/login/iniciologin2.php';";
          echo "</script>";
		}
 ?>

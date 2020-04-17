<?php

	session_start();
	require_once "conexion.php";

	$conexion=conexion();

		$Usuario=$_POST['usuario'];
		$Clave=$_POST['password'];

		$busquedaid="SELECT idusers from users where usuario='$Usuario'";
		$result=mysqli_query($conexion,$busquedaid);
		while($mostrar=mysqli_fetch_array($result)){
		$mostrar['idusers'];
		$iddelusuario=$mostrar['idusers'];
	}//primero averiguamos el id del usuario que intenta acceder

		$sql="SELECT estado from users_activos
		where iduser='$iddelusuario'";
	  $resultado=mysqli_query($conexion,$sql);
	  while($mostrar1=mysqli_fetch_assoc($resultado)){
			$mostrar1['estado'];
			$estado=$mostrar1['estado'];
		}//luego averiguamos el estado de ese usuario para abajo poder ver si puede acceder o no
		if($estado==0){
				  echo 4;
		}else{
		$sql1="SELECT * from users where usuario='$Usuario' and contrasena='$Clave'";
		$result1=mysqli_query($conexion,$sql1);

		if(mysqli_num_rows($result1) > 0){
			$_SESSION['user']=$Usuario;
			echo 1;
		}else{
			echo 0;
			header("location:../interfaz/login/iniciologin2.php");

		}
	}
 ?>

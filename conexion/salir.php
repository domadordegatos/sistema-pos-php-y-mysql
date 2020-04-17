<?php

	session_start();

	unset($_SESSION['user']);
	//cerrar sesion

	header("location:../interfaz/login/iniciologin2.php");

 ?>

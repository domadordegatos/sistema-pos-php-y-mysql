<?php
	  require_once "conexion.php";
    $conexion=conexion();


    // $idusers=$_REQUEST['idusers'];

    // $idusers=(isset($_POST["idusers"]));

    $contrasena=$_POST['contrasena'];
		$usuario=$_POST['usuario'];
		$rol=$_POST['rol'];
		$estado=$_POST['inlineRadioOptions'];
		$idusers=$_POST['idusers'];
    // $contrasena=(isset($_POST["contrasena"]));
    $consulta="UPDATE users SET  usuario='$usuario',
		                             contrasena='$contrasena',
		                             rol='$rol'
																 WHERE idusers='$idusers'";
		$consulta2="UPDATE users_activos SET estado='$estado'
		                             WHERE iduser='$idusers'";
    $result=mysqli_query($conexion,$consulta);
		$result2=mysqli_query($conexion,$consulta2);

    if($result){
      header("location:../interfaz/listadousuarios/lista.php");
      // echo $idusers;
      // echo $contrasena;
    }else{
      echo "no se registro nada";
    }
 ?>

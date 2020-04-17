
<?php
  session_start();
  if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
    require_once "conexion.php";
    $conexion=conexion();
        //recuperar las variables html
    $Usuario=$_POST['usuario'];
    $Contrasena=$_POST['contrasena'];
    $Rol=$_POST['inlineRadioOptions'];
    $estudio=$_POST['inlineRadioOptionss'];
    $Pre1=$_POST['pregunta1'];
    $Pre2=$_POST['pregunta2'];
    $Id='';

    $sqll = "SELECT * from users where usuario='$Usuario'";
    $result = mysqli_query($conexion, $sqll);

    if(mysqli_num_rows($result)>0){

      $mensaje = "Ya existe este usuario, intenta con otro";
          echo "<script>";
          echo "alert('$mensaje');";
          echo "window.location = '../interfaz/registro/registro.php';";
          echo "</script>";
    }else{
         $sql="INSERT INTO users VALUES ('$Id','$Usuario','$Contrasena','$Rol','$estudio')";
         }
    //ejecutamos la centencia de sql
    $ejecutar=mysqli_query($conexion, $sql);
    //verificacion de la ejecucioon
    if(!$ejecutar){
        echo"hubo algun error";
    }else{
      $busquedaid="SELECT idusers from users where usuario='$Usuario'";
      $result=mysqli_query($conexion,$busquedaid);
      while($mostrar=mysqli_fetch_array($result)){
      $mostrar['idusers'];
      $iddelusuario=$mostrar['idusers'];
      }
      $sql2="INSERT INTO preguntaseguridad VALUES ('$iddelusuario','$Pre1','$Pre2')";
      $ejecutar=mysqli_query($conexion, $sql2);
      $sql3="INSERT INTO users_activos VALUES ('$iddelusuario','1')";
      $ejecutar2=mysqli_query($conexion, $sql3);
      $sql4="INSERT INTO nivel_estudio VALUES ('$iddelusuario','$estudio')";
      $ejecutar3=mysqli_query($conexion, $sql4);

      $mensaje = "Registro exitoso";
          echo "<script>";
          echo "alert('$mensaje');";
          header("Location:../interfaz/listadousuarios/lista.php");
          echo "</script>";

      }
    } else {
    header("location:../interfaz/login/iniciologin2.php");
    }

?>﻿

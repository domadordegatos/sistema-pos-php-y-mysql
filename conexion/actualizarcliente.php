<?php
session_start();
if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
require_once "conexion.php";
 $conexion=conexion();

  $cedula = $_POST['cedula'];
   $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
     $telefono = $_POST['telefono'];

     $busquedaid="SELECT idcliente from clientes where cedula='$cedula'";
     $result=mysqli_query($conexion,$busquedaid);
     while($mostrar=mysqli_fetch_array($result)){
     $mostrar['idcliente'];
     $idcliente=$mostrar['idcliente'];
   }//buscamos el id del cliente con base a la cedula

   $sql1="SELECT * from clientes where cedula='$cedula'";
   $result3=mysqli_query($conexion,$sql1);
   if(mysqli_num_rows($result3)>0){

     $sql="UPDATE clientes SET  nombre='$nombre',
                                apellido='$apellido',
                                telefono='$telefono'
                                WHERE idcliente='$idcliente'";

    echo 1;//usuario actualizado
  }else{
    echo 2;//usuario no existe se debe agregar
  }

 $result2=mysqli_query($conexion,$sql);
 if(!$result2){
     echo"hubo algun error";
 }
   } else {
   header("location:../interfaz/login/iniciologin2.php");
   }
 ?>

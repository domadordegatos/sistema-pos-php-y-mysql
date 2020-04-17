<?php
 session_start();
 require_once "conexion.php";
 	$conexion=conexion();
 $user = $_SESSION['user'];
 $cajero=$_POST['cajero'];
 $productov=$_POST['productoVenta'];
 $categoriav=$_POST['cagetoriaV'];
 $cantidadv=$_POST['cantidadV'];
  $provedor=$_POST['provedor'];

 $sql="SELECT codigoproducto from productos WHERE codigoproducto = $productov ";
 $sql5="SELECT nombre from productos WHERE codigoproducto = $productov ";
 $sql2="SELECT categoria from productos WHERE codigoproducto = $productov ";
 $sql3="SELECT idcliente from clientes WHERE cedula = $cedula ";
 // $sql4="SELECT idusers from users WHERE usuario = $user ";
 $sql4="SELECT idusers
 from users
 where users.usuario = '$user'";
 $result4=mysqli_query($conexion,$sql4);
 while($mostrar=mysqli_fetch_array($result4)){
 $idcajero=$mostrar['idusers'];
}
 $result=mysqli_query($conexion,$sql);
 $result2=mysqli_query($conexion,$sql2);
 $result3=mysqli_query($conexion,$sql3);
 $result5=mysqli_query($conexion,$sql5);
 $codigo=mysqli_fetch_row($result)[0];
 $categoriap=mysqli_fetch_row($result2)[0];
 $cedula=mysqli_fetch_row($result3)[0];
 $nombreproducto=mysqli_fetch_row($result5)[0];


     $articulo=$codigo."||".
               $categoriap."||".
               $cantidadv."||".
               $preciov."||".
               $cedula."||".
               $nombrec."||".
               $apellidoc."||".
               $telefonoc."||".
               $idcajero."||".
               $nombreproducto."||".
               $provedor;
               $_SESSION['tablacomprastemp'][]=$articulo;

 ?>

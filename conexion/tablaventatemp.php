<?php
 session_start();
 require_once "conexion.php";
 	$conexion=conexion();
 $user = $_SESSION['user'];
 $cajero=$_POST['cajero'];
 $cedula=$_POST['cedula'];
 $nombrec=$_POST['nombre'];
 $apellidoc=$_POST['apellido'];
 $telefonoc=$_POST['telefono'];
 $productov=$_POST['productoVenta'];
 $categoriav=$_POST['cagetoriaV'];
 $cantidadv=$_POST['cantidadV'];
 $preciov=$_POST['precioV'];

 $sql="SELECT codigoproducto from productos WHERE codigoproducto = $productov ";
 $sql5="SELECT nombre from productos WHERE codigoproducto = $productov ";
 $sql2="SELECT categoria from productos WHERE codigoproducto = $productov ";
 $sql3="SELECT idcliente from clientes WHERE cedula = $cedula ";
 $sql6="SELECT stock from productos WHERE codigoproducto = $productov ";
 // $sql4="SELECT idusers from users WHERE usuario = $user ";
 $sql4="SELECT idusers
 from users
 where users.usuario = '$user'";
 $result4=mysqli_query($conexion,$sql4);
 while($mostrar=mysqli_fetch_array($result4)){
 $idcajero=$mostrar['idusers'];
}
 $result=mysqli_query($conexion,$sql);
 $result6=mysqli_query($conexion,$sql6);
 while($ver=mysqli_fetch_array($result6)){
 $cantididadproductos=$ver['stock'];
}

 $result2=mysqli_query($conexion,$sql2);
 $result3=mysqli_query($conexion,$sql3);
 $result5=mysqli_query($conexion,$sql5);
 $codigo=mysqli_fetch_row($result)[0];
 $categoriap=mysqli_fetch_row($result2)[0];
 $cedula=mysqli_fetch_row($result3)[0];
 $nombreproducto=mysqli_fetch_row($result5)[0];
 if($cantidadv > $cantididadproductos){
   echo 5;
 }else{
     $articulo=$codigo."||".
               $categoriap."||".
               $cantidadv."||".
               $preciov."||".
               $cedula."||".
               $nombrec."||".
               $apellidoc."||".
               $telefonoc."||".
               $idcajero."||".
               $nombreproducto;
               $_SESSION['tablacomprastemp'][]=$articulo;

 echo 1;
   }
 ?>

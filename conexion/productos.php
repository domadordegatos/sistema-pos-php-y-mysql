<?php
require_once "conexion.php";
$conexion=conexion();
 class productos{


public function insertarproducto($datos){
  require_once "conexion.php";
  $conexion=conexion();
  $id='';
  $sql1="SELECT * from productos where nombre = '$datos[0]'";
  $result=mysqli_query($conexion,$sql1);
  if(mysqli_num_rows($result)>0){
   return 0;//producto existente. no se puede agregar
}else{
  $sql="INSERT INTO productos (codigoproducto,
                               nombre,
                               categoria,
                               stock,
                               precio)
                    VALUES  ('$id',
                             '$datos[0]',
                             '$datos[1]',
                             '$datos[2]',
                             '$datos[3]')";
              return mysqli_query($conexion,$sql);
}
}
      public function obtenerdatosproducto($idarticulo){
        require_once "conexion.php";
        $conexion=conexion();
        $sql="SELECT codigoproducto, nombre, categoria, stock, precio
        from productos WHERE codigoproducto = '$idarticulo'";
        $result=mysqli_query($conexion,$sql);

        $ver=mysqli_fetch_row($result);
        $datos=array( "codigoproducto" => $ver[0],
                      "nombre" => $ver[1],
                      "categoria" => $ver[2],
                      "stock" => $ver[3],
                      "precio" => $ver[4]
                    );
                    return $datos;
      }
      public function actualizarproducto($datos){
        require_once "conexion.php";
        $conexion=conexion();
        $sql="UPDATE productos set nombre='$datos[1]',
                                   categoria='$datos[2]',
                                   stock='$datos[3]',
                                   precio='$datos[4]'
                               WHERE codigoproducto='$datos[0]'";
                  return mysqli_query($conexion,$sql);
      }
      public function eliminarproducto($idarticulo){
        require_once "conexion.php";
        $conexion=conexion();
        $sql="DELETE from productos
                     where codigoproducto = '$idarticulo'";
              return mysqli_query($conexion,$sql);
      }
}
 ?>

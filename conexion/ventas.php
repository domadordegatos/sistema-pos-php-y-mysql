<?php
  class ventas{
    public function obtenerproducto($idproducto){
      require_once "conexion.php";
      $conexion=conexion();
      $sql="SELECT codigoproducto,
                   nombre,
                   categoria,
                   stock,
                   precio FROM productos WHERE codigoproducto = '$idproducto'";

            $result=mysqli_query($conexion,$sql);
            $ver=mysqli_fetch_row($result);
            $datos=array(
             'nombre' => $ver[1],
             'categoria' => $ver[2],
             'stock' => $ver[3],
             'precio' => $ver[4]
           );
           return $datos;
    }
    public function crearventa(){
      require_once "conexion.php";
      $conexion=conexion();

      $fecha=date('Y-m-d');
      $idventa=self::crearfolio();
      $datos=$_SESSION['tablacomprastemp'];
      $r=0;
      for ($i=0; $i < count($datos) ; $i++) {
        $d=explode("||", $datos[$i]);
        $sql="INSERT INTO reportes_ingresos_aulas (id_reporte,
                                                   id_ingreso,
                                                   id_admin,
                                                   tipo_reporte,
                                                   hora,
                                                   fecha)
                          values ('$idventa',
                                  '$d[0]',
                                  '$d[1]',
                                  '$d[3]',
                                  '$d[2]',
                                  '$d[4]',
                                  '$d[8]',
                                  '$fecha')";
          $r=$r + $result=mysqli_query($conexion,$sql);
          self::descontar($d[0],$d[2]);
      }
      return $r;
    }
    public function descontar($idproducto,$cantidad){
      require_once "conexion.php";
      $conexion=conexion();
      $sql="SELECT stock from productos where codigoproducto = '$idproducto'";
      $result=mysqli_query($conexion,$sql);
      $cantidad1=mysqli_fetch_row($result)[0];
      $cantidadnueva=abs($cantidad - $cantidad1);
      $sql="UPDATE productos set stock='$cantidadnueva'
      where codigoproducto = '$idproducto'";
      $result=mysqli_query($conexion,$sql);
    }


    public function crearfolio(){
      require_once "conexion.php";
      $conexion=conexion();
      $sql="SELECT idventa from facturas group by idventa desc";
      $result=mysqli_query($conexion,$sql);
      $id=mysqli_fetch_row($result)[0];
      if($id=="" or $id==null or $id==0){
        return 1;
      }else{
        return $id + 1;
      }
    }
    public function cedulacliente($cedulacliente){
      require_once "conexion.php";
      $conexion=conexion();
		 $sql="SELECT nombre, apellido
			from clientes
			where idcliente ='$cedulacliente'";

		    $result=mysqli_query($conexion,$sql);
		    $ver=mysqli_fetch_row($result);
		    return $ver[0]." ".$ver[1];
	}

  public function obtenertotal($idventa){
    require_once "conexion.php";
    $conexion=conexion();
		$sql="SELECT precio, cantidad
				  from facturas
				  where idventa='$idventa'";

		$result=mysqli_query($conexion,$sql);
		$total=0;
		while($ver=mysqli_fetch_row($result)){
      $pago=$ver[0] * $ver[1];
			$total=$total + $pago;
		}
		return $total;
	}

  }
 ?>

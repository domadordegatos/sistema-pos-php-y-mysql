<?php
require_once "../../../conexion/solicitudes.php";
require_once "../../../conexion/conexion.php";
$conexion=conexion();

$obj= new ventas();
$sql ="SELECT idsolicitud, fecha, cajero, count(cantidad), sum(cantidad)
from solicitudes_proveedores group by idsolicitud";
$result=mysqli_query($conexion,$sql);
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width:device-width, initial-scale=1">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <link rel="stylesheet" href="../../../diseño/bootstrap.css" type="text/css">
    <title>Facturacion</title>
  </head>
  <body>
    <div class="contenedor">
      <div class="inline">
        <h4 class="text-white">Registro de Solicitudes</h4>
        <a href="../../inicio/inicio.php" class="btn btn-outline-primary">Volver</a>
      </div>

         <div class="row">
         	<div class="col-sm-1"></div>
         	<div class="col-sm-10">
         		<div class="table-responsive">
              <caption><label class="text-white">Listado</label></caption>
         			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
         				<tr class="text-white">
         					<td>#Factura</td>
         					<td>Fecha</td>
         					<td>Cajero</td>
                  <td>Cantidad Solicitada</td>
                  <td>Unidades Solicitadas</td>
         					<td>Solicitud Pdf</td>
         				</tr>
                <?php while ($ver=mysqli_fetch_row($result)): ?>
                <tr>
                  <td class="text-white"><?php echo $ver[0]; ?></td>
                  <td><?php echo $ver[1]; ?></td>
                  <td><?php if ($obj->cedulacliente($ver[2])==" ") {
                    echo "----SC----";
                  }else{
                    echo $obj->cedulacliente($ver[2]);
                  }
                   ?></td>
                   <td><?php echo $ver[3]; ?></td>
                    <td><?php echo $ver[4]; ?></td>

                  <td> <a href="../../../conexion/solicitudpdf.php?idventa=<?php echo $ver[0] ?>" class="btn btn-success btn-xs">Solicitud</a> </td>
                </tr>
              <?php endwhile; ?>
                </table>

                  </div>
                </div>
                <div class="sol-sm-1">  </div>
    </div>

    <form class="contenedor2" action="">
    </form>
    </div>


  </body>
</html>

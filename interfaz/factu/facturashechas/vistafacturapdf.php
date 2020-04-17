<?php
require_once "../../../conexion/conexion.php";
require_once "../../../conexion/ventas.php";
$objv= new ventas();
$conexion=conexion();
   $idventa= $_GET['idventa'];
$sql="SELECT     productos.nombre,
                 productos.categoria,
                 productos.precio,
                 facturas.fecha,
                 facturas.cantidad,
                 facturas.idventa,
                 facturas.cedulacliente,
                 clientes.cedula,
                 clientes.telefono,
                 users.usuario
                FROM facturas AS facturas
					      INNER JOIN clientes AS clientes ON facturas.cedulacliente = clientes.idcliente
                INNER JOIN productos AS productos ON facturas.producto = productos.codigoproducto
                INNER JOIN users AS users ON facturas.cajero = users.idusers
                AND facturas.idventa = '$idventa'";
                $result=mysqli_query($conexion,$sql);
                $ver=mysqli_fetch_row($result);
                $numfactu=$ver[5];
                $fecha=$ver[3];
                $idcliente=$ver[6];
                $cedula=$ver[7];
                $telefono=$ver[8];
                $cajero=$ver[9];


 ?>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Factura venta</title>
     <link rel="stylesheet" href="../../../diseño/bootstrap.css" type="text/css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
     <h3 style="text-align:center;">SUPER MARKET PLASITA CAMPESINA</h3>
     <img src="../../../diseño/imagenes/carrito.png" width="">
     <br>
     <table class="table">
       <tr>
         <td>Fecha: <?php echo $fecha; ?></td>
       </tr>
       <tr>
         <td>#Factura: <?php echo $numfactu; ?></td>
       </tr>
       <tr>
         <td>Cajero: <?php echo $cajero; ?></td>
       </tr>
     </table>
     <table class="table">
       <tr>
         <td>Cliente: <?php echo $objv->cedulacliente($idcliente); ?></td>
         <td>Celular: <?php echo $telefono;?></td>
         <td>Cedula: <?php echo $cedula; ?></td>
       </tr>
     </table>
     <table class="table table-bordered">
       <tr>
         <td>Nombre producto</td>
         <td>Categoria</td>
         <td>Precio Unidad</td>
         <td>Cantidad</td>
         <td>U x C</td>
       </tr>

       <?php
       $sql="SELECT     productos.nombre,
                        productos.categoria,
                        productos.precio,
                        facturas.fecha,
                        facturas.cantidad,
                        facturas.idventa,
                        facturas.cedulacliente,
                        clientes.cedula,
                        clientes.telefono,
                        users.usuario
                       FROM facturas AS facturas
       					      INNER JOIN clientes AS clientes ON facturas.cedulacliente = clientes.idcliente
                       INNER JOIN productos AS productos ON facturas.producto = productos.codigoproducto
                       INNER JOIN users AS users ON facturas.cajero = users.idusers
                       AND facturas.idventa = '$idventa'";
                       $result=mysqli_query($conexion,$sql);
                       $total=0;
                       while($mostrar=mysqli_fetch_row($result)):
                         $uxc=$mostrar[2]*$mostrar[4];
        ?>
       <tr>
         <td><?php echo $mostrar[0]; ?></td>
         <td><?php echo $mostrar[1]; ?></td>
         <td><?php echo "$".$mostrar[2]; ?></td>
         <td><?php echo $mostrar[4]; ?></td>
         <td><?php echo "$".$uxc; ?></td>
       </tr>
     <?php
     $total=$total+$uxc;
   endwhile; ?>
     <td style="text-align:right;" class="table-warning" colspan="5">Total: <?php echo "$".$total; ?>.............</td>

     </table>
   </body>
 </html>

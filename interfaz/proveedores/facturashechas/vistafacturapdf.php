<?php
require_once "../../../conexion/conexion.php";
require_once "../../../conexion/solicitudes.php";
$objv= new ventas();
$conexion=conexion();
   $idventa= $_GET['idventa'];
$sql="SELECT     solicitudes_proveedores.fecha,
                 solicitudes_proveedores.idsolicitud,
                 users.usuario
                FROM solicitudes_proveedores AS solicitudes_proveedores
                INNER JOIN users AS users ON solicitudes_proveedores.cajero = users.idusers
                AND solicitudes_proveedores.idsolicitud = '$idventa'";
                $result=mysqli_query($conexion,$sql);
                $ver=mysqli_fetch_row($result);
                $numfactu=$ver[1];
                $fecha=$ver[0];
                $cajero=$ver[2];


 ?>
 <html lang="es" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Factura venta</title>
     <link rel="stylesheet" href="../../../diseño/bootstrap.css" type="text/css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
     <h3 style="text-align:center;">SOLICITUD DE PRODUCTOS</h3>

     <br>
     <table class="table">
       <tr>
         <td>Fecha: <?php echo $fecha; ?></td>
       </tr>
       <tr>
         <td>#Solicitud: <?php echo $numfactu; ?></td>
       </tr>
       <tr>
         <td>Cajero: <?php echo $cajero; ?></td>
       </tr>
     </table>
     <p>ASUNTO: SOLICITUD DE PRODUCTOS</p>
     <p>EMPRESA: PLACITA CAMPESINA</p><br>
     <p>Empresa proveedora de productos</p>
     <p>Coordial saludo por medio de la presente solicitud #<?php echo $numfactu; ?> me permito yo trabajador de la empresa placita campesina identificado con el usuario <?php echo $cajero;  ?> hacer la solicitud de los siguientes productos que tenemos en escasez.</p>
     <p>Necesitamos la siguiente tabla de productos lo antes posible</p>
     <table class="table table-bordered">
       <tr class="table-success">
         <td>Nombre producto</td>
         <td>Categoria</td>
         <td>Cantidad</td>
       </tr>

       <?php
       $sql="SELECT     productos.nombre,
                        productos.categoria,
                        productos.precio,
                        solicitudes_proveedores.fecha,
                        solicitudes_proveedores.cantidad,
                        solicitudes_proveedores.idsolicitud,
                        users.usuario
                       FROM solicitudes_proveedores AS solicitudes_proveedores
                       INNER JOIN productos AS productos ON solicitudes_proveedores.idproducto = productos.codigoproducto
                       INNER JOIN users AS users ON solicitudes_proveedores.cajero = users.idusers
                       AND solicitudes_proveedores.idsolicitud = '$idventa'";
                       $result=mysqli_query($conexion,$sql);
                       while($mostrar=mysqli_fetch_row($result)):
        ?>
       <tr>
         <td><?php echo $mostrar[0]; ?></td>
         <td><?php echo $mostrar[1]; ?></td>
         <td><?php echo $mostrar[4]; ?></td>
       </tr>
     <?php
   endwhile; ?>
     </table>
     <p>Esperamos poder contar con ustedes para la compra de estos productos</p>
     <p>Agradecemos su atencion</p>
     <br><br>
     <p>Atentamente</p>
     <br><br>
     <p>placita campesina</p>
     <p>nit:900221418-5</p>
   </body>
 </html>

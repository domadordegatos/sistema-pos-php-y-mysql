<?php
session_start();
// print_r($_SESSION['tablacomprastemp']);
 ?>
 <link rel="stylesheet" href="estilo.css" type="text/css">
 <div class="linea">
   <h4 id="t1">Hacer venta</h4>
   <caption id="t2">
   <span class="btn btn-success" onclick="crearventa()">$ Generar pago
   </span>
   </caption>
 </div>
 <h4> <div id="nombreclientev"></div>
<table class="table table-bordered table-hover table-condensed" style="text-align:center;">

<tr class="bg-success">
   <td>Producto</td>
   <td>Categoria</td>
   <td>Cantidad</td>
   <td>Precio U.</td>
   <td>Pago</td>
   <td>Eliminar</td>
</tr>
<?php
$totalp=0;
if (isset($_SESSION['tablacomprastemp'])):
  $i=0;
  foreach (@$_SESSION['tablacomprastemp'] as $key) {

  $dat=explode("||", $key)

 ?>
<tr>
  <?php
   $preciopagar=$dat[2] * $dat[3];
   ?>
   <td><?php echo $dat[9] ?></td>
   <td><?php echo $dat[1] ?></td>
   <td><?php echo $dat[2] ?></td>
   <td><?php echo $dat[3] ?></td>
   <td><?php echo $preciopagar ?></td>
   <td> <span  id="cierre" class="btn btn-danger btn-xs" onclick="quitarproducto('<?php echo $i; ?>')">
  <span class="">x</span></span> </td>
</tr>
<?php
$totalp = $totalp + $preciopagar;
$i++;
}
endif;
  ?>
  <tr>
    <td style="text-align:left;" class="table-warning" colspan="6">Total Compra: <?php echo "$".$totalp; ?></td>
  </tr>
</table>
 </h4>

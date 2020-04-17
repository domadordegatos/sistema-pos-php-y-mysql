<?php
session_start();
// print_r($_SESSION['tablacomprastemp']);
 ?>
 <link rel="stylesheet" href="estilo.css" type="text/css">
 <div class="linea">
   <h4 id="t1">Lista de solicitudes</h4>
   <caption id="t2">
   <span class="btn btn-danger" onclick="crearventa()">Generar Solicitud
   </span>
   </caption>
 </div>
 <h4> <div id="nombreclientev"></div>
<table class="table table-bordered table-hover table-condensed" style="text-align:center;">

<tr class="bg-danger">
   <td>Producto</td>
   <td>Categoria</td>
   <td>Cantidad</td>
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
   <td><?php echo $dat[9] ?></td>
   <td><?php echo $dat[1] ?></td>
   <td><?php echo $dat[2] ?></td>
   <td> <span  id="cierre" class="btn btn-success btn-xs" onclick="quitarproducto('<?php echo $i; ?>')">
  <span class="">x</span></span> </td>
</tr>
<?php
}
endif;
  ?>
</table>
 </h4>

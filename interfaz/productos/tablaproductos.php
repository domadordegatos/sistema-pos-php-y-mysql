<?php
require_once "../../conexion/conexion.php";
$conexion=conexion();
$sql="SELECT codigoproducto, nombre, categoria, stock, precio
             from productos order by codigoproducto desc";
 $result=mysqli_query($conexion,$sql);
 ?>
<table class="table table-hover table-condensed table-bordered" style="text-align: center;">

  <tr class="text-white">
    <td>Nombre</td>
    <td>Categoria</td>
    <td>Stock</td>
    <td>Precio</td>
    <td>Editar</td>
    <td>Eliminar</td>
  </tr>
  <?php while ($ver=mysqli_fetch_row($result)): ?>
  <tr>
    <!-- <td><?php echo $ver[0]; ?></td> -->
    <td><?php echo $ver[1]; ?></td>
    <td><?php echo $ver[2]; ?></td>
    <?php if($ver[3] < 40){
      echo "<td class='bg-danger'> $ver[3]</td>";
    }else{
      echo "<td> $ver[3]</td>";
    }
        ?>
    <!-- <td><?php echo $ver[3]; ?></td> -->
    <td><?php echo $ver[4]; ?></td>
    <td> <span data-toggle="modal" data-target="#abremodalactualizacion" class="btn btn-warning" onclick="actualizardatosproducto('<?php echo $ver[0]; ?>')">Actualizar</span> </td>
    <td> <span class="btn btn-danger" onclick="eliminarproducto('<?php echo $ver[0]; ?>')" >Borrar</span> </td>
  </tr>
<?php endwhile; ?>
</table>

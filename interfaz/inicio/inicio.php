<!-- <?php
	session_start();
	if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    require_once "../../conexion/conexion.php";
    $conexion=conexion();
 ?> -->
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <title>inicio admin</title>
  </head>
  <body>

<div class="login">
  <table class="table table-success rounded">
    <?php
    $sql="SELECT users.usuario, users.rol
    from users
    where users.usuario = '$user'";
    $result=mysqli_query($conexion,$sql);
    while($mostrar=mysqli_fetch_array($result)){
    ?>
    <!--  consulta arriba y muestra abajo-->
    <tr>
    <td class="table-success"><?php echo $mostrar['usuario'] ?></td>
    <td class="table-success"><?php echo $mostrar['rol'];
		$mostrar['rol'];
		$rol=$mostrar['rol']; ?></td>
    <td><form class="form" action="../../conexion/salir.php" method="post"><button class="btn btn-dark" type="submit">Logout</button></form></td>
    </tr>
<?php
}
?>
</table>
</div>
    <div class="" id="total">
<?php echo " <h1 class='text-white text-uppercase'>MENU DEL $rol </h1>";  ?>
<div class='total'>
	<div class='uno'>
		<?php
echo "	<div class='btn-group'>";
echo "		<button type='button' class='btn btn-warning'>INVENTARIO</button>";
echo "		<button type='button' class='btn btn-warning dropdown-toggle dropdown-toggle-split' data-toggle='dropdown'>";
echo "		</button>";
echo "		<div class='dropdown-menu'>";
echo "			<a class='dropdown-item' href='../productos/productos.php'>Agregado y listado de productos</a>";
if($rol=='admin' or $rol=='supervisor'){
echo "			<a class='dropdown-item' href='#'></a>";
}
echo "		</div>";
echo "	</div>";

echo "	<div class='btn-group'>";
echo "		<button type='button' class='btn btn-danger'>USUARIOS</button>";
echo "		<button type='button' class='btn btn-danger dropdown-toggle dropdown-toggle-split' data-toggle='dropdown'>";
echo "		</button>";
echo "		<div class='dropdown-menu'>";
echo "			<a class='dropdown-item' href='../listadousuarios/lista.php'>Listado de usuarios</a>";
if($rol=='admin' or $rol=='supervisor'){
echo "			<a class='dropdown-item' href='../registro/registro.php'>Agregar usuario</a>";
}
echo "		</div>";
echo "	</div>";
		?>
		<div class='btn-group'>
			<button type='button' class='btn btn-success'>FACTURACION</button>
			<button type='button' class='btn btn-success dropdown-toggle dropdown-toggle-split' data-toggle='dropdown'>
			</button>
			<div class='dropdown-menu'>
				<a class='dropdown-item' href='../factu/ingreso/ingreso.php'>Hacer venta</a>
				<a class='dropdown-item' href='../factu/facturashechas/facturas.php'> Listado de facturas</a>
			</div>
		</div>

	</div>
	<div class='btn-group'>
		<button type='button' class='btn btn-light'>PROVEEDORES</button>
		<button type='button' class='btn btn-light dropdown-toggle dropdown-toggle-split' data-toggle='dropdown'>
		</button>
		<div class='dropdown-menu'>
			<a class='dropdown-item' href='../proveedores/facturacionregistrado/facturacion.php'>Solicitud de productos</a>
			<a class='dropdown-item' href='../proveedores/facturashechas/facturas.php'>Lista de solicitudes</a>
		</div>
	</div>


    </div>

  </body>
</html>
<!-- <?php
} else {
	header("location:../interfaz/login/iniciologin2.php");
	}
 ?> -->

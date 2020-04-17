<?php
	session_start();
	if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    require_once "../../conexion/conexion.php";
    $conexion=conexion();

 ?>
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
    <title>USERS</title>
  </head>
  <body>
    <div class="login">
      <table border="1" class="table table-hover table-dark">
        <?php
        $sql="SELECT users.usuario, users.rol
        from users
        where users.usuario = '$user'";
        $result=mysqli_query($conexion,$sql);
        while($mostrar=mysqli_fetch_array($result)){
				$rol=$mostrar['rol'];
				// consultar el rol para la redireccion
        ?>
        <!--  consulta arriba y muestra abajo-->
        <tr>
        <td><?php echo $mostrar['usuario'] ?></td>
        <td><?php echo $mostrar['rol'] ?></td>
        <td><form class="form" action="../../conexion/salir.php" method="post"><button class="btn btn-dark" type="submit">Logout</button></form></td>
        </tr>
    <?php
    }
    ?>
    </table>
    </div>

    <div class="contenedor">
      <h1 id="titulo" class="text-white">LISTADO DE USUARIOS</h1>

<?php
    if($rol === 'admin'){
      echo "  <table border='1' class='table table-hover table-dark'>";
			echo "<tr>";
			echo "<td>Id Usuario</td>";
			echo "<td>Usuario</td>";
			echo "<td>Contraseña</td>";
			echo "<td>Rol</td>";
			echo "<td>Estado</td>";
			echo "<td>Acciones</td>";
			echo "</tr>";

  $sql="SELECT users.idusers, users.usuario,
               users.contrasena, users.rol, users_activos.estado
               FROM users AS users
               INNER JOIN users_activos AS users_activos ON users.idusers = users_activos.iduser";
  $result=mysqli_query($conexion,$sql);

    while($mostrar=mysqli_fetch_assoc($result)){
			if($mostrar['estado']==1){
				$estado='Activo';
			}else{
				$estado='Inactivo';
			}
					echo "<tr class='alinearizquierda'>";
					echo "<td>"; echo $mostrar['idusers']; echo "</td>";
					echo "<td>"; echo $mostrar['usuario']; echo "</td>";
					echo "<td>"; echo $mostrar['contrasena']; echo "</td>";
					echo "<td>"; echo $mostrar['rol']; echo "</td>";
					echo "<td>"; echo $estado; echo "</td>";
					echo "<td class='accion'> <a href='../resetcontrasena/reset.php?idusers=".$mostrar['idusers']."'> <button type='button' class='btn btn-warning'>Modificar</button></a> ";
          echo "</tr>";
}
}
//  lista admin

if($rol === 'supervisor'){
	echo "  <table border='1' class='table table-hover table-dark'>";
	echo "<tr>";
	echo "<td>Id Usuario</td>";
	echo "<td>Usuario</td>";
	echo "<td>Contraseña</td>";
	echo "<td>Rol</td>";
	echo "<td>Estado</td>";
	echo "<td>Acciones</td>";
	echo "</tr>";

$sql="SELECT users.idusers, users.usuario,
						 users.contrasena, users.rol, users_activos.estado
						 FROM users AS users
						 INNER JOIN users_activos AS users_activos ON users.idusers = users_activos.iduser
						 WHERE rol='supervisor' or rol='cajero' order by rol";
$result=mysqli_query($conexion,$sql);

while($mostrar=mysqli_fetch_assoc($result)){
	if($mostrar['estado']==1){
		$estado='Activo';
	}else{
		$estado='Inactivo';
	}
			echo "<tr class='alinearizquierda'>";
			echo "<td>"; echo $mostrar['idusers']; echo "</td>";
			echo "<td>"; echo $mostrar['usuario']; echo "</td>";
			echo "<td>"; echo $mostrar['contrasena']; echo "</td>";
			echo "<td>"; echo $mostrar['rol']; echo "</td>";
			echo "<td>"; echo $estado; echo "</td>";
			echo "<td class='accion'> <a href='../resetcontrasena/reset.php?idusers=".$mostrar['idusers']."'> <button type='button' class='btn btn-warning'>Modificar</button></a> ";
			echo "</tr>";
}
}


//  lista supervisor

if($rol === 'cajero'){
	echo "  <table border='1' class='table table-hover table-dark'>";
	echo "<tr>";
	echo "<td>Id Usuario</td>";
	echo "<td>Usuario</td>";
	echo "<td>Rol</td>";
	echo "<td>Estado</td>";
	echo "<td>Acciones</td>";
	echo "</tr>";

  $sql="SELECT users.idusers, users.usuario,
							 users.contrasena, users.rol, users_activos.estado
							 FROM users AS users
							 INNER JOIN users_activos AS users_activos ON users.idusers = users_activos.iduser
							 WHERE rol='cajero' order by rol";
$result=mysqli_query($conexion,$sql);

while($mostrar=mysqli_fetch_assoc($result)){
	if($mostrar['estado']==1){
		$estado='Activo';
	}else{
		$estado='Inactivo';
	}
			echo "<tr class='alinearizquierda'>";
			echo "<td>"; echo $mostrar['idusers']; echo "</td>";
			echo "<td>"; echo $mostrar['usuario']; echo "</td>";
			echo "<td>"; echo $mostrar['rol']; echo "</td>";
		  echo "<td>"; echo $estado; echo "</td>";
			// echo "<td class='accion'> <a href='../resetcontrasena/reset.php?idusers=".$mostrar['idusers']."'> <button type='button' class='btn btn-warning'>Modificar</button></a> a href='pagina de edicion'> <button type='button' class='btn btn-light'>Eliminar User</button></a></td>";
			echo "</tr>";
}
}

// lista cajero
?>
</table>
<br>
<div class="form-inline">
	<form class="contenedor2" action="../inicio/inicio.php" method="post">
		<div id="boton2" class="form-group">
			<input id="botonn" type="submit" name="" value="Volver" class="btn btn-primary">
		</div>
	</form>
	<?php
	if($rol === 'admin' or $rol === 'supervisor'){
	echo "	<form class='contenedor2' action='../registro/registro.php'>";
	echo "		<div id='boton2' class='form-group'>";
	echo "			<input id='botonn' type='submit' value='Agregar usuario' class='btn btn-success'>";
	echo "		</div>";
	echo "	</form>";
}
	 ?>
</div>
    </div>

  </body>
</html>
<?php
 }else{
	header("location:../interfaz/login/iniciologin2.php");
	}
 ?>

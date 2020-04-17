<?php
	session_start();
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
    require_once "../../conexion/conexion.php";
    $conexion=conexion();

		$experimentorol="SELECT rol from users where usuario='$user'";
		$result=mysqli_query($conexion,$experimentorol);
		$mostrar=mysqli_fetch_assoc($result);
		$rol=$mostrar['rol'];
		// consultar el rol para la redireccion
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width:device-width, initial-scale=1">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <link rel="stylesheet" href="../../diseño/bootstrap.css" type="text/css">
    <title>Registro</title>
  </head>
  <body>

    <div class="contenedor">
        <h1 class="text-muted">Registro de usuarios</h1>
      <form class="form" action="../../conexion/registro.php" method="POST">

        <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label text-white">Usuario</label>
        <div class="col-sm-10">
          <input type="text" name="usuario" value="" placeholder="Digite su usuario" required class="form-control" >
        </div>
            </div>
						<?php
						if($rol === 'admin' or $rol === 'supervisor'){
						echo "<div class='form-check form-check-inline'>";
						echo "<input class='form-check-input' type='radio' name='inlineRadioOptionss' id='inlineRadioOptionss' value='1'>";
						echo "<label class='form-check-label text-white' for='inlineRadio1'>Pregrado</label>";
						echo "</div>";
						echo "<div class='form-check form-check-inline'>";
						echo "<input class='form-check-input' type='radio' name='inlineRadioOptionss' id='inlineRadioOptionss' value='2'>";
						echo "<label class='form-check-label text-white' for='inlineRadio2'>Especializacion</label>";
						echo "</div>";
						echo "<div class='form-check form-check-inline'>";
						echo "<input class='form-check-input' type='radio' name='inlineRadioOptionss' id='inlineRadioOptionss' value='3' >";
						echo "<label class='form-check-label text-white' for='inlineRadio3'>Maestria</label>";
						echo "</div>";
						} ?>


            <div class="form-group row">
              <label for="contrasena" class="col-sm-2 col-form-label text-white">Contraseña</label>
              <div class="col-sm-10">
                <input type="password" name="contrasena" value="" placeholder="Digite su contraseña" required class="form-control">
              </div>
            </div><br>
            <div class="rolusuario">

             <label for="rolusuario" class="col-sm-2 col-form-label text-white">Seleccione el rol</label>
						 <?php
						 if($rol === 'admin'){
						 echo "<div class='form-check form-check-inline'>";
						 echo "<input class='form-check-input' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='admin'>";
						 echo "<label class='form-check-label text-white' for='inlineRadio1'>Admin</label>";
						 echo "</div>";
						 echo "<div class='form-check form-check-inline'>";
						 echo "<input class='form-check-input' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='supervisor'>";
						 echo "<label class='form-check-label text-white' for='inlineRadio2'>Supervisor</label>";
						 echo "</div>";
						 echo "<div class='form-check form-check-inline'>";
						 echo "<input class='form-check-input' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='cajero' >";
						 echo "<label class='form-check-label text-white' for='inlineRadio3'>Cajero</label>";
						 echo "</div>";
					   }
						 if($rol === 'supervisor'){
						 echo "<div class='form-check form-check-inline'>";
						 echo "<input class='form-check-input' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='supervisor'>";
						 echo "<label class='form-check-label text-white' for='inlineRadio2'>Supervisor</label>";
						 echo "</div>";
						 echo "<div class='form-check form-check-inline'>";
						 echo "<input class='form-check-input' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='cajero' >";
						 echo "<label class='form-check-label text-white' for='inlineRadio3'>Cajero</label>";
						 echo "</div>";
					   }
						  ?>

              <br><br>
              <div class="form-group row">
                <label for="pregunta1" class="col-sm-2 col-form-label text-white">Pregunta de seguridad #1</label>
                <div class="col-sm-10">
                  <input type="text" name="pregunta1" value="" placeholder="Que animal fue tu primer mascota" required class="form-control">
                </div>
              </div>

            </div>

            <div class="form-group row">
              <label for="pregunta2" class="col-sm-2 col-form-label text-white">Pregunta de seguridad #2</label>
              <div class="col-sm-10">
                <input type="text" name="pregunta2" value="" placeholder="Nombre de tu primer maestra" required class="form-control">
              </div>
            </div>

            <div id="boton" class="form-group">
              <input id="botonn" type="submit" name="" value="Enviar" class="btn btn-secondary">
            </div>

      </form>
      <form class="contenedor2" action="../inicio/inicio.php" method="post">
        <div id="boton" class="form-group">
          <input id="botonn" type="submit" name="" value="Volver" class="btn btn-primary"  >
        </div>
      </form>
    </div>
  </body>
</html>
<?php
} else {
	header("location:../interfaz/login/iniciologin2.php");
	}
 ?>

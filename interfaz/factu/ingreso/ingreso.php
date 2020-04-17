<?php
	session_start();
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
    require_once "../../../conexion/conexion.php";
    $conexion=conexion();

		$experimentorol="SELECT rol from users where usuario='$user'";
		$result=mysqli_query($conexion,$experimentorol);
		$mostrar=mysqli_fetch_assoc($result);
		// consultar el rol para la redireccion
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width:device-width, initial-scale=1">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <link rel="stylesheet" href="../../../diseño/bootstrap.css" type="text/css">
    <title>validacion</title>
  </head>
  <body>

    <div class="contenedor">
        <h1 class="text-white">INGRESE NUMERO DE CEDULA</h1>
      <form class="form" action="../../../conexion/validaciondecedula.php" method="POST">

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="number" name="cedula" id="cedula" value="" maxlength="15" pattern="[0-9]+" placeholder="Numero de cedula" required class="form-control">
              </div>
            </div>

            <div id="boton" class="form-group">
              <input id="botonn" type="submit" name="" value="Enviar" class="btn btn-secondary">
            </div>

      </form>
      <form class="contenedor2" action="../../inicio/inicio.php" method="post">
        <!--  funciona la rediccion de usuario-->
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

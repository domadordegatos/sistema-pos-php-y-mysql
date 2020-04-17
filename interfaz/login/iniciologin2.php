<!DOCTYPE html>
<html>
<head>
  <title>S.P</title>
      <meta name="viewport" content="width:device-width, initial-scale=1">
      <link rel="stylesheet" href="./estilologin.css" type="text/css">
      <link rel="stylesheet" href="../../diseño/bootstrap.css" type="text/css">
      <?php require_once "scripts.php"; ?>

</head>
<body>
  <div class="form-group" id="titulo" >
    <h1 class="text-primary bg-dark">Sistema Pos</h1>
  </div>

  <div class="contenedor">
    <form class="form" action="../../conexion/login.php" method="POST">

      <div class="form-group">
        <input type="text" id="usuario" placeholder="Digite su usuario" required class="form-control" maxlength="40" pattern="[A-Za-z0-9]+">
      </div>
      <div class="form-group">
        <input type="password" id="password" placeholder="Digite su contraseña" required class="form-control" maxlength="40" pattern="[A-Za-z0-9]+">
      </div>
      <form class="contenedor2" action="../formularioreset/registro.php" method="post">
         <p class="text-white-50">¿Olvidaste tu contraseña? <a class="text-primary" href="../formularioreset/registro.php">Olvide mi contraseña</a> </p>
      </form>
      <div class="form-group" id="boton">
        <input id="entrarSistema" type="submit" value="Enviar" class="btn btn-light">
      </div>

    </form>

  </div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){
			if($('#usuario').val()==""){
				alertify.alert("Debes agregar el usuario");
				return false;
			}else if($('#password').val()==""){
				alertify.alert("Debes agregar la contraseña");
				return false;
			}

			cadena="usuario=" + $('#usuario').val() +
					"&password=" + $('#password').val();

					$.ajax({
						type:"POST",
						url:"../../conexion/login.php",
						data:cadena,
						success:function(r){
							     if(r==1){
								window.location="../inicio/inicio.php";
							}
              else if(r==4){
								alertify.alert("Usted es un usuario inactivo, llame a soporte para que lo activen");
                return false;
              }	else{
                alertify.alert("El usuario o la contraseña estan mal escritos, o no existen, por favor intentalo nuevamente, registrate o contacta a soporte");
                return false;
              }
						}
					});
		});
	});
</script>

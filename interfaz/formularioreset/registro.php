<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width:device-width, initial-scale=1">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <link rel="stylesheet" href="../../diseño/bootstrap.css" type="text/css">
    <?php require_once "scripts.php"; ?>
    <title>Reset</title>
  </head>
  <body>

    <div class="contenedor">
        <h1 class="text-muted">Reset de contraseña</h1>
      <form class="form" action="../../conexion/formularioreset.php" method="POST">

        <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label text-white">Usuario</label>
        <div class="col-sm-10">
          <input type="text" id="usuario" name="usuario" value="" placeholder="Digite su usuario" required class="form-control" >
        </div>
            </div>

            <div class="form-group row">
              <label for="contrasena" class="col-sm-2 col-form-label text-white">Pregunta 1</label>
              <div class="col-sm-10">
                <input type="text" id="pregunta1" name="pregunta1" value="" placeholder="¿Que animal fue tu primer mascota?" required class="form-control">
              </div>
            </div><br>
            <div class="rolusuario">
              <div class="form-group row">
                <label for="pregunta1" class="col-sm-2 col-form-label text-white">Pregunta 2</label>
                <div class="col-sm-10">
                  <input type="text" id="pregunta2" name="pregunta2" value="" placeholder="¿Nombre de tu primer maestra?" required class="form-control">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="pregunta2" class="col-sm-2 col-form-label text-white">Contraseña nueva</label>
              <div class="col-sm-10">
                <input type="text" id="contrasena" name="contrasena" value="" placeholder="Digite su nueva contraseña" required class="form-control">
              </div>
            </div>

            <div id="boton" class="form-group">
              <input id="botonn" type="submit" name="" value="Enviar" class="btn btn-secondary">
            </div>

      </form>
      <form class="contenedor2" action="../login/iniciologin2.php" method="post">
        <div id="boton" class="form-group">
          <input id="botonn" type="submit" name="" value="Volver" class="btn btn-secondary"  >
        </div>
      </form>
    </div>
  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#botonn').click(function(){
			if($('#pregunta1').val()==""){
				alertify.alert("Debes agregar la respuesta 1");
				return false;
			}else if($('#pregunta2').val()==""){
				alertify.alert("Debes agregar la respuesta 2");
				return false;
      }else if($('#usuario').val()==""){
        alertify.alert("Debes agregar el usuario");
        return false;
      }else if($('#contrasena').val()==""){
        alertify.alert("Debes agregar la contraseña");
        return false;
      }

			cadena="pregunta1=" + $('#pregunta1').val() +
					"&pregunta2=" + $('#pregunta2').val();

					$.ajax({
						type:"POST",
						url:"../../conexion/formularioreset.php",
						data:cadena,
						success:function(r){
							     if(r==1){
								window.location="../login/iniciologin2.php";
							}else{
                alertify.alert("El usuario o la contraseña estan mal escritos, o no existen, por favor intentalo nuevamente, registrate o contacta a soporte");
                return false;
              }
						}
					});
		});
	});
</script>

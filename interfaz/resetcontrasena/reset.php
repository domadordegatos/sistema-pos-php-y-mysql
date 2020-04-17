<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <link rel="stylesheet" href="../../diseño/bootstrap.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Reset</title>
  </head>
  <body>
   <div class="contenedor">
     <h1 id="titulo">Reset de contraseña</h1>
     <h3 class="text-white">Por favor ingrese su nueva contraseña</h3><br>

       <?php
       $idusers=$_REQUEST['idusers'];
       require_once "../../conexion/conexion.php";
       $conexion=conexion();
       $consulta="SELECT users.idusers, users.usuario,
                         users.contrasena, users.rol, users_activos.estado
                         FROM users AS users
                         INNER JOIN users_activos AS users_activos ON users.idusers = users_activos.iduser
                         AND users.idusers = '$idusers'";
       $result=mysqli_query($conexion,$consulta);
       $mostrar=mysqli_fetch_assoc($result)
        ?>
        <div class="row text-white">
 			 	<div class="col-sm-4">
       <form class="form" method="post" action="../../conexion/modificarcontrasena.php">
         <input class="form-control input-sm" type="hidden" id="idusers" name="idusers" placeholder="digite su nueva contraseña" value="<?php echo $mostrar['idusers']; ?>">
         <label>Nombre Usuario</label>
           <input class="form-control input-sm" type="text" id="usuario" name="usuario" value="<?php echo $mostrar['usuario']; ?>" placeholder="digite su nuevo nombre">
        <label>Contraseña</label>
          <input class="form-control input-sm" type="text" id="contrasena" name="contrasena" placeholder="digite su nueva contraseña" value="<?php echo $mostrar['contrasena']; ?>">
       <label>Rol</label>
         <input class="form-control input-sm" type="text" id="rol" name="rol" value="<?php echo $mostrar['rol']; ?>" placeholder="digite su nuevo rol">
      <!-- <div class="form-group row">
      <label for="estado" class="col-sm-2 col-form-label text-white">Estado</label>
      <div class="col-sm-10">
        <input type="text" id="estado" name="estado" value="<?php echo $mostrar['estado']; ?>" placeholder="actualice su estado">
      </div>
     </div> -->
     <?php if($mostrar['estado'] == '1'){
       $estado=0;
     }else{
       $estado=1;
     } ?>
     <label class="text-white" for="">Marca 1 para activo</label><br>
     <label class="text-white" for="">Marca 0 para inactivo</label><br>
     <div id="checkes">
       <input class='form-check-input-inline' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='<?php echo $mostrar['estado']; ?>' checked>
       <label class='form-check-label text-white' for='inlineRadio1'><?php echo $mostrar['estado']; ?></label>
       <input class='form-check-input-inline' type='radio' name='inlineRadioOptions' id='inlineRadioOptions' value='<?php echo $estado; ?>'>
       <label class='form-check-label text-white' for='inlineRadio2'><?php echo $estado; ?></label>
     </div>

   </div>
   </div>
   <div class="izquierda">
     <div id="dosbotones">
       <button class="btn btn-success" type="submit" name="button">Enviar nueva password</button><br>
       <a href="../listadousuarios/lista.php" class="btn btn-danger">Volver</a>
     </div>
   </div>


       </form>
   </div>
  </body>
</html>

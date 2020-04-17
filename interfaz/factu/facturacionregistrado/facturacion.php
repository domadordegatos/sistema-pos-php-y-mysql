<?php
	session_start();
		$user = $_SESSION['user'];
    require_once "../../../conexion/conexion.php";
    $conexion=conexion();
		$cedula=$_REQUEST['cedula'];

		$experimentorol="SELECT rol from users where usuario='$user'";
		$result=mysqli_query($conexion,$experimentorol);
		$mostrar=mysqli_fetch_assoc($result);
		// consultar el rol para la redireccion
		$datos="SELECT nombre, apellido, telefono from clientes where cedula='$cedula'";
		$result2=mysqli_query($conexion,$datos);
		$mostrar2=mysqli_fetch_assoc($result2);
		// consultar datos del usuario ya registrado
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width:device-width, initial-scale=1">
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <link rel="stylesheet" href="../../../diseño/bootstrap.css" type="text/css">
    <title>Facturacion</title>
		<?php require_once "scripts.php"; ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>

    <div class="contenedor">
      <div class="titulo">
  <h1 class="text-white">Facturacion</h1>
      </div>
       <!-- action="../../../conexion/tablaventatemp.php" method="post" -->
       <form id="formularioventa" action="../../../conexion/tablaventatemp.php" method="POST">

        <div class="row">
					<div class="form-group col text-white">
						<label for="cajero">Nomb. Cajero</label>
						<input readonly id="cajero" name="cajero" type="text" class="form-control" value="<?php echo $user; ?>" placeholder="cajero" maxlength="15" pattern="[0-9]+">
					</div>
          <div class="form-group col text-white">
            <label for="cedula">Cedula</label>
            <input readonly id="cedula" name="cedula" type="number" class="form-control" value="<?php echo $cedula; ?>" placeholder="Cedula" maxlength="15" pattern="[0-9]+">
          </div>
          <div class="form-group col text-white">
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" value="<?php echo $mostrar2['nombre']; ?>" placeholder="Nombre" maxlength="15" pattern="[A-Za-z]+">
          </div>
          <div class="form-group col text-white">
            <label for="apellido">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" value="<?php echo $mostrar2['apellido']; ?>" placeholder="Apellido" maxlength="15" pattern="[A-Za-z]+">
          </div>
          <div class="form-group col text-white">
            <label for="telefono">Telefono</label>
            <input id="telefono" name="telefono" type="number" class="form-control" value="<?php echo $mostrar2['telefono']; ?>" placeholder="Telefono" maxlength="15" pattern="[0-9]+">
          </div>
					<div class="form-group col">
						<input type="button" class="btn btn-primary btn-block" id="btnagregarcliente" name="" value="Agregar">
						<input type="button" class="btn btn-danger btn-block" id="btnactualizarcliente" name="" value="Actualizar">
          </div>
        </div>

<div class="dosopciones">

	<div class="text-white" id="izquierda">
		<div class="" >

			<label>Producto</label>
			<select  class="form-control input-sm" id="productoVenta" name="productoVenta">
				<option value="A">Selecciona</option>
				<?php
				$lista="SELECT codigoproducto, nombre FROM productos";
				$res=mysqli_query($conexion,$lista);
				while ($producto=mysqli_fetch_row($res)):
					?>
					<option value="<?php echo $producto[0] ?> "><?php echo $producto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Categoria</label>
			<input readonly type="text" class="form-control input-sm" id="cagetoriaV" name="cagetoriaV" value="">
			<label>Cantidad</label>
			<input type="number" class="form-control input-sm" id="cantidadV" name="cantidadV" value="">
			<label>Precio</label>
			<input readonly type="number" class="form-control input-sm" id="precioV" name="precioV" value="">
			<p></p>
			<!-- <span class="btn btn-primary" id="btnagregarproducto">Agregar</span> -->
			<input type="button" class="btn btn-primary" id="btnagregarproducto" name="" value="Agregar">
			<input type="button" class="btn btn-danger" id="btnvaciarproducto" name="" value="Vaciar">



	</div>
</div>

<div class="derecha">
	<div class="" id="derecha">
		<div id="tablaventatempload">

		</div>

	</div>
</div>

</div>
</form>
<div class="btn-group btn-group-toggle">
	<form class="contenedor2" action="../../inicio/inicio.php" method="post">
		<!--  funciona la rediccion de usuario-->
			<input id="botonn" type="submit" name="" value="Volver" class="btn btn-secondary"  >
	</form>
	<form class="contenedor2" action="../ingreso/ingreso.php" method="post">
		<!--  funciona la rediccion de usuario-->
			<input id="botonn" type="submit" name="" value="Otro cliente" class="btn btn-success"  >
	</form>
	<form class="contenedor2" action="../facturashechas/facturas.php" method="post">
		<!--  funciona la rediccion de usuario-->
			<input id="botonn" type="submit" name="" value="Facturas" class="btn btn-warning"  >
	</form>
</div>



<script type="text/javascript">
$(document).ready(function(){
	$('#productoVenta').change(function(){
		// alertify.alert("holaaaaaaaaaaaaaaa");
		$.ajax({
			type:"POST",
			data:"idproducto=" +$('#productoVenta').val(),
			url:"../../../controlador/formularioventa.php",
			success:function(r){
					// alert(r);
				dato=jQuery.parseJSON(r);
				if(dato['stock'] <= 0){
				alertify.alert("No tenemos stock de este producto");
				$('#cagetoriaV').val('');
				$('#cantidadV').attr("readonly",'');;
				$('#cantidadV').val('');
				$('#precioV').val('');
				// val()==""
			}else{
				$('#cagetoriaV').val(dato['categoria']);
				$('#cantidadV').removeAttr("readonly");
				$('#cantidadV').val(dato['stock']);
				$('#precioV').val(dato['precio']);
			}

			}
		});
	});
	$('#btnagregarproducto').click(function(){
		if($('#cajero').val()==""){
			alertify.alert("Debes agregar el cajero");
			return false;
		}else if($('#cedula').val()==""){
			alertify.alert("Debes agregar la cedula");
			return false;
		}else if($('#nombre').val()==""){
			alertify.alert("Debes agregar el nombre");
			return false;
		}else if($('#apellido').val()==""){
			alertify.alert("Debes agregar el apellido");
			return false;
		}else if($('#telefono').val()==""){
			alertify.alert("Debes agregar el telefono");
			return false;
		}else if($('#productoVenta').val()==""){
			alertify.alert("Debes agregar el producto de Venta");
			return false;
		}else if($('#cagetoria').val()==""){
			alertify.alert("Debes agregar la cagetoria");
			return false;
		}else if($('#cantidadV').val()==""){
			alertify.alert("Debes agregar la cantidad");
			return false;
		}else if($('#precioV').val()==""){
			alertify.alert("Debes agregar el precio");
			return false;
		}else if($('#cantidadV').val()<="0"){
			alertify.error("Valor minimo excedido");
			return false;
		}
		  datos=$('#formularioventa').serialize();
		  $.ajax({
			type:"POST",
			data:datos,
			url:"../../../conexion/tablaventatemp.php",
			success:function(r){
				if(r==5){
					alertify.error("No tenemos esa cantidad en bodega :(");
					$('#tablaventatempload').load("tablaventastemp.php");
				}else if(r==1){
				$('#tablaventatempload').load("tablaventastemp.php");
			}
		}
		});
	});
	$('#btnvaciarproducto').click(function(){
		$.ajax({
			url:"./vaciartemp.php",
			success:function(r){
        $('#tablaventatempload').load("tablaventastemp.php");
			}
		});
	});
	$('#btnagregarcliente').click(function(){
		if($('#cajero').val()==""){
			alertify.alert("Debes agregar el cajero");
			return false;
		}else if($('#cedula').val()==""){
			alertify.alert("Debes agregar la cedula");
			return false;
		}else if($('#nombre').val()==""){
			alertify.alert("Debes agregar el nombre");
			return false;
		}else if($('#apellido').val()==""){
			alertify.alert("Debes agregar el apellido");
			return false;
		}if($('#telefono').val()==""){
			alertify.alert("Debes agregar el telefono");
			return false;
		}
		datos=$('#formularioventa').serialize();
		$.ajax({
		type:"POST",
		data:datos,
		url:"../../../conexion/agregarcliente.php",
		success:function(r){
			if(r==1){
				alertify.success("Cliente agregado");
				return false;
			}else{
				alertify.success("Para actualiar esta el boton de actualizar *inteligencia vial*");
				return false;
			    }
		     }
	     });
		});


		$('#btnactualizarcliente').click(function(){
			if($('#cajero').val()==""){
				alertify.alert("Debes agregar el cajero");
				return false;
			}else if($('#cedula').val()==""){
				alertify.alert("Debes agregar la cedula");
				return false;
			}else if($('#nombre').val()==""){
				alertify.alert("Debes agregar el nombre");
				return false;
			}else if($('#apellido').val()==""){
				alertify.alert("Debes agregar el apellido");
				return false;
			}else if($('#telefono').val()==""){
				alertify.alert("Debes agregar el telefono");
				return false;
			}
			datos=$('#formularioventa').serialize();
			$.ajax({
			type:"POST",
			data:datos,
			url:"../../../conexion/actualizarcliente.php",
			success:function(r){
				if(r==1){
					alertify.success("Cliente actualizado");
					return false;
				}else{
					alertify.success("Los datos son los mismos *Cambia algo*");
					return false;
				    }
			     }
		     });
			});
});
</script>
<script type="text/javascript">
	function quitarproducto(index){
		$.ajax({
			type:"POST",
			data:"ind=" +index,
			url:"./quitarproducto.php",
			success:function(r){
				$('#tablaventatempload').load("tablaventastemp.php");
				alertify.success("Producto quitado :D xddd");
			}
		});
	}
	function crearventa(){
		$.ajax({
			url:"../../../controlador/crearventa.php",
			success:function(r){
				if(r > 0){
					$('#tablaventatempload').load("tablaventastemp.php");
					$('#formularioventa')[0].reset();
					alertify.alert("venta creada con exito. revise la factura.");
				}else if (r == 0) {
					alertify.alert("No hay lista de venta");
				}else{
					alertify.error("No se pudo crear la venta");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#productoVenta').select2();
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaventatempload').load("tablaventastemp.php");
	});
</script>

</div>
  </body>
</html>

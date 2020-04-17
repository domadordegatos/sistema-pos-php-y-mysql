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
		 <meta name="viewport" content="width:device-width, initial-scale=1">
		 <link rel="stylesheet" href="./estilo.css" type="text/css">
		 <link rel="stylesheet" href="../../diseño/bootstrap.css" type="text/css">
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		 <?php require_once "scripts.php";
		 $sql ="SELECT  categoria
		 from productos group by categoria";
		 $result=mysqli_query($conexion,$sql);
		  ?>
     <title>Articulos</title>
   </head>
   <body>
		 <div class="contenedor">
			 <h1 class="text-white">Productos</h1>
			 <div class="row text-white">
			 	<div class="col-sm-4">
			 		<form id="formularioarticulos">
						<label>Categoria</label>
						<select class="form-control input-sm" name="categoria" id="categoria">
							<option value="A">Selecciona la categoria</option>
							<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $ver[0]; ?>
								</option>
							<?php endwhile; ?>
						</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Cantidad</label>
						<input type="number" class="form-control input-sm" id="cantidad" name="cantidad" value="0">
						<label>Precio</label>
						<input type="number" class="form-control input-sm" id="precio" name="precio">
						<p></p>
						<span id="agregarproducto" class="btn btn-success">Agregar</span>
						<a href="../inicio/inicio.php" class="btn btn-primary">Atras</a>
						<a href="../proveedores/facturacionregistrado/facturacion.php" class="btn btn-info">Solitar stock</a>
			 		</form>
			 	</div>
			 	<div class="col-sm-8">

					<div id="tablaproductosload"></div>
			 	</div>
			 </div>
		 </div>

		 <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="abremodalactualizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
					<form id="formularioarticulosA">
					<input type="text" id="idarticulo" hidden name="idarticulo" value="">
					<label>Categoria</label>
					<select class="form-control input-sm" name="categoriaA" id="categoriaA">
						<option value="A">Selecciona la categoria</option>
						<?php
						$sql ="SELECT  categoria
			 		 from productos group by categoria";
			 		 $result=mysqli_query($conexion,$sql);
						 ?>
						<?php while($ver=mysqli_fetch_row($result)): ?>
							<option value="<?php echo $ver[0] ?>"><?php echo $ver[0]; ?>
							</option>
						<?php endwhile; ?>
					</select>
					<label>Nombre</label>
					<input type="text" class="form-control input-sm" id="nombreA" name="nombreA">
					<label>Cantidad</label>
					<input type="number" class="form-control input-sm" id="cantidadA" name="cantidadA">
					<label>Precio</label>
					<input type="number" class="form-control input-sm" id="precioA" name="precioA">
					<p></p>
				</form>
      </div>
      <div class="modal-footer">
        <button id="btnactualizaproducto" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

   </body>
 </html>
<script type="text/javascript">
		function actualizardatosproducto(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticulo,
				url:"../../controlador/actualizarproducto.php",
				success:function(r){
					// alert(r);
					dato=jQuery.parseJSON(r);
					$('#idarticulo').val(dato['codigoproducto']);
					$('#categoriaA').val(dato['categoria']);
					$('#nombreA').val(dato['nombre']);
					$('#cantidadA').val(dato['stock']);
					$('#precioA').val(dato['precio']);
				}
			});
		}
		function eliminarproducto(id_cita){
	alertify.confirm('¿Desea eliminar esta cita?', function(){
		$.ajax({
			type:"POST",
			data:"id_cita=" + id_cita,
			url:"../../controlador/desactivar_cita.php",
			success:function(r){
				if(r==1){
					$('#tablaproductosload').load("tablaproductos.php");
					alertify.success("Eliminado con exito!!");
				}else{
					alertify.error("No se pudo eliminar :(");
				}
			}
		});
	}, function(){
		alertify.error('Cancelo !')
	});
}
</script>
<script type="text/javascript">
			$(document).ready(function(){
				$('#btnactualizaproducto').click(function(){
					if($('#cantidadA').val()<"0"){
						alertify.error("Valor minimo excedido");
						return false;
					}
					datos=$('#formularioarticulosA').serialize();
					$.ajax({
						type:"POST",
						data:datos,
						url:"../../conexion/actualizaproducto.php",
						success:function(r){
							if(r==1){
								$('#tablaproductosload').load("tablaproductos.php");
								alertify.success("Producto actualizado exitosamente");
							}else{
								alertify.error("No se pudo actualizar");
							}
						}
					});
				});
	});
</script>

 <script type="text/javascript">
   $(document).ready(function(){
	 $('#tablaproductosload').load("tablaproductos.php");
	 $('#agregarproducto').click(function(){
		 if($('#categoria').val()==""){
  			alertify.alert("Debes seleccionar una categoria");
  			return false;
  		}else if($('#nombre').val()==""){
	 			alertify.alert("Debes agregar el nombre");
	 			return false;
	 		}else if($('#cantidad').val()==""){
	 			alertify.alert("Debes poner una cantidad");
	 			return false;
	 		}else if($('#precio').val()==""){
	 			alertify.alert("Debes ponerle un precio");
	 			return false;
	 		}else if($('#cantidad').val()<"0"){
				alertify.error("Valor minimo excedido");
				return false;
			}

			datos=$('#formularioarticulos').serialize();
			$.ajax({
			type:"POST",
			data:datos,
			url:"../../conexion/agregarproducto.php",
			success:function(r){
	    $('#tablaproductosload').load("tablaproductos.php");
			if(r == 1){
				$('#formularioarticulos')[0].reset();
				$('#tablaproductosload').load("tablaproductos.php");
				alertify.success("Agregado con exito :D");
			}else if(r==0){
				alertify.error("este producto ya existe");
				$('#formularioarticulos')[0].reset();
				$('#tablaproductosload').load("tablaproductos.php");
			}else{
				alertify.error("Fallo al agregar");
			}
					 }
				});
     });
 	});
 </script>
 <?php
  } else {
 	header("location:../interfaz/login/iniciologin2.php");
 	}
  ?>

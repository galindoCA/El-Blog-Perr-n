<?php

include_once 'app/conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ControlSesion.inc.php';

if(!ControlSesion :: sesion_iniciada()){
	Redireccion :: redirigir(SERVIDOR);
}else{
	Conexion :: abrir_conexion();
	$id = $_SESSION['id_usuario'];
	$usuario = RepositorioUsuario ::obtener_usuario_por_id(Conexion::obtener_conexion(), $id);
}
?>
<?php
if(isset($_POST['guardar-imagen']) && !empty($_FILES['archivo-subido']['tmp_name'])){
	$directorio = DIRECTORIO_RAIZ."/subidas";
	$carpeta_objetivo = $directorio.basename($_FILES['archivo-subido']['name']);
	$subida_correcta = 1;
	$tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);

	$comprobacion = getimagesize($_FILES['archivo-subido']['tmp_name']);
	if($comprobacion !== false){
		$subida_correcta = 1;
	}else{
		$subida_correcta = 0;
	}

	if($_FILES['archivo-subido']['size'] > 1000000){
		echo "El archivo no puede ocupar mas de 1MB";
		$subida_correcta = 0;
	}

	if($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif"){
		echo "Solo se admiten formatos de imagen jpg, png, jpeg y gif";
		$subida_correcta = 0;
	}

	if($subida_correcta = 0){
		echo "Tu archivo no puede subirse";
	}
	else{
		if(move_uploaded_file($_FILES['archivo-subido']['tmp_name'], 
			DIRECTORIO_RAIZ."/subidas/".$usuario -> get_id())) {
			echo "El archivo".basename($_FILES['archivo-subido']['name'])."ha sido subido";
		}
		else{
			echo "Ha ocurrido un error";
		}
	}
}

$titulo = "Perfil de usuario";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container perfil">
	<div class="row">
		<div class="col-md-3">
			
			<img src="img/user.png" class="img-responsive">
			<br>
			<form class="text-center" action="<?php echo RUTA_PERFIL; ?>" method="post" enctype="multipart/form-data">
				<label for="archivo-subido" id="label-archivo">Sube una imagen de perfil</label>
				<input type="file" name="archivo-subido" id="archivo-subido" class="boton-subir">
				<br>
				<br>
				<input type="submit" value="Guardar" name="guardar-imagen" class="form-control">
			</form>
		</div>
		<div class="col-md-9">
			<h4><small>Nombre de usuario</small></h4>
			<h4><?php echo $usuario -> get_nombre(); ?></h4>
			<br>
			<h4><small>Email</small></h4>
			<h4><?php echo $usuario -> get_email(); ?></h4>
			<br>
			<h4><small>Usuario desde:</small></h4>
			<h4><?php echo $usuario -> get_fecha_registro(); ?></h4>
		</div>
	</div>
</div>

<?php 
include_once 'plantillas/documento-cierre.inc.php';
?>
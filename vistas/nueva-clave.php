<?php

include_once 'app/RepositorioRecuperacionClave.inc.php';
include_once 'app/Redireccion.inc.php';

Conexion::abrir_conexion();

if(RepositorioRecuperacionClave::url_secreta_existe(Conexion::obtener_conexion(), $url_personal)){
    $id_usuario = RepositorioRecuperacionClave :: obtener_id_usuario_mediante_url_secreta(Conexion::obtener_conexion(), $url_personal);
}else{
    echo '404';
}

if(isset($_POST['guardar-clave'])){
	//validar clave 1
	//comprobar si clave 2 coincide

	$clave_cifrada = password_hash($_POST['clave'], PASSWORD_DEFAULT);
	$clave_actualizada = RepositorioUsuario::actualizar_password(Conexion::obtener_conexion(), $id_usuario, $clave_cifrada);

	if($clave_actualizada){
		//redirigir a notificacion de actualizacion correcta y ofreser link de login
		Redireccion::redirigir(RUTA_LOGIN);
	}else{
		echo 'ERROR';
	}
}

Conexion::cerrar_conexion();

$titulo = 'Recuperacion de contraseña';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Crea una nueva contraseña</h4>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?php echo RUTA_NUEVA_CLAVE . "/" . $url_personal; ?>">
						<br>
						
						<div class="form-group">
							<label for="clave">Nueva contraseña</label>
							<input type="password" name="clave" id="clave" class="form-control" placeholder="Mínimo 6 caracteres" required>
						</div>

						<div class="form-group">
							<label for="clave2">Escribe de nuevo la contraseña</label>
							<input type="password" name="clave2" id="clave2" class="form-control" placeholder="Debe coincidir" required>
						</div>

						<button type="submit" name="guardar-clave" class="btn btn-lg btn-primary btn-block">
							Guardar contraseña
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
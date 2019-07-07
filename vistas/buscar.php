<?php
include_once 'app/EscritorEntradas.inc.php';
$busqueda = null;
$resultados = null;

if(isset($_POST['buscar']) && isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])){
	$busqueda = $_POST['termino-buscar'];

	Conexion::abrir_conexion();
	$resultados = RepositorioEntrada::buscar_entradas_todos_los_campos(Conexion::obtener_conexion(), $busqueda);

	Conexion::cerrar_conexion();
}
$titulo = "Buscar en el blg perron";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
	<div class="row">
		<div class="jumbotron">
		<h1 class="text-center">Buscar en El Blog Perron</h1>
		<br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form role="form" method="post" action="<?php echo RUTA_BUSQUEDA; ?>">
                    <div class="form-group">
                        <input type="search" name="termino-buscar" class="form-control" placeholder="¿Qué buscas?" required <?php echo "value='" . $busqueda . "'" ?>>
                    </div>
                    <button type="submit" name="buscar" id="btn-buscar" class="form-control btn btn-primary">
                        Buscar
                    </button>
                </form>
			</div>
		</div>
	</div>
	</div>
</div>

<div class="container" id="resultados">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Resultados
					<?php 
					if(count($resultados)){
						echo '<small>' . count($resultados) . 'resultados</small>';
					}
					?>
				</h1>
			</div>
		</div>
	</div>
	<?php 
		if(count($resultados)){
			EscritorEntradas::mostrar_entradas_busqueda($resultados);
		}else{
			?>
				<p>No existen coincidencias :(</p>
			<?php
		}
	 ?>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
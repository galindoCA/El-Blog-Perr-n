<?php
include_once 'app/conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/ValidadorEntrada.inc.php';

$entrada_publica = 0;

if(isset($_POST['guardar'])){
    Conexion :: abrir_conexion();
    
    $entrada_recuperada = new ValidadorEntrada($_POST['titulo'], $_POST['url'], htmlspecialchars($_POST['texto']), Conexion :: obtener_conexion());
    
    if(isset($_POST['publicar']) && $_POST['publicar'] = 'si'){
        $entrada_publica = 1;
    }
    
    if($entrada_recuperada -> entrada_valida()){
        if(ControlSesion :: sesion_iniciada()){
            $entrada = new Entrada('', $_SESSION['id_usuario'], $entrada_recuperada -> obtener_url(), $entrada_recuperada -> obtener_titulo(), 
                    $entrada_recuperada -> obtener_texto(), '', $entrada_publica);
            
            $entrada_insertada = RepositorioEntrada :: insertar_entrada(Conexion :: obtener_conexion(), $entrada);
            if($entrada_insertada){
                Redireccion :: redirigir(RUTA_GESTOR_ENTRADAS);
            }
        }
        else{
            Redireccion :: redirigir(RUTA_LOGIN);
        }
        
        Conexion :: cerrar_conexion();
    }
}

$titulo = "Nueva entrada del blog";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Nueva entrada</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-nueva-entrada" method="post" action="<?php echo RUTA_NUEVA_ENTRADA; ?>">
                <?php
                    if(isset($_POST['guardar'])){
                        include_once 'plantillas/form_nueva_entrada_validado.inc.php';
                    }
                    else{
                        include_once 'plantillas/form_nueva_entrada_vacio.inc.php';
                    }
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

        
        
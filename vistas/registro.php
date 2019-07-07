<?php
include_once 'app/conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/validadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) { //Aeguramos q boton ha sido pulsado
    Conexion :: abrir_conexion();
    
    $entrada_recuperada = new ValidadorRegistro($_POST['nombre'], $_POST['email'], 
            $_POST['clave1'], $_POST['clave2'], Conexion :: obtener_conexion()); //crea objeto validaor, con datos del POST
                                                                                                               
    
    if($entrada_recuperada -> registro_validado()){ //se verifica que los datos sean correctos
        $usuario = new Usuario('', $entrada_recuperada->get_nombre(), $entrada_recuperada->get_email(), 
                password_hash($entrada_recuperada->get_pass(), PASSWORD_DEFAULT), 
                '', ''); //crea objeto $usuario
        $insertar_usuario = RepositorioUsuario :: insertar_usuario(Conexion :: obtener_conexion(), $usuario);//se utiliza el metodo insertar_usuario
                                                                                                            //para insertar el $usuario en tabla
                                                                                                            //devuelve bool pa saber si si se inserto
        
        if($insertar_usuario){
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuario->get_nombre());
        }
        
    }
    Conexion :: cerrar_conexion();
}

$titulo = 'Registro';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Formulario de registro</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Instrucciones
                    </h3>
                </div>
                <div class="panel-body">
                    <br>
                    <p class="text-justify">
                        Para unirte al Hazblon Blog, introduce un nombre 
                        de usuario, tu email y una contraseña. El email que escribas
                        debe ser real ya que lo necesitarás para gestionar tu cuenta.
                        Te recomendamos que uses una contraseña que contenga 
                        mayusculas, minusculas, numeros y simbolos.
                    </p>
                    <br>
                    <a href="#">¿Ya tienes una cuenta?</a>
                    <br>
                    <br>
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>

            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Introduce tus datos
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['enviar'])){
                            include_once 'plantillas/registro_validado.inc.php';
                        }
                        else{
                            include_once 'plantillas/registro_vacio.inc.php';
                        }    
                        ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
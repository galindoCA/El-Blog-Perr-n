<?php

$titulo = 'Recuperar contraseña';

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
                    <h4>Recuperacion de contraseña</h4>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo RUTA_GENERAR_URL_SECRETA;?>">
                        <h2>Introduce tu email</h2>
                        <br>
                        <p>
                            Escribe la direccion de correo con la que te registraste y te enviaremos un email de recuperacion.
                        </p>
                        <br>
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Introduce tu email" 
                               required autofocus>
                        <br>
                        <button type="submit" name="enviar_email" class="btn btn-lg btn-primary btn-block" >Enviar</button>
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>


<?php
include_once 'plantillas/documento-cierre.inc.php';
?>








































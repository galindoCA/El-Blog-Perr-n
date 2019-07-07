<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion::abrir_conexion();
$total_usuarios = RepositorioUsuario :: obtener_numero_usuarios(Conexion::obtener_conexion());


?>
<nav class="navbar navbar-default navbar-static-top" style="background-color: #515151; border: 0;">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo SERVIDOR; ?>">Perron</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Este boton despliega la barra de navegacion</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>

                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                   <?php 
                    if(!ControlSesion::sesion_iniciada()){
                   ?>
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo RUTA_ENTRADAS; ?>"><i class="fas fa-tasks"></i> Entradas</a></li>
                        <li><a href="<?php echo RUTA_FAVORITOS; ?>"><i class="fas fa-heart"></i> Favoritos</a></li>
                        <li><a href="<?php echo RUTA_AUTORES; ?>"><i class="fas fa-pen-nib"></i> Autores</a></li>
                    </ul>
                    <?php 
                    }
                   ?>
                    <ul class="nav navbar-nav navbar-right">
                        <?php 
                        if(ControlSesion::sesion_iniciada()){
                           ?> 
                        <li>
                            <a href="<?php echo RUTA_PERFIL; ?>">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <?php echo ' ' . $_SESSION['nombre_usuario']; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo RUTA_GESTOR; ?>">
                                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>Gestor
                            </a>
                        </li>
                       
                        <li>
                            <a href="<?php echo RUTA_LOGOUT; ?>">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true">Cerrar sesión</span>
                            </a>
                        </li>
                        <?php
                        }
                        else {
                            ?>
                        <li>
                            <a href="#">
                                <i class="fas fa-users"></i>
                               <?php
                               echo $total_usuarios;
                               ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo RUTA_LOGIN; ?>">
                                <span class="glyphicon glyphicon-log-in" hidden-aria="true"></span> Iniciar sesión
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo RUTA_REGISTRO; ?>">
                                <i class="fas fa-user-plus"></i> Registro
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                     </ul>
                </div>
            </div>    
        </nav>

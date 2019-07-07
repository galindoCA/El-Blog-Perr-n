<?php

include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = 'El Blog Perron';

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1>Blog perron</h1>
        <p>Este es un blog muestra<br>Un Blog Perron hecho con PHP, html5, Bootstrap y MySQL</p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Busqueda
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="<?php echo RUTA_BUSQUEDA; ?>">
                                <div class="form-group">
                                    <input type="search" name="termino-buscar" class="form-control" placeholder="¿Qué buscas?">
                                </div>
                                <button type="submit" name="buscar" class="form-control btn btn-primary">
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filtro
                        </div>
                        <div class="panel-body">

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Archivo
                        </div>
                        <div class="panel-body">

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <?php 
            
            EscritorEntradas::escribir_entradas(); 
            ?>
        </div>
    </div>
    <?php
    include_once 'plantillas/documento-cierre.inc.php';
    ?>

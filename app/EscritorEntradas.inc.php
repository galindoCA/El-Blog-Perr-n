<?php
include_once 'RepositorioEntrada.inc.php';
include_once 'Entrada.inc.php';

class EscritorEntradas {

    public static function escribir_entradas() {
        $entradas = RepositorioEntrada::get_all_in_down_order(Conexion::obtener_conexion());
        
        
        
        if (count($entradas)) {
            foreach ($entradas as $entrada) {
                self::escribir_entrada($entrada);
            }
        }
    }

    public static function escribir_entrada($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $entrada->obtener_titulo(); ?>
                    </div>    
                    <div class="panel-body">
                        <p>
                            <strong>
                                <?php echo $entrada->obtener_fecha(); ?>
                            </strong>
                        </p>
                        <div class="text-justify">
                           <?php echo nl2br(self::resumir_texto($entrada->obtener_texto())); ?> 
                        </div>
                        <br>
                        <div class="text-center">
                            <a class="btn btn-primary" href="<?php echo RUTA_ENTRADA . '/' . $entrada -> obtener_url()  ?>"
                               role="button">Seguir leyendo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public static function mostrar_entradas_busqueda($entradas) {
        for($i = 1; $i <= count($entradas); $i++) {
            if($i % 3 == 0) {//Este if se encarga de poner un row cada 3 entradas que se muestran
                ?>
                    <div class="row">
                <?php
            }
                $entrada = $entradas[$i - 1];
                self::mostrar_entrada($entrada);

            if($i % 3 == 0) {
                ?>
                    </div>
                <?php
            }
        }
    }

    public static function mostrar_entrada($entrada) {
        if (!isset($entrada)) {
            return;
        }
        ?>

        
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo $entrada->obtener_titulo(); ?>
                </div>    
                <div class="panel-body">
                    <p>
                        <strong>
                            <?php echo $entrada->obtener_fecha(); ?>
                        </strong>
                    </p>
                    <div class="text-justify">
                       <?php echo nl2br(self::resumir_texto($entrada->obtener_texto())); ?> 
                    </div>
                    <br>
                    <div class="text-center">
                        <a class="btn btn-primary" href="<?php echo RUTA_ENTRADA . '/' . $entrada -> obtener_url()  ?>"
                           role="button">Seguir leyendo</a>
                    </div>
                </div>
            </div>
        </div>
        

        <?php
    }
    
    public static function resumir_texto($texto){
        $longitud_maxima = 400;
        
        $resultado = '';
        
        if(strlen($texto) >= $longitud_maxima){
            
            $resultado = substr($texto, 0, $longitud_maxima); //recoje un substring de $texto desde posicion 0 a 400
            $resultado .= '...'; //concatena puntos suspensivos despues del valor original 
        }
        else{
            $resultado = $texto;
        }
        
        return $resultado;
        
    }

}

<?php

include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

$componentes_url = parse_url($_SERVER["REQUEST_URI"]); //nos devuelve un array con los parametros de la url

$ruta = $componentes_url['path']; //La ruta se vuelve lo que esta delante de la url original /usuario/javadev

$partes_ruta = explode("/", $ruta); //divide las partes de la ruta en partes a partir del signo slash
//limpiando el array
$partes_ruta = array_filter($partes_ruta); //hace que los parametros del array se llenen desde la posicion 1 
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = 'vistas/404.php';

if ($partes_ruta[0] == 'blog') {
    if(count($partes_ruta) == 1){
        $ruta_elegida = "vistas/home.php";
    }
    else if(count($partes_ruta) == 2){
        switch ($partes_ruta[1]){
            case 'login': $ruta_elegida = 'vistas/login.php';
                break;
            case 'logout': $ruta_elegida = 'vistas/logout.php';
                break;
            case 'registro': $ruta_elegida = 'vistas/registro.php';
                break; 
            case 'gestor': $ruta_elegida = 'vistas/gestor.php';
                           $gestor_actual = '';
                break; 
            case 'relleno-dev': $ruta_elegida = 'scripts/script-relleno.php';
                break;
            case 'nueva-entrada': $ruta_elegida = 'vistas/nueva-entrada.php';
                break;
            case 'borrar-entrada': $ruta_elegida = 'scripts/borrar-entrada.php';
                break;
            case 'editar-entrada': $ruta_elegida = 'vistas/editar-entrada.php';
                break;
            case 'recuperar-clave': $ruta_elegida = 'vistas/recuperar-clave.php';
                break;
            case 'generar-url-secreta': $ruta_elegida = "scripts/generar-url-secreta.php";
                break;
            case 'buscar': $ruta_elegida = 'vistas/buscar.php';
                break;
            case 'perfil': $ruta_elegida = 'vistas/perfil.php';
                break;
        }
    }
    elseif (count($partes_ruta) == 3) {
        if($partes_ruta[1] == 'registro-correcto'){
            $nombre = $partes_ruta[2];
            $ruta_elegida = 'vistas/registro-correcto.php';
        }
        if($partes_ruta[1] == 'entrada'){
            $url = $partes_ruta[2];
            
            Conexion::abrir_conexion();
            //se llama a la fucion obtener entrada por url para que cree una entrada recuperada con un sql por su url
            //si la variable $entrada queda vacia entonces no existe dicha entrada 
            $entrada = RepositorioEntrada::obtener_entrada_por_url(Conexion::obtener_conexion(), $url);
            
            if($entrada != null){
                $autor = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $entrada->obtener_autor_id());
                $comentarios = RepositorioComentario::obtener_comentarios(Conexion::obtener_conexion(), $entrada -> obtener_id());
                $entradas_azar = RepositorioEntrada::obtener_entradas_al_azar(Conexion::obtener_conexion(), 3);
                $ruta_elegida = 'vistas/entrada.php';
            }
        }
        if($partes_ruta[1]== 'gestor'){
            switch ($partes_ruta[2]) {
                case 'entradas': 
                    $gestor_actual = 'entradas';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'comentarios': 
                    $gestor_actual = 'comentarios';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'favoritos': 
                    $gestor_actual = 'favoritos';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                    

                
            }
        }
        if($partes_ruta[1] == 'nueva-clave'){
            $url_personal = $partes_ruta[2];
            $ruta_elegida = 'vistas/nueva-clave.php';
        }
    }
}

include_once $ruta_elegida;
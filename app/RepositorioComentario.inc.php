<?php

include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/Comentario.inc.php';

class RepositorioComentario {

    public static function insertar_comentario($conexion, $comentario) {
        $comentario_insertado = false;

        if (isset($conexion)) {
            try {

                $sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autor_id, :entrada_id, :titulo, :texto, NOW())";

                $sentencia = $conexion->prepare($sql);

                $autor2 = $comentario->obtener_autor_id();
                $entrada2 = $comentario->obtener_entrada_id();
                $titulo2 = $comentario->obtener_titulo();
                $texto2 = $comentario->obtener_texto();

                $sentencia->bindParam(':autor_id', $autor2, PDO::PARAM_STR);
                $sentencia->bindParam(':entrada_id', $entrada2, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $titulo2, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $texto2, PDO::PARAM_STR);


                $comentario_insertado = $sentencia->execute();
            } catch (PDOException $ex) {

                print "ERROR: " . $ex->getMessage();
            }
        }

        return $comentario_insertado; //se envia el bool $usuario_insertado solo para saber si la sentencia se ejecuto exitosamente
    }

    public static function obtener_comentarios($conexion, $entrada_id) {
        $comentarios = array();

        if (isset($conexion)) {
            try {
                include_once 'Comentario.inc.php';

                $sql = 'SELECT * FROM comentarios WHERE entrada_id = :entrada_id';

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $comentarios[] = new Comentario($fila['id'], $fila['autor_id'], $fila['entrada_id'],
                                $fila['titulo'], $fila['texto'], $fila['fecha']);
                    }
                } 
            } catch (PDOException $ex) {
                print 'ERROR' . $ex ->getMessage();
            }
        }
        return $comentarios;
    }
    
    public static function contar_comentario_usuario($conexion, $id_usuario){
        
        $total_comentarios = 0;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT COUNT(*) as total_comentarios FROM comentarios WHERE autor_id = :autor_id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){
                    $total_comentarios = $resultado['total_comentarios'];
                }
                
            } catch (Exception $ex) {
                print 'ERROR' . $ex ->getMessage();
            }
        }
        return $total_comentarios;
    }

}

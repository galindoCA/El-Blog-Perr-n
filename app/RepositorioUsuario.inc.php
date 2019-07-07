<?php
    include_once 'app/Usuario.inc.php';
class RepositorioUsuario{
    
    public static function Obtener_todos($conexion) {
        $usuarios = array();
        
        if(isset($conexion)){
            
            try {
                include_once 'Usuario.inc.php';
                $sql = "SELECT * FROM usuarios";
                
                $sentencia = $conexion -> prepare($sql);//Hacemos que conexion nos ejecute el metodo prepare dentro de sentencia
                $sentencia -> execute(); //sentencia corre el metodo de PDO ejecutar q lee base de datos
                $resultado = $sentencia ->fetchAll();//sentencia devuelve resultados existentes
                
                if(count($resultado)){ //Metodo count cuenta las cosas dentro de un array
                    foreach ($resultado as $fila){ //fomula foreach recorre automaticamente array (nombreArray as nombreAelemento)
                        $usuarios[]= new Usuario(//se construye un nuevo usuario, toda informacion guardada en $fila
                                    $fila['id'], $fila['nombre'], $fila['email'], $fila['password'], 
                                    $fila['fecha_registro'], $fila['activo']
                                );
                    }
                }
                else{
                    print 'No hay usuarios';
                }
                
            } 
            catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        return $usuarios;
        
    }
    
    public static function obtener_numero_usuarios($conexion) {
        $total_usuarios = null;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT COUNT(*) as total FROM usuarios";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_usuarios = $resultado['total']; //este total es el total de la sentencia sql
            } catch (PDOException $ex) {
                print 'ERROR:' . $ex -> getMessage();
            }
        }
        return $total_usuarios;
    }
    
    public static function insertar_usuario($conexion, $usuario){
        $usuario_insertado = false;
        
        if(isset($conexion)){
            try {
                
                $sql = "INSERT INTO usuarios(nombre, email, password, fecha_registro, activo) VALUES(:nombre,:email,:password, NOW(), 0)";
                
                $sentencia = $conexion->prepare($sql);
                
                $name = $usuario->get_nombre();
                $mail = $usuario->get_email();
                $pass = $usuario->get_password();
                
                $sentencia -> bindParam(':nombre', $name, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $mail, PDO::PARAM_STR);
                $sentencia -> bindParam(':password', $pass, PDO::PARAM_STR);
                
                $usuario_insertado = $sentencia -> execute();
                
            } catch (PDOException $ex) {
                
                print "ERROR: " . $ex->getMessage();
                
            }
        }
        
        return $usuario_insertado; //se envia el bool $usuario_insertado solo para saber si la sentencia se ejecuto exitosamente
    }
    
    public static function  nombre_existe($conexion, $nombre){
        $nombre_existe = true;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM usuarios where nombre=:nombre";//selecciona datos del usuario donde nombre = parametro pasado
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia->fetchAll();
                
                if(count($resultado)){
                    $nombre_existe = true;
                }
                else{
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $nombre_existe;
    }
    
    public static function  email_existe($conexion, $email){
        $email_existe = true;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM usuarios where email=:email"; //selecciona datos del usuario donde email = parametro pasado
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia->fetchAll();
                
                if(count($resultado)){//cuenta el resultado donde el email sea la busqueda, si cuenta cero no existe
                    $email_existe = true;
                }
                else{
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $email_existe;
    }
    
    public function obtener_usuario_por_email($conexion, $email) {
        $usuario = null;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){
                    $usuario = new Usuario($resultado['id'], 
                            $resultado['nombre'], 
                            $resultado['email'],
                            $resultado['password'], 
                            $resultado['fecha_registro'], 
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
               print 'ERROR' . $ex ->getMessage(); 
            }
        }
        
        return $usuario;
    }
    
    public function obtener_usuario_por_id($conexion, $id) {
        $usuario = null;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){
                    $usuario = new Usuario($resultado['id'], 
                            $resultado['nombre'], 
                            $resultado['email'],
                            $resultado['password'], 
                            $resultado['fecha_registro'], 
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
               print 'ERROR' . $ex ->getMessage(); 
            }
        }
        
        return $usuario;
    }

    public static function actualizar_password($conexion, $id_usuario, $nueva_clave){
        $actualizacion_correcta = false;

        if(isset($conexion)){
            try {
                $sql = "UPDATE usuarios SET password = :password WHERE id = :id";

                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':password', $nueva_clave, PDO::PARAM_STR); 
                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);

                $sentencia -> execute();

                $resultado = $sentencia -> rowCount();

                if(!empty($resultado)){
                    $actualizacion_correcta = true;
                }else{
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        return $actualizacion_correcta;
    }
}

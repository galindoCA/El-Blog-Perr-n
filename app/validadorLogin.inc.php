<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorLogin {
    
    private $usuario;
    private $error;
    
    public function __construct($email, $clave, $conexion) {
        $this->error="";
        
        if(!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)){ //se comprueba unicamente si el usuario lleno los campos
            $this->usuario=null;
            $this->error="Debes introducir tu email y tu contraseña";
        }
        else {
            $this->usuario=RepositorioUsuario::obtener_usuario_por_email($conexion, $email);//se crea objeto con este metodo pero aún p haber erros
            
            if(is_null($this->usuario) || !password_verify($clave, $this->usuario->get_password())){//si no se introdujeron bien los datos el objeto no se creó por lo que usuario es null
                $this->error="Datos incorrectos";
            }
        }
    }
    
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function obtener_usuario() {
        return $this->usuario;
    }
    
    public function obtener_error() {
        return $this->error;
    }
    
    public function mostrar_error() {
        if($this->error !== ""){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";
        }
    }
}


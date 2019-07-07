<?php
include_once 'RepositorioUsuario.inc.php';
class ValidadorRegistro {
    
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $email;
    private $clave;
   
    private $error_nombre;
    private $error_email;
    private $error_clave1;
    private $error_clave2;

    public function __construct($nombre, $email, $clave1, $clave2, $conexion) {
        $this -> aviso_inicio = "<br><div class= 'alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";
        
        $this->nombre = "";
        $this->email = "";
        $this->clave = "";

        $this->error_nombre = $this->validar_nombre($conexion, $nombre);
        $this->error_email = $this->validar_email($conexion, $email);
        $this->error_clave1 = $this->validar_clave1($clave1);
        $this->error_clave2 = $this->validar_clave2($clave1, $clave2);
        
        if($this -> error_clave1 === "" && $this -> error_clave2 === ""){
            $this -> clave = $clave1;
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombre($conexion, $nombre) {
        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir un nombre de usuario.";
        } 

        if (strlen($nombre) < 6) {
            return "El nombre debe ser mas grande que 6 caracteres.";
        }
        if(strlen($nombre) > 24){
            return "El nombre debe ser menor que 24 caracteres";
        }
        else {
            $this->nombre = $nombre;
        }
        
        if (RepositorioUsuario :: nombre_existe($conexion, $nombre)){
            return "Este nombre de usuario ya esta en uso, por favor prueva otro.";
        }

        return "";
    }

    private function validar_email($conexion, $email) {
        if (!$this->variable_iniciada($email)) {
            return "Debes proporcionar un email.";
        } else {
            $this->email = $email; //this apunta a la variable global de la clase sin el apuntariamos al parametro en el metodo
        }
        if (RepositorioUsuario :: email_existe($conexion, $email)){
            return "Este email ya esta en uso, por favor prueva otro o <a href='#'>Intente recuperar su contraseña</a>.";
        }

        return "";
    }

    private function validar_clave1($clave1) {
        if (!$this->variable_iniciada($clave1)) {
            return "Debes escribir una contraseña";
        } 
        return "";
    }

    private function validar_clave2($clave1, $clave2) {
        if(!$this->variable_iniciada($clave1)){
            return "Pimero debes escribir una contraseña arriba.";
        }
        if (!$this->variable_iniciada($clave2)) {
            return "Debes repetir tu contraseña coincidiendo en ambas.";
        }
        if($clave2 !== $clave1){
            return "Debes repetir tu contraseña coincidiendo en ambas.";
        }

        return "";
    }

    public function get_nombre() {
        return $this->nombre;
    }

    public function get_email() {
        return $this->email;
    }
    
    public function get_pass() {
        return $this->clave;
    }

    public function get_error_nombre() {
        return $this->error_nombre;
    }

    public function get_error_email() {
        return $this->error_email;
    }

    public function get_error_clave1() {
        return $this->error_clave1;
    }

    public function get_error_clave2() {
        return $this->error_clave2;
    }
    
    public function mostrar_nombre() {
        if($this->nombre !==""){
            echo 'value="' . $this-> nombre . '"';
        }
    }
    
    public function mostrar_error_nombre() {
        if($this->error_nombre !== ""){
            echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_email() {
        if($this->email !==""){
            echo 'value="' . $this-> email . '"';
        }
    }
    
    public function mostrar_error_email() {
        if($this->error_email !== ""){
            echo $this -> aviso_inicio . $this -> error_email . $this -> aviso_cierre;
        }
    }
  
    public function mostrar_error_pass1() {
        if($this->error_clave1 !== ""){
            echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_pass2() {
        if($this->error_clave2 !== ""){
            echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
        }
    }
    
    public function registro_validado(){ //comprueba la validacion de todos los campos
        if($this -> error_nombre===""&&
           $this -> error_email===""&&
           $this -> error_clave1===""&&
           $this -> error_clave2==="")
        {
           return true;
        }
        else{
            return false;
        }
    }

}

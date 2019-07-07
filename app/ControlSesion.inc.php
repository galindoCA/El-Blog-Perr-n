<?php

class ControlSesion{
    
    public static function iniciar_sesion($id_usuario, $nombre_usuario) { //metodo inicia sesion
        if(session_id() == ''){
            session_start(); //metodo habilita espacio en memoria donde va sesion de usuario
        }
        
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        
    }
    
    public static function cerrar_sesion(){
        //se habilita de nuevo ese espacio porque aunque se cerrará la sesion se trabajará con ese espacio de memoria
         if(session_id() == ''){
            session_start(); //metodo habilita espacio en memoria donde va sesion de usuario
        }
        //procede a eliminar cockies 
        if(isset($_SESSION['id_usuario'])){
            unset($_SESSION['id_usuario']);//elimina informacion de la variable
        }
        if(isset($_SESSION['nombre_usuario'])){
            unset($_SESSION['nombre_usuario']);//elimina informacion de la variable
        }
        
        session_destroy();
    }
    
    public static function sesion_iniciada(){
        
        if(session_id() == ''){
            session_start(); //metodo habilita espacio en memoria donde va sesion de usuario
        }
        if(isset($_SESSION['id_usuario']) && isset($_SESSION['nombre_usuario'])){
            return true;
        }
        else {
            return false;
        }
    }
}

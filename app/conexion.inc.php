<?php
 
class Conexion { //This onject have the porpouse to open conection with BD
    private static $conexion;
 
    public static function abrir_conexion(){ //metodo para abrir conexion
        if (!isset(self::$conexion)){ //isset determina si una variable esta definida
            try { //intenta algo
                $link = "mysql:host=localhost; dbname=blog";
                $nombre_usuario = 'root';
                $password = '';
                //A continuacion se crea el objeto PDO con la clase PDO propia de PHP 
                self::$conexion = new PDO($link,$nombre_usuario,$password);
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Establecemos atributos para lanzar exceptions
                self::$conexion ->exec("SET CHARACTER SET utf8");//exec ejecuta sentencia sql para estableces caracteres utf8
                                  
            } catch (PDOException $ex) { //si existe un error en PDO este bloque lanza un exception
                print 'Data base connection failed: ' . $ex -> getMessage() . "<br>";
                die();//metodo termina conexion
            }
        }
    }
    public static function cerrar_conexion() {
        if(isset(self::$conexion)) {
            self::$conexion = null; //vuelve nulos los valores en $conexion

        }
    }
    public static function obtener_conexion() {
        return self::$conexion;
    }
}

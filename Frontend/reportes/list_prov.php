<?php
class Conexion{
    public static function Conectar(){
        define('servidor', 'localhost');
        define('nombre_db', 'ferreteria');
        define('usuario', 'root');
        define('password', '');
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_db, usuario, password, $opciones);
            return $conexion;
        }catch(Exception $e){
            die("El error de conexion es: ".$e->getMessage());
        }
    }
}
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT proveedores.id_proveedor, proveedores.nombre_prov, proveedores.ruc, proveedores.telefono, departamentos.id_departamento,
            departamentos.nombre AS nombre_depar, ciudades.id_ciudad, ciudades.nombre AS nombre_ciudad 
            FROM proveedores JOIN departamentos ON departamentos.id_departamento = proveedores.departamento
            JOIN ciudades ON ciudades.id_ciudad = proveedores.distrito";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchALL(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE);//ENVIA EL ARRAY FINAL EN FORMATO JSON A AJAX
$conexion=null;
?>
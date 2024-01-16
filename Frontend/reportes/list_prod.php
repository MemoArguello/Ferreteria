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

$consulta = "SELECT productos.id_producto, productos.nombre_producto, productos.categoria, 
                    productos.lote, productos.stock, productos.precio, productos.informacion, 
                    proveedores.id_proveedor, proveedores.nombre_prov, categorias.id_categoria, categorias.descripcion
                    FROM productos JOIN proveedores
                    ON proveedores.id_proveedor = productos.id_proveedor 
                    JOIN categorias ON categorias.id_categoria = productos.categoria";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchALL(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE);//ENVIA EL ARRAY FINAL EN FORMATO JSON A AJAX
$conexion=null;
?>
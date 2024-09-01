<?php
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('DBNAME')) {
    define('DBNAME', 'ferreteria');
}
if (!defined('USER')) {
    define('USER', 'root');
}
if (!defined('PASS')) {
    define('PASS', '');
}

try {
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


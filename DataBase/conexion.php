<?php


$host = "localhost";      
$dbname = "gestor_ganadero"; 
$username = "root";       
$password = "";
$socket = "/opt/lampp/var/mysql/mysql.sock";         

$mensaje = '';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8;unix_socket=$socket";
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $mensaje = "Estado de conexión: Conectado";

} catch (PDOException $e) {
    $mensaje = "Error de conexión: " . $e->getMessage();
}

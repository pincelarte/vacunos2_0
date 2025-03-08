<?php


$host = "localhost";      
$dbname = "gestor_ganadero"; 
$username = "root";       
$password = "";
$socket = "/opt/lampp/var/mysql/mysql.sock";         

$mensaje = '';
date_default_timezone_set('America/Argentina/Buenos_Aires');

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8;unix_socket=$socket";
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $mensajeConexion = "Conectado a db vacunos";

} catch (PDOException $e) {
    $mensajeConexion = "Error de conexión: " . $e->getMessage();
}

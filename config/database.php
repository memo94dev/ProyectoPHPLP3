<?php

$server = "localhost";
$username = "memo";
$password = "123456";
$database = "sysweb";

$mysqli = new mysqli($server, $username, $password, $database);
if ($mysqli->connect_error) {
    die("Error: " . $mysqli->connect_error);
}

?>

<?php
// $server   = "localhost";
// $username = "memo";
// $password = "123456";
// $database = "sysweb";

// try {
    
//     $pdo = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);

//     // Configurar atributos de error
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     //echo "Conexión exitosa con PDO";
// } catch (PDOException $e) {
//     die("Error en la conexión: " . $e->getMessage());
// }
?>
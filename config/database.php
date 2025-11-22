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
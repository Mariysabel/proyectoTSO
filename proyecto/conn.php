<?php
$host = "localhost";
$usuario = "dev_user";
$password = "User*2026"; 
$bd = "truppercatorce";
$conn = new mysqli($host, $usuario, $password, $bd);

if ($conn->connect_error) {die("Error de conexión: " . $conn->connect_error);}
$conn->set_charset("utf8");
?>
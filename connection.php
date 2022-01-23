<?php

$host = "localhost";
$user = "root";
$pass = "xnhzmu53";
$dbname = "simple_login";
$port = 3306;


try{
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    //echo "Conexão com banco de dados realizada!";
}catch(PDOException $err){
    //echo "Conexão não realizada! Erro: " . $err->getMessage();
}
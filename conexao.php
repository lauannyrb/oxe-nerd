<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "oxe-nerd";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
dgdfgd
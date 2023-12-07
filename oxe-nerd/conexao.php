<?php
$servername = "mysql";
$username = "mysql"; 
$password = "mysql"; 
$dbname = "mysql";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
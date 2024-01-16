<?php
$servername = "mysql";
$username = "oxe-nerd"; 
$password = "oxe-nerd"; 
$dbname = "db_oxe-nerd";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
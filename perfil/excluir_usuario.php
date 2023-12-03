<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
    include '../conexao.php';

    $email = $_GET['email'];

    $stmt = $conn->prepare("DELETE FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Encerrar a sessão após a exclusão
    session_unset();
    session_destroy();

    header("Location: ../index.php"); 
    exit();
}
?>

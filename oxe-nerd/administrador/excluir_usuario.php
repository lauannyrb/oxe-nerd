<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'])) {
    include '../conexao.php';

    $usuario_id = $_POST['usuario_id'];

    $stmt = $conn->prepare("DELETE FROM `user` WHERE `id` = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    // Encerrar a sessão após a exclusão (opcional, dependendo do seu fluxo de lógica)
    // session_unset();
    // session_destroy();
    // session_destroy();

    header("Location: lista-usuarios.php");
    exit();
} else {
    // Redirecionar para a lista de usuários se o método de requisição não for POST
    header("Location: lista-usuarios.php");
    exit();
}
?>
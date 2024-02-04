<?php
session_start();

// Verificar se o usuário está logado como administrador
if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] !== 'adm') {
    header("Location: ../index.php");
    exit; // Certifique-se de sair após redirecionar
}

// Verificar se o método de requisição é POST e se o ID do usuário está definido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'])) {
    // Incluir arquivo de conexão com o banco de dados
    include '../conexao.php';

    // Receber o ID do usuário a ser excluído
    $usuario_id = $_POST['usuario_id'];

    // Preparar e executar a consulta SQL para excluir o usuário
    $sql = "DELETE FROM user WHERE id = $usuario_id";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar de volta à página de listagem de usuários
        header("Location: lista_usuarios.php");
        exit;
    } else {
        echo "Erro ao excluir o usuário: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    // Se o método de requisição não for POST ou se o ID do usuário não estiver definido, redirecionar de volta à página de listagem de usuários
    header("Location: lista_usuarios.php");
    exit;
}
?>

<?php
session_start();

// Verificar se o usuário está logado como administrador
if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] !== 'adm') {
    header("Location: ../index.php");
    exit; // Certifique-se de sair após redirecionar
}

// Verificar se o método de requisição é POST e se os dados do formulário foram enviados corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'], $_POST['nome'], $_POST['nickname'], $_POST['senha'])) {
    // Incluir arquivo de conexão com o banco de dados
    include '../conexao.php';

    // Receber os dados do formulário
    $id = $_POST['usuario_id'];
    $nome = $_POST['nome'];
    $nickname = $_POST['nickname'];
    $senha = $_POST['senha'];

    // Preparar e executar a consulta SQL para atualizar os dados do usuário
    $sql = "UPDATE user SET name='$nome', nickname='$nickname', password='$senha' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar de volta à página de listagem de usuários
        header("Location: lista_usuarios.php");
        exit;
    } else {
        echo "Erro ao atualizar o usuário: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    // Se o método de requisição não for POST ou se os dados do formulário não forem enviados corretamente, redirecionar de volta à página de listagem de usuários
    header("Location: lista_usuarios.php");
    exit;
}
?>

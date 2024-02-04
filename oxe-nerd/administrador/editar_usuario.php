<?php
session_start();

// Verificar se o usuário está logado como administrador
if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] !== 'adm') {
    header("Location: ../index.php");
    exit; // Certifique-se de sair após redirecionar
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se os dados do formulário foram enviados corretamente
    if (isset($_POST['id'], $_POST['nome'], $_POST['senha'])) {
        // Coletar dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        // Conexão com o banco de dados
        include '../conexao.php';

        // Preparar e executar a consulta SQL para atualizar os dados do usuário
        $sql = "UPDATE user SET name='$nome', password='$senha' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Redirecionar de volta à página de listagem de usuários
            header("Location: lista_usuarios.php");
            exit;
        } else {
            echo "Erro ao atualizar o usuário: " . $conn->error;
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
}
?>

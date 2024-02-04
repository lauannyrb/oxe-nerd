<?php
session_start();

// Verificar se o usuário está logado como administrador
if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] !== 'adm') {
    header("Location: ../index.php");
    exit; // Certifique-se de sair após redirecionar
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o ID do usuário foi enviado corretamente
    if (isset($_POST['id'])) {
        // Coletar o ID do usuário
        $id = $_POST['id'];

        // Conexão com o banco de dados
        include '../conexao.php';

        // Preparar e executar a consulta SQL para excluir o usuário
        $sql = "DELETE FROM user WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Redirecionar de volta à página de listagem de usuários
            header("Location: lista_usuarios.php");
            exit;
        } else {
            echo "Erro ao excluir o usuário: " . $conn->error;
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
}
?>

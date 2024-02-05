<?php
include '../conexao.php';
sessao();
logout();
verificarAdm();

if(isset($_POST['apagar'])){
    $id_produto = $_POST['id']; // ID do produto a ser excluído

    // Query para excluir o produto do banco de dados
    $sql = "DELETE FROM products WHERE id = $id_produto";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../produtos/edit.php');
        exit(); // Adicionado para evitar que o código continue sendo executado após o redirecionamento
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }
}

?>

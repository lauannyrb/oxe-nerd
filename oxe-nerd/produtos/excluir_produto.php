<?php
include '../conexao.php';
sessao();
logout();
vertificarAdm();

if(isset($_POST['apagar'])){
    $id_produto = $_POST['id']; // ID do produto a ser excluído

    // Query para excluir o produto do banco de dados
    $sql = "DELETE FROM products WHERE id = $id_produto";

    if ($conn->query($sql) === TRUE) {
        echo "Produto excluído com sucesso";
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }
    $conn->close();

    // Redirecionar de volta para a página anterior ou para onde você desejar
    header('Location: ../administrador/admin-home.php');
    exit();
}
?>

<?php
// Verifica se os dados do formulário foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações do banco de dados
    include '../conexao.php';

    // Verifica se a conexão foi bem sucedida
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $image_path = $_POST['image_path'];
    $category = $_POST['category'];
    $quantidade = $_POST['quantidade'];

    // Query para atualizar o produto no banco de dados
    $sql = "UPDATE products SET 
            name = '$name', 
            price = '$price', 
            old_price = '$old_price', 
            image_path = '$image_path', 
            category = '$category', 
            quantidade = '$quantidade' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Produto atualizado com sucesso";
    } else {
        echo "Erro ao atualizar produto: " . $conn->error;
    }

    // Fecha conexão com o banco de dados
    $conn->close();
} else {
    // Se os dados não foram enviados via método POST, redireciona para a página anterior ou exibe uma mensagem de erro
    echo "Erro: Os dados do formulário não foram recebidos corretamente.";
}
?>

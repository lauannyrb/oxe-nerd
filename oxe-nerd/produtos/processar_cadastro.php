<?php session_start();

if (isset($_POST['nome']) && isset($_POST['preco'])) {
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    // Verifique se uma imagem foi enviada
    if (isset($_FILES['imagem'])) {
        $targetDir = "../carrinho/uploads/"; //nome da pasta para as imagens
        $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
            $imagem = $targetFile;
        }
    }

    // Crie um novo produto
    $produto = [
        'nome' => $nome,
        'preco' => $preco,
        'imagem' => isset($imagem) ? $imagem : 'placeholder.jpg', // Imagem padrão se não for fornecida
    ];

    // Adicione o produto ao array de produtos
    $_SESSION['produtos'][] = $produto;
}

header("Location: lista_produtos_add_produto.php");
?>
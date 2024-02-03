<?php
session_start();

// Verificar se o usuário está logado, caso contrário, redirecioná-lo para a página de login
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login/index-login.php");
    exit;
}

// Verificar se os dados do formulário foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar-se ao banco de dados
    $conexao = new mysqli("mysql", "oxe-nerd", "oxe-nerd", "db_oxe-nerd");

    // Verificar a conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Coletar e escapar os dados do formulário
    $nome = $conexao->real_escape_string($_POST['nome']);
    $preco = $_POST['preco'];
    $preco_antigo = $_POST['preco_antigo'];
    $quantidade = $_POST['quantidade'];
    $categoria = $conexao->real_escape_string($_POST['categoria']);

    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_temp = $_FILES['imagem']['tmp_name'];

    // Pasta onde a imagem será armazenada
    $diretorio_imagens = "../produtos/uploads/";
    $caminho_imagem = $diretorio_imagens . $imagem_nome;

    // Mover a imagem para a pasta de destino
    move_uploaded_file($imagem_temp, $caminho_imagem);

    // Inserir os dados na tabela de produtos
    $sql = "INSERT INTO products (name, price, old_price, quantidade, image_path, category) VALUES ('$nome', $preco, $preco_antigo, $quantidade, '$caminho_imagem', '$categoria')";

    if ($conexao->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o produto: " . $conexao->error;
    }

    // Fechar a conexão com o banco de dados
    $conexao->close();
}
?>
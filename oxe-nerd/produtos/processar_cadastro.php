<?php
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se todos os campos estão preenchidos
    if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_FILES['imagem'])) {
        // Coletar os dados do formulário
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $imagem = $_FILES['imagem']['tmp_name']; // Caminho temporário do arquivo

        // Verificar se a imagem foi enviada corretamente
        if (is_uploaded_file($imagem)) {
            // Ler o conteúdo da imagem
            $conteudo_imagem = addslashes(file_get_contents($imagem));

            // Conectar ao banco de dados (substitua pelas suas credenciais)
            include '../conexao.php'; // Arquivo de conexão com o banco de dados


            // Verificar se a conexão foi estabelecida com sucesso
            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Preparar a consulta SQL para inserir os dados na tabela
            $query = "INSERT INTO products (name, price, image) VALUES ('$nome', '$preco', '$conteudo_imagem')";

            // Executar a consulta
            if ($conn->query($query) === TRUE) {
                echo "Produto cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar o produto: " . $conn->error;
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
        } else {
            echo "Erro no envio da imagem.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    echo "O formulário não foi enviado corretamente.";
}
?>

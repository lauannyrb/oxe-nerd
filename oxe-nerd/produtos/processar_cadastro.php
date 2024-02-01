<?php
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se todos os campos estão preenchidos
    if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_FILES['imagem'])) {
        // Coletar os dados do formulário
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        
        // Verificar se a imagem foi enviada corretamente
        if (is_uploaded_file($_FILES['imagem']['tmp_name'])) {
            // Definir o diretório de destino para salvar a imagem
            $uploadDir = '/var/www/html/produtos/uploads/';
            
            // Gerar um nome único para a imagem
            $imageName = uniqid() . '_' . $_FILES['imagem']['name'];
            
            // Definir o caminho completo do arquivo
            $fullImagePath = $uploadDir . $imageName;

            // Definir o caminho relativo do arquivo
            $relativeImagePath = '/produtos/uploads/' . $imageName;
            
            // Mover o arquivo para o diretório de destino
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $fullImagePath)) {
                // Conectar ao banco de dados (substitua pelas suas credenciais)
                include '../conexao.php'; // Arquivo de conexão com o banco de dados
                
                // Verificar se a conexão foi estabelecida com sucesso
                if ($conn->connect_error) {
                    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                }
                
                // Preparar a consulta SQL para inserir os dados na tabela
                $query = "INSERT INTO products (name, price, image_path) VALUES ('$nome', '$preco', '$relativeImagePath')";
                
                // Executar a consulta
                if ($conn->query($query) === TRUE) {
                    echo "Produto cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o produto: " . $conn->error;
                }
                
                // Fechar a conexão com o banco de dados
                $conn->close();
            } else {
                echo "Erro ao mover o arquivo para o diretório de destino.";
            }
        } else {
            header("Location: /lista_produtos_add_produto.php");
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    header("Location: /lista_produtos_add_produto.php");;
}
?>
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
    $category = $_POST['category'];
    $quantidade = $_POST['quantidade'];

    // Verifica se uma nova imagem foi enviada
    if ($_FILES['new_image']['size'] > 0) {
        // Configurações da imagem
        $target_dir = "../produtos/uploads/"; // Diretório onde a imagem será armazenada
        $target_file = $target_dir . basename($_FILES["new_image"]["name"]); // Caminho completo do arquivo de destino
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Verifica se o arquivo é uma imagem real ou um arquivo fake
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["new_image"]["tmp_name"]);
            if($check !== false) {
                echo "Arquivo é uma imagem - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "O arquivo não é uma imagem.";
                $uploadOk = 0;
            }
        }

        // // Verifica se o arquivo já existe
        // if (file_exists($target_file)) {
        //     echo "Desculpe, a imagem já existe.";
        //     $uploadOk = 0;
        // }

        // // Verifica o tamanho do arquivo
        // if ($_FILES["new_image"]["size"] > 500000) {
        //     echo "Desculpe, o arquivo é muito grande.";
        //     $uploadOk = 0;
        // }

        // // Permitir apenas alguns formatos de arquivo
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        //     echo "Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
        //     $uploadOk = 0;
        // }

        // Verifica se $uploadOk está definido como 0 por algum erro
        if ($uploadOk == 0) {
            echo "Desculpe, sua imagem não foi enviada.";
        // Se tudo estiver correto, tenta fazer o upload do arquivo
        } else {
            if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file)) {
                
                // Atualiza o caminho da imagem no banco de dados
                $image_path = $target_file;
                header("Location: ../produtos/editar_produto.php"); // Redirecionar para a página inicial após o logout

            } else {
                echo "Desculpe, ocorreu um erro ao enviar sua imagem.";
            }
        }
    }

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

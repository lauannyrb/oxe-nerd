<?php
include "../conexao.php";
sessao();
logout();
formularioComprar();
retornar();


if(isset($_POST['deletar'])){
    //echo $_POST['indice']; // Exibe o índice do usuário que está sendo excluído
    unset($_SESSION['produtos'][$_POST['indice']]); // Remove o usuário da sessão com base no índice recebido via POST
}

if(isset($_POST['editar'])){
    echo $_POST['indice']; // Exibe o índice do usuário que está sendo editado
    header('Location: editprodt.php?id='.$_POST['indice']); // Redireciona para a página "editarUsuario.php" com o ID do usuário que será editado na URL
}

// Verificar se o usuário está logado
$nome_usuario = "Faça login";

if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
    $nome_usuario = $_SESSION['usuario_logado']['nome'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
    <title> Edição de produtos </title>
</head>
<body>
<header>
    <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
    <nav>
        <?php painelDeControleAdm(); ?>
        <a class="" href="../Novos-produtos/index-novos-produtos.php"> Novos Produtos  </a>
        <a class="Promoções" href="../promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="../personalizados/index-personalizados.php"> Personalizados </a>
        <?php exibirLinksUsuario(); ?>
    </nav>
</header>

  <!-- Header  -->
  
    <!-- Fim  -->

    <style>
        /* Estilo para centralizar os elementos na tela edit.php */
        .description {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;    
        }

        /* Estilos para as imagens */
        .description img {
            max-width: 200px; /* Defina a largura máxima desejada */
            max-height: 200px; /* Defina a altura máxima desejada */
        }

        h1 {
            color: #2d1d55;
            text-align: center;
        }

        .centralizar {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
        }

        .btn { /*Botão de editar e deletar produto*/
        display: inline-block;
        padding: 10px 10px; /* Defina um valor mínimo de largura para os botões */
        min-width: 120px; /* Valor mínimo de largura em pixels (ajuste conforme necessário) */
        background-color: #B71ABA;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border-color: #B71ABA;
        margin-right: 10px;
        margin-left: 10px;
        }
        .btn:hover {
        background-color: #f890fa; 
        }

        .btn2 {
        display: block;
        padding: 10px 10px; /* Defina um valor mínimo de largura para os botões */
        min-width: 120px; /* Valor mínimo de largura em pixels (ajuste conforme necessário) */
        background-color: #5094A7; /* Cor azul desejada */
        color: #fff;
        text-decoration: none;
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border-color: #8085FF; /* Cor da borda deve corresponder à cor de fundo */
        margin-top: 20px;
        margin-left: 10px;
        margin-right: 10px;
        font-size: 12px;
        }

        .btn2:hover {
        background-color: #7CBCCE; /* Cor mais clara quando hover (opcional) */
        }
    </style>

<?php
// Configurações do banco de dados


// Verifica se a conexão foi bem sucedida


// Query para selecionar todos os produtos
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibindo formulário para editar cada produto
    while($row = $result->fetch_assoc()) {
        ?>
        <form action="editar_produto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="name">Nome:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
            <label for="price">Preço:</label>
            <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
            <label for="old_price">Preço Antigo:</label>
            <input type="text" name="old_price" value="<?php echo $row['old_price']; ?>"><br>
            <label for="image_path">Imagem Atual:</label>
            <img src="<?php echo $row['image_path']; ?>" alt="Imagem atual"><br> <!-- Exibir imagem atual -->
            <label for="new_image">Nova Imagem:</label>
            <input type="file" name="new_image"><br> <!-- Campo para carregar nova imagem -->
            <label for="category">Categoria:</label>
            <input type="text" name="category" value="<?php echo $row['category']; ?>"><br>
            <label for="quantidade">Quantidade:</label>
            <input type="text" name="quantidade" value="<?php echo $row['quantidade']; ?>"><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    }
} else {
    echo "0 resultados";
}

// Fecha conexão com o banco de dados
$conn->close();
?>

 <!---------------- Fale Conosco incio ---------------->
 <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
    </footer>
    <!---------------- Fale Conosco fim ---------------->

</body>
</html>

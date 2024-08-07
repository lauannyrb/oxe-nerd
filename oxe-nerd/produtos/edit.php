<?php
include '../conexao.php';
sessao();
logout();
verificarAdm();

if(isset($_POST['deletar'])){
    // Remove o produto da sessão com base no índice recebido via POST
    unset($_SESSION['produtos'][$_POST['indice']]);
}

if(isset($_POST['editar'])){
    // Redireciona para a página de edição com o ID do produto que será editado na URL
    header('Location: editprodt.php?id='.$_POST['indice']);
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
    <link rel="stylesheet" href="./edit.css">
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
    <!-- Fim  -->

<section>
    <h1> Lista de produtos </h1>
</section>
    
<main class="description">
    <div class="grid">

    <?php
    // Verifica se a conexão foi bem sucedida
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Query para selecionar todos os produtos
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibindo formulário para editar cada produto
        while($row = $result->fetch_assoc()) {
    ?>
        <div class="centralizar">
            <form action="editar_produto.php" method="post" enctype="multipart/form-data">
                <div class="titulos">
                    <h3><?php echo $row['name']; ?></h3>
                </div>
                <div class="picture">
                    <label for="image_path" class="text">Imagem Atual:</label> 
                    <img class="img" src="<?php echo $row['image_path']; ?>" alt="Imagem atual"><!-- Exibir imagem atual -->
                    <label for="new_image" class="text">Nova Imagem:</label> 
                    <div class="new-selector">
                        <input type="file" class="newimg" name="new_image"><!-- Campo para carregar nova imagem -->
                    </div>
                </div>
                <div class="lista">
                    <input type="hidden" name="id" class="result" value="<?php echo $row['id']; ?>"> 
                    <label for="name" class="text">Nome:</label> 
                    <input type="text" class="result" name="name" class="result" value="<?php echo $row['name']; ?>">
                    <label for="price" class="text">Preço:</label> 
                    <input type="text" name="price" class="result" value="<?php echo $row['price']; ?>">
                    <label for="old_price" class="text">Preço Antigo:</label> 
                    <input type="text" name="old_price" class="result" value="<?php echo $row['old_price']; ?>">
                    <label for="category" class="text">Categoria:</label> 
                    <input type="text" name="category" class="result" value="<?php echo $row['category']; ?>">
                    <label for="quantidade" class="text">Quantidade:</label> 
                    <input type="text" name="quantidade" class="result" value="<?php echo $row['quantidade']; ?>">
                </div>
                <div class="botoes">
                    <input type="submit" value="Salvar" class="btn">
                    </form>
                    <form action="excluir_produto.php" method="post">
                
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn2" name="apagar">Apagar</button><!-- Botão para apagar -->
                
            </form>
                </div>
            
            
        </div>
    <?php
        }
    } else {
        echo "0 resultados";
    }

    // Fecha conexão com o banco de dados
    $conn->close();
    ?>

    </div>
</main>

<footer>
    <h2>Fale Conosco</h2>
    <div>
        <img src="../images/Whatsapp.png" alt="Whatsapp"><p>82 99714-3090</p>
        <img src="../images/Instagram.png" alt="Instagram"><p>@oxe_nerd</p>
        <img src="../images/Mail.png" alt="E-Mail"><p>oxenerdbr@outlook.com</p>
    </div>
    <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p> 
</footer>

</body>
</html>

<?php
sessao();
logout();
// Conexão com o banco de dados
include '../conexao.php';

// Consulta SQL para selecionar os produtos da categoria "Personalizados"
$sql = "SELECT * FROM products WHERE category = 'Personalizados'";
$result = $conn->query($sql);

// Verificar se o formulário de compra foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    // Verificar se o carrinho existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    // Adicionar o produto ao carrinho
    $produto = [
        'nome' => $_POST['nome'],
        'preco' => $_POST['preco'],
        'imagem' => $_POST['imagem'],
        'quantidade' => 1 // Definir quantidade inicial como 1
    ];
    $_SESSION['carrinho'][] = $produto;
    // Redirecionar de volta para a página anterior
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-personalizados.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Personalizados</title>
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

    <!-- Containers dos Personalizados -->
    <nav class="titulo"><strong>Personalizados <hr></strong></nav>

    <section class="carrossel">
        <!--Primeira linha de produtos-->
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<section class="cinza">';
                echo '<section class="container">';
                echo '<img class="venda" src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                echo '<div class="titulo">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '</div>';
                echo '<div class="conteudo">';
                echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
                echo '<p class="preco"> <strong>R$ ' . $row['price'] . '</strong></p>';
                echo '<p>Quantidade disponível: ' . $row["quantidade"] . '</p>'; // Display quantity
                echo '<p>À vista no PIX</p>';
                echo '<div class="carrossel">';
                echo '<form method="post">';
                echo '<input type="hidden" name="nome" value="' . $row['name'] . '">';
                echo '<input type="hidden" name="preco" value="' . $row['price'] . '">';
                echo '<input type="hidden" name="imagem" value="' . $row['image_path'] . '">';
                echo '</div>';
                echo '<div class="bot">';
                echo '<button class="btn" type="submit" name="comprar">COMPRAR </button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</section>';
                echo '</section>';
            }
        } else {
            echo "Nenhum produto encontrado.";
        }
        ?>
    </section>

    <!-- Continue com o resto do seu HTML aqui... -->

    <!---------------- Fale Conosco incio ---------------->
    <footer>
        <h2>Fale Conosco</h2>
        <div>
            <img src="../images/Whatsapp.png" alt="Whatsapp">
            <p>82 99714-3090</p>
            <img src="../images/Instagram.png" alt="Instagram">
            <p>@oxe_nerd</p>
            <img src="../images/Mail.png" alt="E-Mail">
            <p>oxenerdbr@outlook.com</p>
        </div>
        <p><strong>OXE NERD<BR>Todos os direitos reservados</strong></p>
    </footer>
    <!---------------- Fale Conosco fim ---------------->
</body>

</html>
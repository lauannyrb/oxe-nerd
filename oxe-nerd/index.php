<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Logo.svg" type="svg">
</head>

<body>

<header>
    <img class="logo-oxe-nerd" src="images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
    <nav>
        <a class="Promoções" href="./promocoes/index-promocoes.php"> Promoções</a>
        <a class="" href="./eletronicos/index-eletronicos.php"> Eletrônicos </a>
        <a class="" href="./personalizados/index-personalizados.php"> Personalizados </a>
        <a class="Login" href="./login/index-login.php">Faça login</a>
        <a class="" href="./carrinho/index-carrinho.php">
            <img class="carrinho" src="images/carrinho.png" title="carrinho">
        </a>
    </nav>
</header>

<section class="promo">
    <img src="images\PROMOÇÃO2.png" alt="Imagem da Promoção">
</section>

<!-- Anúncios -->
<section class="carrossel">

    <div class="container">
        <a href="./eletronicos/index-eletronicos.php"><img class="anuncio" src="images/anun1.png" alt="Anúncio de Ofeitas de Eletrônicos" title="Anúncio 1"></a>
    </div>
    <div class="container">
        <a href="./eletronicos/index-eletronicos.php"><img class="anuncio" src="images/anun2.png" alt="Monte o seu PC gamer" title="Anúncio 2"></a>
    </div>
    <div class="container">
        <a href="./personalizados/index-personalizados.php"><img class="anuncio" src="images/anun3.png" alt="Monte a sua Coleção de bonecos" title="Anúncio 3"></a>
    </div>

</section>
<!-------------------------------->

<!-- Containers com as promoções-->

<nav class="titulo">
    <strong>Promoções</strong>
    <a href="./promocoes/index-promocoes.php">Ver Mais</a>
</nav>

<section id="promocoes" class="carrossel">
    <?php
    // Conectar ao banco de dados e selecionar apenas os produtos em promoção
    include './conexao.php';

    // Verificar conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM products WHERE category = 'Promoção'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibir os produtos
        $count = 0; // Counter variable
        while ($row = $result->fetch_assoc()) {
            if ($count >= 4) {
                break; // Exit the loop after displaying 4 products
            }
            echo '<section class="container">';
            echo '<img class="venda" src="' . $row['image_path'] . '" alt="Imagem de venda">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
            echo '<p class="preco"> <strong>R$ ' . $row['price'] . '</strong></p>';
            echo '<p>À vista no PIX</p>';
            echo '<div class="carrossel">';
            echo '<form method="post">';
            echo '<input type="hidden" name="nome" value="' . $row['name'] . '">';
            echo '<input type="hidden" name="preco" value="' . $row['price'] . '">';
            echo '<input type="hidden" name="imagem" value="' . $row['image_path'] . '">';
            echo '<button class="btn" type="submit" name="comprar">COMPRAR </button>';
            echo '</form>';
            echo '</div>';
            echo '</section>';

            $count++; // Increment the counter
        }
    } else {
        echo "Nenhum produto em promoção no momento.";
    }
    $conn->close();
    ?>
</section>

</section>

<!---------------- Fale Conosco ---------------->
<h2 class="contato">Fale Conosco</h2>

<section class="contato">
    <img class="contato" src="images/whats_roxo.png" alt="Whatsapp"><p class="contato">82 99714-3090</p>
    <img class="contato" src="images/insta_roxo.png" alt="Instagram"><p class="contato">@oxe_nerd</p>
    <img class="contato" src="images/mail_roxo.png" alt="E-Mail"><p class="contato">oxenerdbr@outlook.com</p>
</section>

<footer class="roda">
    <strong>OXE NERD<BR>Todos os direitos reservados</strong>
</footer>
</body>

</html>

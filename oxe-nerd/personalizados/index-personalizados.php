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
    <!-- Header  -->
    <header>
        <a href="../index.php"><img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd"></a>
        <nav>
            <div><a class="" href="../promocoes/index-promocoes.php"> Promoções </a></div>
            <hr>
            <a class="" href="../eletronicos/index-eletronicos.php"> Eletrônicos </a>
            <a class="" href="#"> Personalizados </a>
            <a class="Login" href="../login/index-login.php">Faça login</a>
            <a class="" href="../carrinho/index-carrinho.php">
                <img class="carrinho" src="../images/carrinho.png" title="carrinho"> 0
            </a>
        </nav>
    </header>
    <!-- Fim  -->

    <!-- Containers dos Personalizados -->
    <nav class="titulo"><strong>Personalizados <hr></strong></nav>
    <h2 class="titulo"><B>Canecas</B></h2>
    <section class="carrossel">
        <!-- Primeira linha de produtos, CANECAS -->
        <?php
    // Conexão com o banco de dados
    include '../conexao.php';

    // Consulta SQL para selecionar os produtos da categoria "Personalizados"
    $sql = "SELECT * FROM products WHERE category = 'Personalizados'";
    $result = $conn->query($sql);

    // Verifica se há produtos
    if ($result->num_rows > 0) {
        // Loop através dos resultados da consulta
        while ($row = $result->fetch_assoc()) {
            // Exibição dinâmica dos produtos
            echo '<section class="cinza">';
            echo '<section class="container">';
            echo '<img class="venda" src="../images/' . $row["image_path"] . '" alt="' . $row["name"] . '">';
            echo '<h2>' . $row["name"] . '</h2>';
            echo '<p><s>R$ ' . $row["old_price"] . '</s></p>';
            echo '<p class="preco"><strong>R$ ' . $row["price"] . '</strong></p>';
            echo '<p>À vista no PIX</p>';
            echo '<div class="carrossel">';
            echo '<form method="post">';
            echo '<input type="hidden" name="nome" value="' . $row["name"] . '">';
            echo '<input type="hidden" name="preco" value="' . $row["price"] . '">';
            echo '<input type="hidden" name="imagem" value="../images/' . $row["image_path"] . '">';
            echo '<button class="btn" type="submit" name="comprar">COMPRAR </button>';
            echo '</form>';
            echo '</div>';
            echo '</section>';
            echo '</section>';
        }
    } else {
        echo "Nenhum produto encontrado.";
    }
    // Fecha a conexão com o banco de dados
    $conn->close();
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

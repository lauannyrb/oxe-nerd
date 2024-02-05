<?php
sessao();
logout();
include '../conexao.php';

// Query para selecionar os produtos do banco de dados
$sql = "SELECT * FROM products WHERE category = 'Eletrônicos'";
$result = $conn->query($sql);

formularioComprar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style-eletronicos.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/oxe-nerd-logo.png">
    <title>Eletrônicos</title>
</head>

<body>
    <!-- Header  -->
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

    <!-- Containers dos Eletrônicos -->
    <nav class="titulo"><strong>Eletrônicos<hr></strong></nav>

    <section class="carrossel">
        <!--Primeira linha de produtos-->
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<section class="cinza">';
                echo '<section class="container">';
                echo '<img class="venda" src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p><s>R$ ' . $row['old_price'] . '</s></p>';
                echo '<p class="preco"> <strong>R$ ' . $row['price'] . '</strong></p>';
                echo '<p>Quantidade disponível: ' . $row["quantidade"] . '</p>'; // Display quantity
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
                echo '</section>';
            }
        } else {
            echo "Nenhum produto encontrado.";
        }
        ?>
    </section>

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

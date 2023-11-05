<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="style-lista-produtos">
</head>
<body>
    <header>
        <img class="logo-oxe-nerd" src="../images/oxe-nerd-logo.png" title="Logo da Oxe Nerd">
        <nav>
            <a class="Promoções" href="#promocoes"> Promoções </a>
            <a class="" href="../eletronicos/index-eletronicos.html"> Eletrônicos </a>
            <!-- <a class="Equipamentos" href="#"> Equipamentos </a> -->
            <a class="" href="../personalizados/index-personalizados.html"> Personalizados </a>
            <a class="Login" href="../login/index-login.html"> Login </a>
            <!--  <a class="Canecas" href="ref da aba de canecas"> Canecas </a>-->
            <a class="carrinho" href="../carrinho/index-carrinho.html"> <img class="carrinho" src="../images/carrinho.png" title="carrinho"> </a>
        </nav>
    </header>

    <?php
    session_start();

    if (isset($_SESSION['produtos'])) {
       // echo "<h1>Lista de Produtos</h1>";

        foreach ($_SESSION['produtos'] as $key => $produto) {
            //echo "<div class='produtos-lista'>";
            echo "<section class='container'>";
            echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
            echo "<h2>" . $produto['nome'] . "</h2>";
            echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
            echo "<a class='btn'>COMPRAR</a>";
            echo "<form action='adicionar_carrinho.php' method='post'>";
            echo "</section>";
            //echo "</div>";




        //     echo "<main>";
        //     echo "<div class='grid'>";
        //     echo "<div class='produto'>";
        //     echo "<img src='" . $produto['imagem'] . "' alt='Imagem do Produto'>";
        //     echo "<h2>" . $produto['nome'] . "</h2>";
        //     echo "<p>Preço: R$ " . $produto['preco'] . "</p>";
        //    echo "<form action='adicionar_carrinho.php' method='post'>";
        //     echo "<input type='hidden' name='produto_key' value='$key'>";
        //     echo "<button type='submit' name='add_to_cart'>Adicionar ao Carrinho</button>";
        //    echo "</form>";
        //     echo "</div>";
        //     echo "</div>";
        //     echo "</main>";


        //     <section class="container">
        //     <!--<img src="Img\img1.jfif" alt="Imagem de venda">-->
        //     <img class="venda" src="images/rtx.png" alt="Imagem de venda">
        //     <h2>Placa de Vídeo PNY GeForce RTX 4090 XLR8</h2>
        //     <p><s>R$ 10.000,50</s></p>
        //     <p class="preco"> <strong>R$ 6.999,99</strong></p>
        //     <p>À vista no PIX</p>
        //     <a href="#" class="btn">COMPRAR</a>
        // </section>
        }
    } else {
        echo "<p>Nenhum produto cadastrado ainda.</p>";
    }

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

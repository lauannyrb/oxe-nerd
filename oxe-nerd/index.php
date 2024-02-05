<?php
include "./conexao.php";
sessao();
logout();
formularioComprar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OXE NERD</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="../images/Logo.svg" type="svg">
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
<?php exibirProdutosPromocao4();?>

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
